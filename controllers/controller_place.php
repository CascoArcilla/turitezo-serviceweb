<?php
require_once __DIR__ . "../../config/DataAccess.php";
require_once __DIR__ . "../../models/Place.php";
require_once __DIR__ . "../../models/Trasnport.php";
require_once __DIR__ . "../../models/Category.php";
require_once __DIR__ . "../../models/DetailsPlace.php";

class ControllerPlace
{
    private $listPlaces;
    private $queryListPlaces;
    private $queryDetailsPlace;
    private $details;

    public function __construct()
    {
        $this->listPlaces = array();
        $this->details = array();
        $this->queryListPlaces = "SELECT * FROM lista_lugares;";
        $this->queryDetailsPlace = "SELECT * FROM detalles_lugar";
    }

    public function getListPlaces()
    {
        $this->listPlaces = array();
        try {
            $acData = new DataAccess();
            $results = $acData->executeQueryGet($this->queryListPlaces);

            if (!$results->num_rows) {
                return ["message" => "Sin datos de lugares"];
            }

            while ($row = $results->fetch_assoc()) {
                $idLugar = $row["id_lugar"];

                if (!isset($this->listPlaces[$idLugar])) {
                    $this->listPlaces[$idLugar] = new Place($idLugar, $row["nombre_lugar"], $row["portada"]);
                }

                $nombreCategoria = $row["nombre_categoria"];

                if (!$this->listPlaces[$idLugar]->isExistCategory($nombreCategoria)) {
                    $this->listPlaces[$idLugar]->addCategory(new Category(false, $nombreCategoria));
                }

                $nombreTransporte = $row["nombre_vehiculo"];

                if (!$this->listPlaces[$idLugar]->isExistTransports($nombreTransporte)) {
                    $this->listPlaces[$idLugar]->addTransport(new Transport($nombreTransporte, $row["tiempo_estimado"]));
                }
            }

            $acData->closeConection();
            $acData = null;

            $resPlace = array();

            foreach ($this->listPlaces as $place) {
                array_push($resPlace, $place->getRawPlace());
            }

            return $resPlace;
        } catch (Exception $th) {
            error_log("Error al obtener la lista de lugares: " . $th->getMessage());
            return ["message" => "Fallo en optener los datos"];
        }
    }

    public function getDetailsPlace($idPlace)
    {
        $this->queryDetailsPlace = "$this->queryDetailsPlace WHERE id_lugar = $idPlace;";
        $isCreateObjDetail = false;
        try {
            $acData = new DataAccess();
            $results = $acData->executeQueryGet($this->queryDetailsPlace);

            if (!$results->num_rows) {
                return ["message" => "Sin detalles del lugar"];
            }

            while ($row = $results->fetch_assoc()) {
                if (!$isCreateObjDetail) {
                    $this->details = new DetailsPlace($row["descripcion"], $row["descripcion_flora_fauna"], $row["tiempo_ideal"], $row["presupuesto_estimado"], $row["nombre_localidad"], $row["superfice_estimada"], $row["protegido"], $row["cobran"]);
                    $isCreateObjDetail = true;
                }

                $medida_ambiental = $row["nombre_medida_ambiental"];
                if (!$this->details->isThereEnvironmentalMeasure($medida_ambiental) && $medida_ambiental!=null) {
                    $this->details->addEnvironmentalMeasure($medida_ambiental);
                }

                $medida_seguridad = $row["nombre_medida_seguridad"];
                if (!$this->details->isThereSecurityMeasure($medida_seguridad) && $medida_seguridad != null) {
                    $this->details->addSecurityMeasure($medida_seguridad);
                }

                $estacion = $row["nombre_estacion"];
                if (!$this->details->isThereSeason($estacion) && $estacion != null) {
                    $this->details->addSeaon($estacion);
                }

                $actividad = $row["nombre_actividad"];
                if (!$this->details->isThereActivity($actividad) && $actividad != null) {
                    $this->details->addActivity($actividad);
                }
            }

            $acData->closeConection();
            $acData = null;
            return $this->details->getRawDetails();
        } catch (Exception $th) {
            error_log("Error al obtener los detalles del lugar: " . $th->getMessage());
            return ["message" => "Fallo al optener los datos "];
        }
    }
}
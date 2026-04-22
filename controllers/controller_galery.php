<?php
require_once __DIR__ . "../../config/DataAccess.php";
require_once __DIR__ . "../../models/ImageGalery.php";

class ControllerGaleria
{
    private $listImages;
    private $queryImages;

    public function __construct()
    {
        $this->listImages = array();
        $this->queryImages = "SELECT id_imagen, url_imagen, nombre_lugar FROM galeria_lugar";
    }

    public function getGalery($id_place) : array
    {
        $this->queryImages = "$this->queryImages WHERE id_lugar = $id_place;";
        $this->listImages = array();
        try {
            $acc = new DataAccess();
            $results = $acc->executeQueryGet($this->queryImages);

            if (!$results->num_rows) {
                return ["message" => "No data"];
            }

            while ($row = $results->fetch_assoc()) {
                array_push($this->listImages, new ImageGalery($row["id_imagen"], $row["url_imagen"], $row["nombre_lugar"]));
            }

            $acc->closeConection();
            $acc = null;
            return $this->listImages;
        } catch (\Throwable $th) {
            error_log("Error al obtener las imágenes de la galeria: " . $th->getMessage());
            return ["message" => "Error al optener los datos"];
        }
    }
}
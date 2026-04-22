<?php
require_once __DIR__ . "../../config/DataAccess.php";
require_once __DIR__ . "../../models/Locate.php";

class ControllerLocate
{
    private $queryLocate;

    public function __construct()
    {
        $this->queryLocate = "SELECT latitud, altitud, longitud FROM lugar_turistico";
    }

    public function getPlaceLocate($id_place)
    {
        $this->queryLocate = "$this->queryLocate WHERE id_lugar = $id_place;";
        try {
            $conAcc = new DataAccess();
            $results = $conAcc->executeQueryGet($this->queryLocate);

            if (!$results->num_rows) {
                return ["message" => "Localizacion no disponible"];
            }

            $row = $results->fetch_assoc();

            $arrLocate = [new Locate($row["latitud"], $row["altitud"], $row["longitud"])];

            $conAcc->closeConection();
            $conAcc = null;
            return $arrLocate;
        } catch (\Throwable $th) {
            error_log("Error al obtener la localizacion: " . $th->getMessage());
            return ["message" => "Error al optener informacion"];
        }
    }
}
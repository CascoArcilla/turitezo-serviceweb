<?php
require_once __DIR__ . "../../config/DataAccess.php";
require_once __DIR__ . "../../models/Category.php";

class ControllerCategoria
{
    private $queyAll;
    private $listCategorys;

    public function __construct()
    {
        $this->listCategorys = array();
        $this->queyAll = "SELECT * FROM categoria;";
    }

    public function getAllCategories() : array
    {
        $this->listCategorys = array();
        try {
            $acces = new DataAccess();
            $results = $acces->executeQueryGet($this->queyAll);

            if (!$results->num_rows) {
                return ["message" => "Sin categorias"];
            }

            while ($row = $results->fetch_assoc()) {
                array_push($this->listCategorys, new Category($row["id_categoria"], $row["nombre_categoria"]));
            }

            $acces->closeConection();
            $acces = null;
            return $this->listCategorys;
        } catch (\Throwable $th) {
            return ["message" => "Error optener los datos"];
        }
    }
}

?>
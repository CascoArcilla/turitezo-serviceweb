<?php
class Place
{
    private $idPlace;
    private $namePlace;
    private $frondPage;
    private $timeTransport;
    private $listCategoryPlace;

    public function __construct($id, $name, $frond)
    {
        $this->idPlace = $id;
        $this->namePlace = $name;
        $this->frondPage = $frond;
        $this->timeTransport = array();
        $this->listCategoryPlace = array();
    }

    public function getRawPlace() : array
    {
        $arrRawTimeTransport = array();
        foreach ($this->timeTransport as $trasnport) {
            if ($trasnport->getNameTransport() != null) {
                array_push($arrRawTimeTransport, $trasnport->getTransportTime());
            }
        }

        $arrRawCategory = array();
        foreach ($this->listCategoryPlace as $category) {
            if ($category->getNameCategory() != null) {
                array_push($arrRawCategory, $category->getNameCategory());
            }
        }

        $data = [
            "id_lugar" => $this->idPlace,
            "nombre_lugar" => $this->namePlace,
            "portada" => $this->frondPage,
            "tiempos_llegada" => $arrRawTimeTransport,
            "categorias" => $arrRawCategory
        ];

        return $data;
    }

    public function addTransport($newTransport)
    {
        array_push($this->timeTransport, $newTransport);
    }

    public function addCategory($newCategory)
    {
        array_push($this->listCategoryPlace, $newCategory);
    }

    public function isExistTransports($nameToCompare) : bool
    {
        $namesTrasnports = array();

        foreach ($this->timeTransport as $transport) {
            array_push($namesTrasnports, $transport->getNameTransport());
        }

        return in_array($nameToCompare, $namesTrasnports);
    }

    public function isExistCategory($nameToCompare) : bool
    {
        $namesCategorys = array();

        foreach ($this->listCategoryPlace as $category) {
            array_push($namesCategorys, $category->getNameCategory());
        }

        return in_array($nameToCompare, $namesCategorys);
    }
}
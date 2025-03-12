<?php
class Category
{
    private $id_category;
    private $name_category;

    public function __construct($id, $name)
    {
        $this->id_category = !$id ? null : $id;
        $this->name_category = $name;
    }

    public function getAtributs() : array
    {
        return ["id_categoria" => $this->id_category, "nombre_categoria" => $this->name_category];
    }

    public function getNameCategory() : string|null
    {
        return $this->name_category;
    }
}
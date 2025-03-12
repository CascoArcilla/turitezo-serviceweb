<?php
class ImageGalery
{
    private $idImg;
    private $urlImg;
    private $namePlace;

    public function __construct($id, $url, $name)
    {
        $this->idImg = $id;
        $this->urlImg = $url;
        $this->namePlace = $name;
    }

    public function getAtributes()
    {
        return ["id" => $this->idImg, "url" => $this->urlImg, "nombreLugar" => $this->namePlace];
    }
}
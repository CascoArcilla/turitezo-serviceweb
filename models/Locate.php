<?php
class Locate
{
    private $latitud;
    private $altitud;
    private $longitud;

    public function __construct($lat, $alt, $long)
    {
        $this->latitud = $lat;
        $this->altitud = $alt;
        $this->longitud = $long;
    }

    public function getCoordinates() : array
    {
        return ["latitud" => $this->latitud, "altitud" => $this->altitud, "longitud" => $this->longitud];
    }
}
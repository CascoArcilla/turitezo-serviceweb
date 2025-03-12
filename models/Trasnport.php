<?php
class Transport
{
    public $nameTransport;
    public $timeRoad;

    public function __construct($name, $time)
    {
        $this->nameTransport = $name;
        $this->timeRoad = $time;
    }

    public function getTransportTime() : array
    {
        return ["trasnporte" => $this->nameTransport, "tiempo" => $this->timeRoad];
    }

    public function getNameTransport() : string|null
    {
        return $this->nameTransport;
    }
}
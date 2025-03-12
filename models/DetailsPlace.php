<?php
class DetailsPlace
{
    private $description;
    private $descriptionFauna;
    private $timeIdeal;
    private $estimatedBudget;
    private $nameLocality;
    private $estiamatedSurface;
    private $isProtected;
    private $isPayToIn;
    private $listEnvironmentalMeasures;
    private $listSecurityMeasures;
    private $listSeasons;
    private $listActivitis;

    public function __construct($_description, $_descriptionFauna, $_timeIdeal, $_estimatedBudget, $_nameLocality, $_estiamatedSurface, $_isProtected, $_isPayToIn)
    {
        $this->description = $_description;
        $this->descriptionFauna = $_descriptionFauna;
        $this->timeIdeal = $_timeIdeal;
        $this->estimatedBudget = $_estimatedBudget;
        $this->nameLocality = $_nameLocality;
        $this->estiamatedSurface = $_estiamatedSurface;
        $this->isProtected = $_isProtected;
        $this->isPayToIn = $_isPayToIn;
        $this->listEnvironmentalMeasures = array();
        $this->listSecurityMeasures = array();
        $this->listSeasons = array();
        $this->listActivitis = array();
    }

    public function getRawDetails() : array
    {
        return [
            "descripcion" => $this->description,
            "fauna" => $this->descriptionFauna,
            "tiempo_ideal" => $this->timeIdeal,
            "presupuesto_estimado" => $this->estimatedBudget,
            "localidad" => $this->nameLocality,
            "superficie_estimada" => $this->estiamatedSurface,
            "es_protegido" => $this->isProtected,
            "se_paga" => $this->isPayToIn,
            "medidas_ambientales" => $this->listEnvironmentalMeasures,
            "medidas_seguridad" => $this->listSecurityMeasures,
            "estaciones" => $this->listSeasons,
            "actividades" => $this->listActivitis
        ];
    }

    public function addEnvironmentalMeasure($measure)
    {
        array_push($this->listEnvironmentalMeasures, $measure);
    }

    public function addSecurityMeasure($measure)
    {
        array_push($this->listSecurityMeasures, $measure);
    }

    public function addSeaon($seaon)
    {
        array_push($this->listSeasons, $seaon);
    }

    public function addActivity($activity)
    {
        array_push($this->listActivitis, $activity);
    }

    public function isThereEnvironmentalMeasure($measure) : bool
    {
        return in_array($measure, $this->listEnvironmentalMeasures);
    }

    public function isThereSecurityMeasure($measure) : bool
    {
        return in_array($measure, $this->listSecurityMeasures);
    }

    public function isThereSeason($seaon) : bool
    {
        return in_array($seaon, $this->listSeasons);
    }

    public function isThereActivity($activity) : bool
    {
        return in_array($activity, $this->listActivitis);
    }
}
<?php
require_once "../../controllers/controller_place.php";

$objConPlaces = new ControllerPlace();

$resPlaces = $objConPlaces->getListPlaces();

if (!isset($resPlaces['message'])) {
    echo json_encode($resPlaces);
    die();
} else {
    $rawPlaces = array();

    foreach ($resPlaces as $objPlace) {
        array_push($rawPlaces, $objPlace);
    }

    json_encode($rawPlaces);
    die();
}
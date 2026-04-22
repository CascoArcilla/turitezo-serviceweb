<?php
require_once __DIR__ . "/../../headers/extra_headers.php";

$noId = ["message" => "Error en la espcificacion del lugar"];

if (!isset($_GET["id_lugar"])) {
    echo json_encode($noId);
    die();
}

$idLugar = intval($_GET["id_lugar"], 10);

if (!$idLugar) {
    echo json_encode($noId);
    die();
}

require_once "../../controllers/controller_locate.php";

$objConLocate = new ControllerLocate();

$arrLocate = $objConLocate->getPlaceLocate($idLugar);

if (isset($arrLocate['message'])) {
    echo json_encode($arrLocate);
    die();
} else {
    $locate = $arrLocate[0];
    echo json_encode($locate->getCoordinates());
    die();
}
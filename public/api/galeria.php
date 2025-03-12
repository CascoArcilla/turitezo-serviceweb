<?php
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

require_once "../../controllers/controller_galery.php";

$objConGalery = new ControllerGaleria();

$resultQueryImages = $objConGalery->getGalery($idLugar);

if (isset($resultQueryImages["message"])) {
    echo json_encode($resultQueryImages);
    die();
} else {
    $listImages = array();
    foreach ($resultQueryImages as $image) {
        array_push($listImages, $image->getAtributes());
    }
    echo json_encode($listImages);
    die();
}
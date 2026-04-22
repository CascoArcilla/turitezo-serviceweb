<?php
require_once __DIR__ . "/../../controllers/controller_category.php";

$objConCategory = new ControllerCategoria();

$categories = $objConCategory->getAllCategories();

if (isset($categories["message"])) {
    echo json_encode($categories);
    die();
} else {
    $listOfCategorys = array();

    foreach ($categories as $category) {
        array_push($listOfCategorys, $category->getAtributs());
    }
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($listOfCategorys);
    die();
}
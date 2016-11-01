<?php
require_once "config/db.php";
require_once "selectors/layoutSelector.php";
require_once "commons/commons.php";

$type       = INPUT_GET;
$id         = filter_input($type, "id");
$clientID   = filter_input($type, "cl_id");

if ($id == NULL || $clientID == NULL) {
    exit();
}

$position = getSelectedPosition($id);//getPosition($parkinglotID, $vehicleTypeID);
if (!empty($position)) {
    
    // Encontro posicion, Busco la posicion de la entrada
    $layoutID = $position["layout_id"];
    $inputPos = getInputPosition($layoutID);
    
    // Con la posicion de entrada y la posicion del lugar, armo el camino
    $param                  = array();
    $param["clientID"]      = $clientID;
    $param["lyRows"]        = $position["maxRows"];
    $param["lyCols"]        = $position["maxCols"];
    $param["idPosition"]    = $position["id"];
    
    // El start y el end van de 0 a max - 1 
    $param["start"] = getPositionNumber($inputPos["xPoint"], $inputPos["yPoint"], $position["maxRows"], $position["maxCols"]);
    $param["end"]   = getPositionNumber($position["xPoint"], $position["yPoint"], $position["maxRows"], $position["maxCols"]);
    $param["lyGraph"] = getLayouGraph($layoutID, $position["xPoint"], $position["yPoint"]);
    
    // Dibujo el Mapa
    extract($param);
    include 'map.php';
} else {
    include 'mapEmpty.php';
}


<?php
require_once '../config/db.php';
require_once '../selectors/layoutSelector.php';
require_once '../commons/commons.php';

$type           = INPUT_GET;
$parkinglotID   = filter_input($type, "pk_id");
$vehicleTypeID  = filter_input($type, "vt_id");
$clientID       = filter_input($type, "cl_id");

$exp = $parkinglotID == NULL || $vehicleTypeID == NULL || $clientID == NULL;
if ($exp) {
    echo "<h1>Ha ocurrido un error</h1>";
    echo "<h4>La informacion proporcionada no es valida</h4>";
    exit();
}

$position = getPosition($parkinglotID, $vehicleTypeID);
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
    include 'emptyMap.php';
}


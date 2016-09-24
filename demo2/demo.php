<?php
require_once '../config/db.php';
require_once '../selectors/layoutSelector.php';
require_once '../commons/commons.php';

$type           = INPUT_GET;
$parkinglotID   = filter_input($type, "pk_id");
$vehicleTypeID  = filter_input($type, "vt_id");

$exp = $parkinglotID == NULL || $vehicleTypeID == NULL;
if ($exp) {
    echo "<h1>Ha ocurrido un error</h1>";
    echo "<h4>La informacion proporcionada no es valida</h4>";
    exit();
}

$position = getPosition($parkinglotID, $vehicleTypeID);

$param          = array();
$param["rows"]  = 0;
$param["cols"]  = 0;
$param["start"] = 0;
$param["end"]   = 0;
$param["graph"] = array();

if (!empty($position)) {
    
    // Encontro posicion, Busco la posicion de la entrada
    $layoutID = $position["layout_id"];
    $inputPos = getInputPosition($layoutID);
    
    // Con la posicion de entrada y la posicion del lugar, armo el camino
    $param["lyRows"]  = $position["maxRows"];
    $param["lyCols"]  = $position["maxCols"];
    
    // El start y el end van de 0 a max - 1 
    $param["start"] = getPositionNumber($inputPos["xPoint"], $inputPos["yPoint"], $position["maxRows"], $position["maxCols"]);
    $param["end"]   = getPositionNumber($position["xPoint"], $position["yPoint"], $position["maxRows"], $position["maxCols"]);
    $param["lyGraph"] = getUnavailablePostitions($layoutID);
}

// Dibujo el Mapa
extract($param);
include 'map.php';

<?php

/**
 * Nombre           : cancelNavigation.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Asigna la una posicion a un cliente, en funcion del Tipo 
 *                  : de Vehiculo y el establecimiento en el que quiere 
 *                  : estacionar. La posicion asignada queda en estado reservado
 * Fecha            : Octubre 2016                                                         
 * Observaciones    :     
 */

require_once "config/db.php";
require_once "selectors/layoutSelector.php";
require_once "commons/commons.php";

$type = INPUT_GET;

$parkinglotID   = filter_input($type, "pk_id");
$vehicleTypeID  = filter_input($type, "vt_id");

if ($parkinglotID == null || $vehicleTypeID == null) {
    $result = array();
    $result["error"] = "true";
    $result["data"] = "";
    echo json_encode($result);
    exit();
}

$position = getPosition($parkinglotID, $vehicleTypeID);
if (empty($position)) {
    $result = array();
    $result["error"] = "true";
    $result["data"] = "";
    echo json_encode($result);
    exit();
}

$result = array();
$result["error"] = "false";
$result["data"] = $position["id"];

echo json_encode($result);
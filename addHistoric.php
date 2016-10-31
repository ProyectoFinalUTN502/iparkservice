<?php

/**
 * Nombre           : addHistoric.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Agrega una posicion en el historial del usuario                                                           
 *                  :                                   
 * Fecha            : Octubre 2016                                                         
 * Observaciones    :     
 */

require_once "config/db.php";

$type       = INPUT_POST;
$id         = filter_input($type, "id");
$vehicleID  = filter_input($type, "vehicle_id");


$exp = ($id == NULL || $vehicleID == NULL);
if ($exp) {
    $result = array();
    $result["error"] = "true";
    $result["data"] = "";
    
    exit();
}
$sql = "INSERT INTO vehicle_parking (vehicle_id, layout_position_id) 
        VALUES ('" . $vehicleID . "', '" . $id . "')";

$op = executeNonQuery($sql);

$result = array();

if ($op == false) {
    $result["error"] = "true";
    $result["data"] = "";
} else {
    $result["error"] = "false";
    $result["data"] = ""; 
}

echo json_encode($result);
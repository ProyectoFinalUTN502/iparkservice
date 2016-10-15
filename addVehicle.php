<?php

/**
 * Nombre           : addVehicle.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Agrega un vehiculo a los vehiculos de un Cliente                                                           
 *                  :                                   
 * Fecha            : Octubre 2016                                                         
 * Observaciones    :     
 */

require_once 'config/db.php';

$type = INPUT_POST;

$name           = filter_input($type, "name");
$clientID       = filter_input($type, "client_id");
$vehicleTypeID  = filter_input($type, "vehicle_type_id");
$currentVehicle = ACTIVE;

$exp = ($name == NULL || $clientID == NULL || $vehicleTypeID == NULL);
if ($exp) {
    $result = array();
    $result["error"] = "true";
    $result["data"] = "";
    
    exit();
}

$sql = "UPDATE vehicle SET currentVehicle = " . NOT_ACTIVE . " 
        WHERE client_id = " . $clientID;

$op = executeNonQuery($sql);

$sql = "INSERT INTO vehicle (name, currentVehicle, client_id, vehicle_type_id) 
        VALUES ('" . $name . "', '" . $currentVehicle . "', '" . $clientID . "', '" . $vehicleTypeID . "')";

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
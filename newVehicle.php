<?php

/**
 * Nombre           : newVehicle.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza el registro de un nuevo vehiculo                                                          
 *                  : de un Cliente en el sistema                                                        
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

require_once 'config/db.php';

$type = INPUT_POST;

$name           = filter_input($type, "name");
$clientID       = filter_input($type, "client_id");
$vehicleTypeID  = filter_input($type, "vehicle_type_id");
$currentVehicle = ACTIVE;

$sql = "INSERT INTO vehicle (name, currentVehicle, client_id, vehicle_type_id) "
        . "VALUES ('" . $name . "', '" . $currentVehicle . "', '" . $clientID . "', '" . $vehicleTypeID . "');";

$op = executeNonQuery($sql);

$result = array();

if ($op == false) {
    $result["error"] = "true";
    $result["data"] = "";
} else {
    
    $sql = "UPDATE client SET isActive = " . ACTIVE . " WHERE id = " . $clientID;
    $op = executeNonQuery($sql);
    
    $result["error"] = "false";
    $result["data"] = ""; 
}

echo json_encode($result);
<?php

/**
 * Nombre           : newClient.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza el registro de un nuevo Cliente (Usuario de App)                                                         
 *                  : en el sistema                                                         
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

require_once 'config/db.php';

$type = INPUT_POST;

$email      = filter_input($type, "email");
$password   = filter_input($type, "password"); // Ya viene Hasheado
$name       = filter_input($type, "name");
$lastName   = filter_input($type, "lastName");
$macAddress = filter_input($type, "macAddress");

$sql = "INSERT INTO client (email, password, name, lastName, isActive) "
        . "VALUES ('" . $email . "', '" . $password . "', '" . $name . "', '" . $lastName . "', " . NOT_ACTIVE . ")";
$op = executeNonQuery($sql , true);

$result = array();  
if ($op != false) {
    // El ultimo ID Insertado
    $clientID = $op;
    $sql = "INSERT INTO client_mac (macAddress, client_id) VALUES ('" . $macAddress . "', '" . $clientID . "');";
    $op = executeNonQuery($sql);
    
    $result["error"] = "false";
    $result["data"] = $clientID; 
} else {
    $result["error"] = "true";
    $result["data"] = ""; 
}

echo json_encode($result);
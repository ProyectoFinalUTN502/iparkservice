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

$sql = "INSERT INTO client (macAddress, email, password, name, lastName, isActive) "
        . "VALUES ('" . $macAddress . "', '" . $email . "', '" . $password . "', '" . $name . "', '" . $lastName . "', " . NOT_ACTIVE . ")";

$op = executeNonQuery($sql , true);

$result = array();

if ($op == false) {
    $result["error"] = "true";
    $result["data"] = "";
} else {
    $result["error"] = "false";
    $result["data"] = $op; // El ultimo ID Insertado
}

echo json_encode($result);
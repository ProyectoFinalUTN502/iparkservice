<?php

/**
 * Nombre           : newClient.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza el registro de un nuevo Cliente (Usuario de App)                                                         
 *                  : en el sistema                                                         
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

require_once 'db.php';

$type = INPUT_GET;

$token      = filter_input($type, "token");
$macAddress = filter_input($type, "macAddress");
$email      = filter_input($type, "email");
$password   = filter_input($type, "password");
$name       = filter_input($type, "name");
$lastName   = filter_input($type, "lastName");

$hashedPass = md5($password);

$sql = "INSERT INTO client (token, macAddress, email, password, name, lastName) "
        . "VALUES ('" . $token . "', '" . $macAddress . "', '" . $email . "', '" . $hashedPass . "', '" . $name . "', '" . $lastName . "')";

$op = executeNonQuery($sql);

$result = array();

if ($op) {
    $result["state"] = "true";
    $result["message"] = RESULT_OK;
} else {
    $result["state"] = "false";
    $result["message"] = RESULT_ERROR;    
}

echo json_encode($result);
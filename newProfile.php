<?php

/**
 * Nombre           : newProfile.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza el registro del Perfil (preferencias de busqeuda)                                                         
 *                  : de un Cliente en el sistema                                                        
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

require_once 'config/db.php';

$type = INPUT_POST;

$range      = filter_input($type, "range");
$maxPrice   = filter_input($type, "maxPrice");
$is24       = filter_input($type, "is24");
$isCovered  = filter_input($type, "isCovered");
$clientID   = filter_input($type, "client_id");

$sql = "INSERT INTO client_profile (`range`, maxPrice, is24, isCovered, client_id) "
        . "VALUES ('" . $range . "', '" . $maxPrice . "', '" . $is24 . "', '" . $isCovered . "', '" . $clientID . "');";

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
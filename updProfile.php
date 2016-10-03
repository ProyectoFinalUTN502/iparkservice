<?php

/**
 * Nombre           : updProfile.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza la actualizacion del Perfil (preferencias de busqeuda)                                                         
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

$exp = ($range == NULL || $maxPrice == NULL || $is24 == NULL || $isCovered == NULL || $clientID == NULL);
if ($exp) {
    $result = array();
    $result["error"] = "true";
    $result["data"] = "";
    echo json_encode($result);
    exit();
}

$sql = "UPDATE client_profile SET "
        . "`range` = '" . $range . "', "
        . "maxPrice = '" . $maxPrice . "', "
        . "is24 = '" . $is24 . "', "
        . "isCovered= '" . $isCovered . "' "
        . "WHERE client_id = " . $clientID;

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
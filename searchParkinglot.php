<?php

/**
 * Nombre           : searchParkinglot.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza la busqueda de un establecimiento, en funcion                                                         
 *                  : de las preferencias del usuario                                                      
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

require_once "config/db.php";
require_once "commons/commons.php";
require_once "selectors/parkingSelector.php";

$type           = INPUT_GET;

$clientID       = filter_input($type, "client_id");
$vehicleTypeID  = filter_input($type, "vt_id");
$lat            = filter_input($type, "lat");
$lng            = filter_input($type, "lng");

$exp = $clientID == NULL || $vehicleTypeID == NULL || $lat == NULL || $lng == NULL;
if ($exp) {
    $result = array();
    echo json_encode($result);
    exit();
}
$result = getParkinglotsByProfile($clientID, $vehicleTypeID, $lat, $lng);
echo json_encode($result);


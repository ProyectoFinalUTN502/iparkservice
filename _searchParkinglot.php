<?php

/**
 * Nombre           : searchParkinglot.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza la busqueda de un establecimiento, en funcion                                                         
 *                  : de las preferencias del usuario                                                      
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

require_once 'config/db.php';
require_once 'selectors/parkingSelector.php';

$type       = INPUT_POST;
$clientID   = filter_input($type, "client_id");
$lat        = filter_input($type, "lat");
$lng        = filter_input($type, "lng");

$criteria = getCriteria($clientID, $lat, $lng);
$parkinglots = getParkinglots($criteria);

$result = array();
foreach ($parkinglots as $p) {
    array_push($result, $p);
}

echo json_encode($result);


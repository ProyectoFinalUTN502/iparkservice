<?php

/**
 * Nombre           : searchParkinglotParam.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza la busqueda de un establecimiento, en funcion                                                         
 *                  : de nuevas preferencias de busqueda
 * Fecha            : Octubre 2016                                                         
 * Observaciones    :     
 */

require_once "config/db.php";
require_once "commons/commons.php";
require_once "selectors/parkingSelector.php";

$type           = INPUT_GET;

$vehicleTypeID  = filter_input($type, "vt_id");
$lat            = filter_input($type, "lat");
$lng            = filter_input($type, "lng");
$range          = filter_input($type, "range");
$price          = filter_input($type, "price");
$is24           = filter_input($type, "is24");
$isCovered      = filter_input($type, "isCovered");

$exp = $vehicleTypeID == NULL || $lat == NULL || $lng == NULL;
if ($exp) {
    $result = array();
    echo json_encode($result);
    exit();
}

$result = getParkinglotsByParam($vehicleTypeID, $lat, $lng, $range, $price, $is24, $isCovered);
echo json_encode($result);




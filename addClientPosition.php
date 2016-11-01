<?php

/**
 * Nombre           : addClientPosition.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza la carga de la posicion de un usuario                                                       
 * Fecha            : Octubre 2016                                                         
 * Observaciones    :     
 */
require_once "config/db.php";
require_once "selectors/clientSelector.php";
require_once "commons/commons.php";

$type = INPUT_GET;

$x = filter_input($type, "x");
$y = filter_input($type, "y");
$macAddress = filter_input($type, "mac");

$exp = ($x == NULL || $y == NULL || $macAddress == NULL);

if ($exp) {
    $result = array();
    $result["error"] = "true";
    $result["data"] = "";

    echo json_encode($result);
    exit();
}

$clientID = getClientByMacAddress(strtoupper($macAddress));

if ($clientID == "") {
    $result = array();
    $result["error"] = "true";
    $result["data"] = "";

    echo json_encode($result);
    exit();
}

$x = preparePosition($x);
$y = preparePosition($y);

$sql = "INSERT INTO real_time_position (xPoint, yPoint, client_id) "
        . "VALUES ('" . $x . "', '" . $y . "', '" . $clientID . "');";

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

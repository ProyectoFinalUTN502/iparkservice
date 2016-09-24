<?php

/**
 * Nombre           : real.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Prueba de Carga de Posicion con Rasberry Pi                                                       
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */
require_once '../config/db.php';
require_once '../selectors/clientSelector.php';

$type = INPUT_POST;

$x = filter_input($type, "x");
$y = filter_input($type, "y");
$macAddress = filter_input($type, "mac");

$exp = $x == NULL | $y == NULL | $macAddress == NULL;
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

$x = ($x < 0.5) ? 0.5 : $x;
$y = ($y < 0.5) ? 0.5 : $y;

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
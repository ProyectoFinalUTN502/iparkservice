<?php

/**
 * Nombre           : real.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Prueba de Carga de Posicion con Rasberry Pi                                                       
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */
require_once "../config/db.php";
require_once "../selectors/clientSelector.php";

$type = INPUT_POST;

$x = filter_input($type, "x");
$y = filter_input($type, "y");
$macAddress = filter_input($type, "mac");

$exp = $x == NULL | $y == NULL | $macAddress == NULL;
if ($exp) {
    $result = array();
    $result["error"] = "falta valores";
    $result["data"] = "";

    echo json_encode($result);
    exit();
}

$clientID = getClientByMacAddress(strtoupper($macAddress));

if ($clientID == "") {
    $result = array();
    $result["error"] = "es esta";
    $result["data"] = "";

    echo json_encode($result);
    exit();
}

$xRounded = round($x, 1, PHP_ROUND_HALF_UP);
$yRounded = round($y, 1, PHP_ROUND_HALF_UP);

$xn = explode(".", $xRounded);
$yn = explode(".", $yRounded);

if ($xn[1] < 5) {
    $x = $xn[0] . ".0";
} elseif($xn[1] == 5) {
    $x = $xn[0] . ".5";
} elseif($xn[1] > 5) {
    $t = $xn[0] + 1;
    $x = $t;
}

if ($yn[1] < 5) {
    $y = $yn[0] . ".0";
} elseif($yn[1] == 5) {
    $y = $yn[0] . ".5";
} elseif($yn[1] > 5) {
    $t = $yn[0] + 1;
    $y = $t;
}

$sql = "INSERT INTO real_time_position (xPoint, yPoint, client_id) "
        . "VALUES ('" . $x . "', '" . $y . "', '" . $clientID . "');";

$op = executeNonQuery($sql);

$result = array();

if ($op == false) {
    $result["error"] = "fallo todo";
    $result["data"] = "";
} else {
    $result["error"] = "false";
    $result["data"] = "";
}

echo json_encode($result);

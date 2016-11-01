<?php
/**
 * Nombre           : rtPosition.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      :                                                   
 * Fecha            : Octubre 2016                                                         
 * Observaciones    :     
 */

require_once "config/db.php";

$type   = INPUT_POST;
$id     = filter_input($type, "id");
$maxX   = filter_input($type, "maxX");
$maxY   = filter_input($type, "maxY");

if ($id == NULL) {
    $result = array();
    $result["status"] = RESULT_ERROR;
    $result["id"] = "";
    $result["x"] = "";
    $result["y"] = "";
    echo json_encode($result);
    exit();
}

$sql = "SELECT * FROM real_time_position "
        . "WHERE client_id = " . $id . " "
        . "ORDER BY id DESC LIMIT 1";
$op = executeQuery($sql);

$row = $op->fetch_assoc();
if ($row == null) {
    $result = array();
    $result["status"] = RESULT_ERROR;
    $result["id"] = "";
    $result["x"] = "";
    $result["y"] = "";
    echo json_encode($result);
    exit();
}

$x = ($row["xPoint"] / MIN_DISTANCE);
$y = ($row["yPoint"] / MIN_DISTANCE);

// Calculo las medidas por defecto
$x = ($x < 0) ? 0 : $x;
$y = ($y < 0) ? 0 : $y; 

// Calculo las medidas por exceso
$x = ($x >= $maxX) ? ($x - 1) : $x;
$y = ($y >= $maxY) ? ($y - 1) : $y; 

$result             = array();
$result["status"]   = RESULT_OK;
$result["id"]       = $row["id"];
$result["x"]        = $x;
$result["y"]        = $y;

echo json_encode($result);


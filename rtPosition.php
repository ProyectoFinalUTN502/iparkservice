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

/* Esto transforma:
 *
 * 1.83 => 1.8
 * 1.86 => 1.9
 * 1.89 => 1.9
 */
$roundX = round($row["xPoint"], 1, PHP_ROUND_HALF_UP);
$roundY = round($row["yPoint"], 1, PHP_ROUND_HALF_UP);
/*
 * Con la fraccion redondeada a un decimal, ahora la transformo
 * en un numero entero, convirtiendo:
 * 
 * 1.9 => 2
 * 1.5 => 2
 * 1.4 => 1
 * 1.2 => 1
 * 
 * NOTA: Si se usa ceil() en lugar de round(), los valores como 1.1 van a ser
 * automaticamente redondeados hacia arriba, o hacia abajo si se usa floor()
 */
$x = round($roundX);
$y = round($roundY);

$result             = array();
$result["status"]   = RESULT_OK;
$result["id"]       = $row["id"];
$result["x"]        = $x;
$result["y"]        = $y;

echo json_encode($result);


<?php

/**
 * Nombre           : clearClientPosition.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Elimina las viejas posiciones de Usuario, luego de que
 *                  : este, haya estacionado                                                       
 * Fecha            : Octubre 2016                                                         
 * Observaciones    :     
 */
require_once "config/db.php";

$type = INPUT_GET;
$id = filter_input($type, "id");

if ($id == NULL) {
    $result = array();
    $result["error"] = "true";
    $result["data"] = "";

    echo json_encode($result);
    exit();
}

$sql = "DELETE FROM real_time_position WHERE client_id = " . $id;
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

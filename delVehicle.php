<?php

/**
 * Nombre           : delVehicle.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Elimina un vehiculo a los vehiculos de un Cliente                                                           
 *                  :                                   
 * Fecha            : Octubre 2016                                                         
 * Observaciones    :     
 */

require_once 'config/db.php';

$type   = INPUT_GET;
$id     = filter_input($type, "id");

$exp = ($id == NULL);
if ($exp) {
    $result = array();
    $result["error"] = "true";
    $result["data"] = "";
    
    exit();
}

$sql = "UPDATE vehicle SET isActive= " . NOT_ACTIVE . " WHERE id=" . $id;
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
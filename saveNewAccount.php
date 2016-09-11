<?php

/**
 * Nombre           : saveNewAccount.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Activa la cuenta previamente creada por el Cliente                                                
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    : El cliente debe haber generado su usuario, registrado su
 *                  : perfil, y asociado un Vehiculo    
 */

require_once 'config/db.php';

$type       = INPUT_GET;
$clientID   = filter_input($type, "client_id");


$sql = "UPDATE client SET isActive = " . ACTIVE . " WHERE id = " . $clientID;

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
<?php

/**
 * Nombre           : cancelNavigation.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza la cancelacion del proceso de navegacion liberando
 *                  : la posicion que fue reservada previamente                                                       
 * Fecha            : Octubre 2016                                                         
 * Observaciones    :     
 */

require_once 'config/db.php';

$type = INPUT_GET;

$id = filter_input($type, "id");

$sql = "UPDATE layout_position SET state='" . LAYOUT_FREE . "' WHERE id=" . $id;
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
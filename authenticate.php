<?php 

/**
 * Nombre           : authenticate.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza la acreditacion de un cliente en el sistema                                                        
 *                  :                                                       
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

require_once 'config/db.php';

$type = INPUT_POST;

$email      = filter_input($type, "email");
$password   = filter_input($type, "password");

$sql = "SELECT * FROM client WHERE "
        . "email = '" . $email . "' AND "
        . "password = '" . $password . "' AND "
        . "isActive = " . ACTIVE . " LIMIT 1";

$op = executeQuery($sql);


$result = array();
$row = $op->fetch_assoc();
if ($row != NULL) {
    $result["error"] = "false";
    $result["data"] = "";
} else {
    $result["error"] = "true";
    $result["data"] = "";
}

echo json_encode($result);
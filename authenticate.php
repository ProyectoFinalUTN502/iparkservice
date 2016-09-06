<?php 

/**
 * Nombre           : authenticate.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza la acreditacion de un cliente en el sistema                                                        
 *                  :                                                       
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

require_once 'db.php';

$type = INPUT_GET;

$email      = filter_input($type, "email");
$password   = filter_input($type, "password");

$hashedPass = md5($password);

$sql = "SELECT * FROM client WHERE email = '" . $email . "' AND "
        . "password = '" . $hashedPass . "' LIMIT 1";

$op = executeQuery($sql);


$result = array();
while($row = $op->fetch_assoc()) {

    $val                = array();
    $val["token"]       = $row["token"];
    $val["email"]       = $row["email"];
    $val["name"]        = $row["name"];
    $val["lastName"]    = $row["lastName"];
    
    array_push($result, $val);
}

echo json_encode($result);
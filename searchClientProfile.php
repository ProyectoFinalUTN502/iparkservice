<?php

/**
 * Nombre           : searchClientProfile.php                                                          
 * Autor            : Grupo 502
 * Descripcion      : Obtiene el Perfil de Busqueda para un determinado  Cliente                                                         
 * Fecha            : Octubre 2016                                                         
 * Observaciones    : 
 */


require_once "config/db.php";

$type       = INPUT_GET;
$clientID   = filter_input(INPUT_GET, "client_id");

if ($clientID == NULL) {
    $result = array();
    echo json_encode($result);
    exit();
}

$sql = "SELECT * FROM client_profile WHERE client_id = " . $clientID . " LIMIT 1";

$op = executeQuery($sql);

$result = array();
if (($row = $op->fetch_assoc()) != NULL) {
    $result["id"]        = $row["id"];
    $result["range"]     = $row["range"];
    $result["maxPrice"]  = $row["maxPrice"];
    $result["is24"]      = $row["is24"];
    $result["isCovered"] = $row["isCovered"];
}

echo json_encode($result);
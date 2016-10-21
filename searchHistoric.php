<?php

/**
 * Nombre           : searchHistoric.php                                                          
 * Autor            : Grupo 502
 * Descripcion      : Obtiene las ultimas 10 posiciones donde estaciono                                                         
 *                  : el Cliente                                                         
 * Fecha            : Octubre 2016                                                         
 * Observaciones    : Depende de vw_historic    
 */

require_once "config/db.php";
require_once "commons/commons.php";

$type       = INPUT_GET;
$clientID   = filter_input(INPUT_GET, "cl_id");

if ($clientID == NULL) {
    $result = array();
    echo json_encode($result);
    exit();
}

$sql = "SELECT * FROM vw_historic 
        WHERE client_id = " . $clientID . " ORDER BY id DESC LIMIT 10";

$op = executeQuery($sql);

$result = array();
while ($row = $op->fetch_assoc()) {
    $encodedRow = utf8ize($row);
    array_push($result, $encodedRow);
}

echo json_encode($result);
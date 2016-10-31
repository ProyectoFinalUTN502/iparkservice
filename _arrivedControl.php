<?php

/**
 * Nombre           : reRoutingControl.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza el control de una posicion                                                        
 * Fecha            : Octubre 2016                                                         
 * Observaciones    :     
 */

require_once "config/db.php";
require_once "selectors/layoutSelector.php";
require_once "selectors/clientSelector.php";
require_once "commons/commons.php";

$type       = INPUT_GET;
$id         = filter_input($type, "id");
$clientID   = filter_input($type, "cl_id");

if ($id == NULL || $clientID == NULL) {
    echo RESULT_OK;
    exit();
}

$pos = getLayoutPosition($id);
$cliPos = getClientPosition($clientID);

if ($pos != false && $cliPos != false) {
    
    $match = ($pos["xPoint"] == $cliPos["xPoint"] && $pos["yPoint"] == $cliPos["yPoint"]);
    
    if ($pos["state"] == LAYOUT_BOOKED && $match == true) {
        // Llegue al Estacionamiento
        echo RESULT_PARK;
    } else {
        echo RESULT_OK;
    }
    
} else {
    echo RESULT_OK;
}



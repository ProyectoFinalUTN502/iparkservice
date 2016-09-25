<?php

require_once '../config/db.php';
require_once '../selectors/layoutSelector.php';
require_once '../selectors/clientSelector.php';
require_once '../commons/commons.php';

$type       = INPUT_POST;
$id         = filter_input($type, "id");
$clientID   = filter_input($type, "client_id");

if ($id == NULL || $clientID == NULL) {
    echo RESULT_ERROR;
    exit();
}

$pos = getLayoutPosition($id);
$cliPos = getClientPosition($clientID);

if ($pos != false && $cliPos != false) {
    
    $match = ($pos["xPoint"] == $cliPos["xPoint"] && $pos["yPoint"] == $cliPos["yPoint"]);
    
    if ($pos["state"] == LAYOUT_UNAVAILABLE && $match == false) {
        // Ya hay alguien estacionado, pero yo no soy
        echo RESULT_RECALCULATE;
    } elseif ($pos["state"] == LAYOUT_BOOKED && $match == true) {
        // Llegue al Estacionamiento
        echo RESULT_PARK;
    } else {
        echo RESULT_OK;
    }
    
} else {
    echo RESULT_ERROR;
}



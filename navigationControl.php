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

$type   = INPUT_GET;
$id     = filter_input($type, "id");

if ($id == NULL) {
    echo RESULT_OK;
    exit();
}

$pos = getLayoutPosition($id);
if ($pos != false) {
    
    if ($pos["state"] == LAYOUT_UNAVAILABLE) {
        // La posicion esta ocupada
       echo RESULT_ERROR;
    } else {
        echo RESULT_OK;
    }
} else {
    echo RESULT_OK;
}



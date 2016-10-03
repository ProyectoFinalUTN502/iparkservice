<?php

/**
 * Nombre           : clientSelector.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Funciones que facilitan la seleccion de un Cliente
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

require_once '../config/db.php';

function getClientByMacAddress($macAddress) {
    
    $result = "";
    $sql    = "SELECT * FROM client_mac WHERE macAddress = '" . $macAddress . "' LIMIT 1";
    $op     = executeQuery($sql);
    
    $row = $op->fetch_assoc();
    if ($row != NULL) {
        $result = $row["client_id"];
    }
    
    return $result;
}

function getClientPosition($clientID) {
    $result = false;
    $sql    = "SELECT * FROM real_time_position 
               WHERE client_id = " . $clientID . " ORDER BY id DESC LIMIT 1";
    $op     = executeQuery($sql);
    
    $row = $op->fetch_assoc();
    if ($row != NULL) {
        $result = $row;
    }
    
    return $result;
}
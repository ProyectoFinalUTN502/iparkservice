<?php

/**
 * Nombre           : parkingSelector.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza la seleccion de los establecimientos que cumplen
 *                  : con las preferencias de busqueda de los clientes                          
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

function getParkinglotsByParam($vehicleTypeID, $lat, $lng, $range, $price, $is24, $isCovered) {
    $result = array();
    
    $args   = $vehicleTypeID . ", " . $lat . ", " . $lng . ", " . $range . ", " . $price . ", " . $is24 . ", " . $isCovered;
    $sql    = "call searchParkinglotBy(" . $args . ");";
    $op     = executeQuery($sql);
    
    while($row = $op->fetch_assoc()){
        array_push($result, $row);
    }
    
    return $result;
}

function getParkinglotsByProfile($clientID, $vehicleTypeID, $lat, $lng) {
    
    $result = array();
    
    $sql    = "CALL searchParkinglot(" . $clientID . ", " . $vehicleTypeID . ", " . $lat . ", " . $lng . ");";
    $op     = executeQuery($sql);
    
    while($row = $op->fetch_assoc()){
        array_push($result, $row);
    }
    
    return $result;
}

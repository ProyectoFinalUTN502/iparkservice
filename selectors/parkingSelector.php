<?php

/**
 * Nombre           : parkingSelector.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Funciones que facilitan la seleccion de un Establecimiento                       
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

function getParkinglotsByParam($vehicleTypeID, $lat, $lng, $range, $price, $is24, $isCovered) {
    $result = array();
    
    $args   = $vehicleTypeID . ", " . $lat . ", " . $lng . ", " . $range . ", " . $price . ", " . $is24 . ", " . $isCovered;
    $sql    = "call searchParkinglotBy(" . $args . ");";
    $op     = executeQuery($sql);
    
    while($row = $op->fetch_assoc()){
        $encodedRow = utf8ize($row);
        array_push($result, $encodedRow);
    }
    
    return $result;
}

function getParkinglotsByProfile($clientID, $vehicleTypeID, $lat, $lng) {
    $result = array();
    
    $sql    = "CALL searchParkinglot(" . $clientID . ", " . $vehicleTypeID . ", " . $lat . ", " . $lng . ");";
    $op     = executeQuery($sql);
    
    while($row = $op->fetch_assoc()){
        $encodedRow = utf8ize($row);
        array_push($result, $encodedRow);
    }
    
    return $result;
}
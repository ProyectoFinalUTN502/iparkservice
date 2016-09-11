<?php

/**
 * Nombre           : parkingSelector.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza la seleccion de los establecimientos que cumplen
 *                  : con las preferencias de busqueda de los clientes                          
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

require_once 'config/db.php';

function getCriteria($clientID, $lat, $lng) {
    
    $result = "";
    $sql    = "SELECT * FROM profile WHERE client_id = " . $clientID . " LIMIT 1";
    $op     = executeQuery($sql);
    
    $row = $op->fetch_assoc();
    if ($row != NULL) {
        
        /*
         * SELECT *, (3959 * acos(cos(radians('".$lat."')) * cos(radians(lat)) * cos( radians(long) - radians('".$lng."')) + sin(radians('".$lat."')) * 
sin(radians(lat)))) 
AS distance 
FROM carpark WHERE distance < 15 ORDER BY distance LIMIT 0 , 10
         * 
         * 
         * 
         */
        
        
    }
    
    return $result;
}

function getParkinglots($criteria = "") {
    
    $result     = false;
    $position   = array();
    $found      = false;
    
    $sql    = "SELECT * FROM layout WHERE parkinglot_id = " . $parkinglotID;
    $op     = executeQuery($sql);
    
    while($row = $op->fetch_assoc()){
        
        $layoutID = $row["id"];
        $position = getFirstFreePosition($layoutID, $vehicleTypeID);
        
        if (!empty($position)) {
            $found = true;
            break;
        }
    }
    
    if ($found) {
        // Reservo la posicion encontrada, para que otro no me la saque
        bookePosition($position);
        $result = $position;
    }
    
    return $result;
    
}
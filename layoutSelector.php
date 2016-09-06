<?php

/**
 * Nombre           : layoutSelector.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza la seleccion de la posicion en la que el cliente                                                         
 *                  : estacionara                                                         
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

require_once 'config/db.php';

function getPosition($parkinglotID, $vehicleTypeID) {
    
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

function getFirstFreePosition($layoutID, $vehicleTypeID) {

    $sql = "SELECT id, xPoint, yPoint FROM layout_position WHERE "
            . "layout_id = " . $layoutID . " AND "
            . "state = '" . LAYOUT_FREE . "' AND "
            . "valid = " . VALID_POSITION . " AND "
            . "vehicle_type_id  = " . $vehicleTypeID . " "
            . "ORDER BY id ASC LIMIT 1";
    
    $op = executeQuery($sql);
    
    $result = array();
    while ($row = $op->fetch_assoc()) {
        $result                 = array();
        $result["id"]           = $row["id"];
        $result["xPoint"]       = $row["xPoint"];
        $result["yPoint"]       = $row["yPoint"];
    }
    
    return $result;
}


/**
 * Marca como reservada una posicion en un layout<b>
 * Para eso el array debe contener el id
 * @param array $position La posicion a reservar
 * @return boolean TRUE si se reservo, FALSE caso contrario
 */
function bookePosition($position) {
    $sql = "UPDATE layout_position SET "
            . "state = " . LAYOUT_BOOKED . " "
            . "WHERE id = " . $position["id"];
    
    $result = executeNonQuery($sql);
    return $result;
}


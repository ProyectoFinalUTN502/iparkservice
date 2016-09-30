<?php

/**
 * Nombre           : layoutSelector.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Realiza la seleccion de la posicion en la que el cliente                                                         
 *                  : estacionara                                                         
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

require_once '../config/db.php';

/**
 * Devuelve la primer posicion libre de un establecimiento para un determinado
 * tipo de vehiculo
 * @param int $parkinglotID El ID del Establecimiento elegido
 * @param int $vehicleTypeID El ID del Tipo de Vehiculo conducido
 * @return array La posicion encontrada en caso de exito<br>Array Vacio caso 
 * contrario
 */
function getPosition($parkinglotID, $vehicleTypeID) {
    
    $result     = array();
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

function getInputPosition($layoutID) {
    $result = array();
    
    $sql = "SELECT id, xPoint, yPoint, layout_id FROM layout_position 
            WHERE layout_id = " . $layoutID . " AND din = " . ACTIVE . " LIMIT 1";
    
    $op = executeQuery($sql);
    
    $row = $op->fetch_assoc();
    if($row != NULL) {
        $result["id"]           = $row["id"];
        $result["xPoint"]       = $row["xPoint"];
        $result["yPoint"]       = $row["yPoint"];
        $result["layout_id"]    = $row["layout_id"];
    }
    
    return $result;
}

function getOutputPosition($layoutID){
    $result = array();
    
    $sql = "SELECT id, xPoint, yPoint, layout_id FROM layout_position 
            WHERE layout_id = " . $layoutID . " AND dout = " . ACTIVE . " LIMIT 1";
    
    $op = executeQuery($sql);
    
    $row = $op->fetch_assoc();
    if($row != NULL) {
        $result["id"]           = $row["id"];
        $result["xPoint"]       = $row["xPoint"];
        $result["yPoint"]       = $row["yPoint"];
        $result["layout_id"]    = $row["layout_id"];
    }
    
    return $result;
}

function getFirstFreePosition($layoutID, $vehicleTypeID) {

    $result = array();
    
    $sql = "SELECT 
                id, xPoint, yPoint, layout_id, floor, maxRows, maxCols 
            FROM 
                vw_layout 
            WHERE 
                layout_id = " . $layoutID . " AND 
                state = '" . LAYOUT_FREE . "' AND 
                valid = " . VALID_POSITION . " AND 
                vehicle_type_id  = " . $vehicleTypeID . " 
            ORDER BY 
                id ASC 
            LIMIT 1";
    
    $op = executeQuery($sql);
    
    $row = $op->fetch_assoc();
    if($row != NULL) {
        $result = $row;
    }
    
    return $result;
}

function getLayouGraph($layoutID, $x, $y) {
    $result = array();
    $avilable       = getAvailablePositions($layoutID);
    $unAvailable    = getUnavailablePostitions($layoutID, $x, $y);
    
    foreach($avilable as $a) {
        array_push($result, $a);
    }
    
    foreach($unAvailable as $u) {
        array_push($result, $u);
    }
    
    return $result;
    
}

function getAvailablePositions($layoutID) {
    $result = array();
    
    $sql = "SELECT 
                id, xPoint, yPoint, circulationValue
            FROM 
                layout_position 
            WHERE 
                layout_id = " . $layoutID . " AND
                valid = " . VALID_POSITION . " AND 
                din = " . INVALID_POSITION . " AND 
                dout = " . INVALID_POSITION . " AND 
                rin = " . INVALID_POSITION . " AND 
                rout = " . INVALID_POSITION . " AND 
                vehicle_type_id IS NULL";
    
    $op = executeQuery($sql);
    
    while (($row = $op->fetch_assoc())) {
        $pos = array(
            $row["yPoint"],
            $row["xPoint"],
            ($row["circulationValue"] * 10)
        );
        array_push($result, $pos);
    }
    
    return $result;
}

function getUnavailablePostitions($layoutID, $x, $y) {
    $result = array();
    
    $sql = "SELECT 
                xPoint,
                yPoint
            FROM 
                layout_position lp1 
            WHERE 
                layout_id = " . $layoutID . " AND 
                lp1.id NOT IN
                (   
                    SELECT 
                        lp2.id 
                    FROM 
                        layout_position lp2 
                    WHERE 
                        layout_id = " . $layoutID . " AND
                        valid = " . VALID_POSITION . " AND 
                        din = " . INVALID_POSITION . " AND 
                        dout = " . INVALID_POSITION . " AND 
                        rin = " . INVALID_POSITION . " AND 
                        rout = " . INVALID_POSITION . " AND 
                        vehicle_type_id IS NULL
                )";
    
    $op = executeQuery($sql);
    
    while (($row = $op->fetch_assoc())) {
        $exp = ($row["xPoint"] == $x && $row["yPoint"] == $y);
        if ($exp) {
            continue;
        } else {
            // Va la columna primero
            $pos = array(
                $row["yPoint"],
                $row["xPoint"],
                PATH_WALL
            );

            array_push($result, $pos);
        }
    }
    
    
    return $result;
}

/**
 * 
 * @param type $layoutID
 * @param type $x
 * @param type $y
 * @return array
 */
function getControlPosition($layoutID, $x, $y) {
    $result = array();
    
    $sql = "SELECT 
                lp.*, vt.name  
            FROM layout_position lp 
            LEFT JOIN vehicle_type vt ON lp.vehicle_type_id = vt.id
            WHERE 
                layout_id = " . $layoutID . " AND 
                xPoint = " . $x . " AND 
                yPoint = " . $y . " LIMIT 1" ;
    
    $op = executeQuery($sql);
    
    $result = $op->fetch_assoc();
    return $result;
}

function changeStatePosition($id, $state) {
    $sql = "UPDATE layout_position SET "
            . "state = '" . $state . "' "
            . "WHERE id = " . $id;
    $result = executeNonQuery($sql);
    return $result;
}

function getLayoutPosition($id) {
    $result = false;
    $sql = "SELECT * FROM layout_position WHERE id = " . $id . " LIMIT 1";
    $op = executeQuery($sql);
    $row = $op->fetch_assoc();
    
    if ($row != NULL) {
        $result = $row;
    }
    
    return $result;
}

function bookePosition($position) {
    $sql = "UPDATE layout_position SET "
            . "state = '" . LAYOUT_BOOKED . "' "
            . "WHERE id = " . $position["id"];
    
    $result = executeNonQuery($sql);
    return $result;
}


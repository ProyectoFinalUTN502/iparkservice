<?php

/**
 * Nombre           : commons.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Utilidades Comunes al Proyecto                    
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

function getPositionNumber($x, $y, $maxX, $maxY) {
    $return = 0;
    $pos = 0;
    for ($i = 0; $i < $maxX; $i ++) {
        for ($j = 0 ; $j < $maxY; $j ++) {
            if ($x == $i && $y == $j) {
                $return = $pos;
            }
            $pos ++;
        }
    }
    return $return;
}

function checkPosition($id) {
    $result = array();
    
    $sql = "SELECT * FROM layout_position WHERE id = " . $id . " LIMIT 1";
    $op = executeQuery($sql);
    $row = $op->fetch_assoc();
    
    if ($row != NULL) {
        
    }
    
    
    return $result;
}

function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}


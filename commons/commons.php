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

function send2Server($putty, $serverUser, $serverIp, $serverPort, $serverPassword, $serverFile) {
    $command = "start " . $putty . " " . $serverUser . "@" . $serverIp . " -P " . $serverPort . " -pw " . $serverPassword . " -m " . $serverFile;
    pclose(popen($command, "w"));
}

function send2Client($putty, $clientUser, $clientIp, $clientPort, $clientPassword, $clientFile) {
    $command = "start " . $putty . " " . $clientUser . "@" . $clientIp . " -P " . $clientPort . " -pw " . $clientPassword . " -m " . $clientFile;
    pclose(popen($command, "w"));
}

function preparePosition($data) {
    $r = round($data, 1, PHP_ROUND_HALF_UP);
    
    if (strpos($r, ".") == false) {
        $r = $r . ".0";
    }
    
    $n = explode(".", $r);
    
    $result = 0;
    if ($n[1] < POINT_SCALE) {
        $result = $n[0] . ".0";
    } elseif ($n[1] == POINT_SCALE) {
        $result = $n[0] . ("." . POINT_SCALE);
    } elseif ($n[1] > POINT_SCALE) {
        $t = $n[0] + 1;
        $result = $t;
    }

    return $result;
}

<?php

/**
 * Nombre           : db.php                                                          
 * Autor            : Grupo 502
 * Descripcion      : Contiene las funcionalidades basicas para operar con la                                                         
 *                  : Base de Datos                                                          
 * Fecha            : Septiembre 2016                                                          
 * Observaciones    : La Base de Datos es My Sql    
 */
require_once(dirname(__FILE__)."/config.php");


function connect() {

    global $db_config;
    
    $conn = new mysqli(
            $db_config["server"] . ": " . $db_config["port"], 
            $db_config["user"], 
            $db_config["password"], 
            $db_config["schema"]
            );
    
    if ($conn->connect_error) {
        $result = null;
    } else {
        $result = $conn;
    }
    
    return $result;
}

/**
 * Realiza la ejecucion de una Consulta <b>No Query</b>
 * @param string $sql Cadena con la instruccion SQL a ejecutar
 * @param boolean $returnLastID Si esta false, la funcion devuelve el ultimo ID 
 * insertado
 * @return mix Si returnLasID esta activo, retorna false o el ultimo id insertado,
 * si no, retorna un boolean con el estado de la operacion
 */
function executeNonQuery($sql, $returnLastID = false) {
    $result = false;
    $conn = connect();
    if($conn != null) {
        $result = $conn->query($sql);
        
        if ($returnLastID) {
            $result = $conn->insert_id;
        }
        
        close($conn);
    }
    
    return $result;
}

function executeQuery($sql) {
    $result = array();
    $conn = connect();
    if($conn != null) {
        $result = $conn->query($sql);
        close($conn);
    }
    
    return $result;
}

function close($conn) {
    $conn->close();
}

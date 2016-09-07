<?php

/**
 * Nombre           : validator.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Archivo en el que se incluyen todas las funciones de 
 *                  : validacion de campos en el sistema                                                        
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

require_once 'validator.php';

function clientValidator($macAddress, $email, $name, $lastName) {
    
    $result = true;
    
    $result = esVacio($macAddress) ? false : $result;
    $result = !validarMail($email) ? false : $result;
    $result = esVacio($name) ? false : $result;
    $result = esVacio($lastName) ? false : $result;
    
    return $result;
    
}

function profileValidator() {
    
}
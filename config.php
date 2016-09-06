<?php

/**
 * Nombre           : config.php                                                          
 * Autor            : Grupo 502
 * Descripcion      : Contiene la configuracion basica para operar                                                         
 *                  :                                                        
 * Fecha            : Septiembre 2016                                                          
 * Observaciones    :    
 */

$db_config              = array();
$db_config["server"]    = "localhost";
$db_config["port"]      = "3306";
$db_config["user"]      = "root";
$db_config["password"]  = "";
$db_config["schema"]    = "central_dev";

define("RESULT_OK", "OK");
define("RESULT_ERROR", "ERROR");
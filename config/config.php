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

// RESULTADOS OBTENIDOS
define("RESULT_OK", "OK");
define("RESULT_ERROR", "ERROR");

// ESTADOS DE LAYOUT
define("LAYOUT_FREE", "LIBRE");
define("LAYOUT_BOOKED", "RESERVADA");
define("LAYOUT_UNAVAILABLE", "NO DISPONIBLE");

// VALIDEZ DE LA POSICION
define("VALID_POSITION", 1);
define("INVALID_POSITION", 0);

define("ACTIVE", 1);
define("NOT_ACTIVE", 0);

// PATHFINDER
define("NOT_AVAILABLE", 255);

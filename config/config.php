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
define("RESULT_RECALCULATE", "Recalculate");
define("RESULT_PARK", "Park");

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
define("PATH_WALL", - 255);
define("PATH_INVALID", - 512);
define("PATH_OUT", -1024);
define("PATH_RIN", -2048);
define("PATH_ROUT", -2500);

// CALCULOS DE DISTANCIA
define("MIN_DISTANCE", 0.5);
define("POINT_SCALE", 5);
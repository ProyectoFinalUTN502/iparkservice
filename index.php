<?php

/**
 * Nombre           :                                                          
 * Autor            : 
 * Version          :                                                         
 * Descripcion      :                                                          
 *                  :                                                          
 * Fecha            :                                                          
 * Observaciones    :     
 */

echo "<h1>iParkService</h1>";

// Carga de Ejemplo Nuevo Cliente
$nc = "newClient.php?token=123&macAddress=22:00:44:55&email=cesarcappetto@gmail.com&password=123456&name=Cesar&lastName=Cappetto";
echo "<a href='" . $nc . "'>Nuevo Cliente</a>";
echo "<br><br>";

// Login de Ejemplo
$aut = "authenticate.php?email=cesar_cappetto@yahoo.com.ar&password=123456";
echo "<a href='" . $aut . "'>Login</a>";
echo "<br>";
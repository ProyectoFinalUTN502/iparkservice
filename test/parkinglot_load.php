<?php
require_once '../config/db.php';

$userName = "hsimpson";
$name = "Homero";
$lastName = "Simpson";
$password = md5("123456");

$lat = -34.5481148;
$lng = -58.5639373;

for ($i = 1; $i <= 30; $i++) {

    $sql = "INSERT INTO `user` (`user`, `password`, `name`, `lastName`, `email`, `rol_id`) "
            . "VALUES ('" . $userName . $i . "', '" . $password . "', '" . $name . "', '" . $lastName . "', 'hsimpson" . $i . "@gmail.com', 2);";
    
    $userID = executeNonQuery($sql, true);
    
    $lat = $lat + 0.00001;
    $lng = $lng + 0.00001;
    
    $sql = "INSERT INTO `parkinglot` (`ssid`, `name`, `description`, `address`, `isActive`, `isCovered`, `latMap`, `longMap`, `openTime`, `closeTime`, `user_id`, `city_id`) 
            VALUES ('HSIMPSON" . $i . "', 'The Simpsons " . $i . "', 'Establecimiento de Alta Calidad y Confianza', 'Artigas 1613', '1', '0', '" . $lat . "', '" . $lng . "', '06:00:00', '00:00:00', '" . $userID . "', '66');";
    
    $pkID = executeNonQuery($sql, true);
    
    $sql = "INSERT INTO `layout` (`floor`, `maxRows`, `maxCols`, `parkinglot_id`) "
            . "VALUES ('1', '5', '5'," . $pkID . ");";
    
    $layoutID = executeNonQuery($sql, true);
    
    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('0', '0', '0', '0', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);
    
    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('0', '1', '1', '0', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', '3');";
   
    executeNonQuery($sql);
    
    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('0', '2', '1', '0', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', '3');";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('0', '3', '1', '0', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', '3');";
   
    executeNonQuery($sql);
    
    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('0', '4', '1', '0', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', '3');";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('1', '0', '0', '0', '1', '0', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('1', '1', '1', '1', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);
    
    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('1', '2', '1', '2', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('1', '3', '1', '3', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('1', '4', '1', '4', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);
    
    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('2', '0', '0', '0', '0', '1', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('2', '1', '1', '12', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('2', '2', '1', '7', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('2', '3', '1', '6', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('2', '4', '1', '5', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('3', '0', '0', '0', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('3', '1', '1', '11', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('3', '2', '1', '10', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('3', '3', '1', '9', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);
    
    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('3', '4', '1', '8', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);
    
    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('4', '0', '0', '0', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', NULL);";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('4', '1', '1', '0', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', '3');";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('4', '2', '1', '0', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', '3');";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('4', '3', '1', '0', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', '3');";
   
    executeNonQuery($sql);

    $sql = "INSERT INTO `layout_position` (`xPoint`, `yPoint`, `valid`, `circulationValue`, `din`, `dout`, `rIn`, `rOut`, `state`, `layout_id`, `vehicle_type_id`) "
            . "VALUES ('4', '4', '1', '0', '0', '0', '0', '0', 'LIBRE', '" . $layoutID . "', '3');";
   
    executeNonQuery($sql);
    
    
    
    $sql = "INSERT INTO `price` (`parkinglot_id`, `vehicle_type_id`, `price`) "
            . "VALUES (" . $pkID . ", 1, '50');";
    executeNonQuery($sql);
    $sql = "INSERT INTO `price` (`parkinglot_id`, `vehicle_type_id`, `price`) "
            . "VALUES (" . $pkID . ", 2, '50');";
    executeNonQuery($sql);
    $sql = "INSERT INTO `price` (`parkinglot_id`, `vehicle_type_id`, `price`) "
            . "VALUES (" . $pkID . ", 3, '50');";
    executeNonQuery($sql);
    $sql = "INSERT INTO `price` (`parkinglot_id`, `vehicle_type_id`, `price`) "
            . "VALUES (" . $pkID . ", 4, '50');";
    executeNonQuery($sql);
}

echo "<hr>";
echo "Carga Finalizada";
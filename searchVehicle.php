<?php

require_once "config/db.php";

$type       = INPUT_GET;
$clientID   = filter_input(INPUT_GET, "client_id");

if ($clientID == NULL) {
    
}

$sql = "SELECT * FROM vehicle WHERE client_id = " . $clientID . " AND isActive = " . ACTIVE;
$op = executeQuery($sql);

$result = array();
while ($row = $op->fetch_assoc()) {
    $b                      = array();
    $b["id"]                = $row["id"];
    $b["name"]              = $row["name"];
    $b["vehicleTypeID"]     = $row["vehicle_type_id"];
    $b["currentVehicle"]    = $row["currentVehicle"];
    array_push($result, $b);
}

echo json_encode($result);
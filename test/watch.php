<?php
require_once '../config/db.php';

$clientID = filter_input(INPUT_GET, "id");
if ($clientID == NULL) {
    exit();
}

$sql = "SELECT rtp.id, rtp.xPoint, rtp.yPoint, c.name  "
     . "FROM real_time_position rtp LEFT JOIN client c ON rtp.client_id = c.id  "
     . "WHERE client_id=" . $clientID . " ORDER BY id DESC LIMIT 1;";

$op = executeQuery($sql);
$data = $op->fetch_assoc();

$x = 0;
$y = 0;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8' content='1' http-equiv='REFRESH'></meta>
        <title>Watch</title>
        <style>
            .table { width: 50%; border-collapse: collapse; table-layout: fixed; }
            .table td { border: 1px solid black; height: 30px; }
        </style>
    </head>
    <body>
        <div>
            <?php 
                echo " xPoint = " . $data["xPoint"] . " | yPoint = " . $data["yPoint"] . "<hr>";
                
                if ($data != NULL) {
                    // ceil(round($data["xPoint"], 1, PHP_ROUND_HALF_UP) / 0.5);
                    $x = $data["xPoint"] / 0.5;
                    $y = $data["yPoint"] / 0.5;
                            
                }
                
                echo " x = " . $x . " | y = " . $y . "<hr>";
            ?>
        </div>
        <table class="table">
            <?php 
                for ($rows = 7; $rows >= 0; $rows --) {
                    echo "<tr>";
                    for ($cols = 0; $cols < 6; $cols ++) {
                        $pos = ($cols . " , " . $rows);
                        
                        if ($x == $cols && $y == $rows) {
                            echo "<td style='background-color: #000000; color: #FFFFFF;' align='center'>" . $data["name"] . "</td>";
                        } else {
                            echo "<td style='background-color: #FFFFFF;' align='center'>" . $pos . "</td>";
                        }
                    }
                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>

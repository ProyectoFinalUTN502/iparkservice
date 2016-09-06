<?php 

require_once 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    exit();
}

$sql = "SELECT id, name, lastName FROM person";
$op = $conn->query($sql);

$result = array();
while($row = $op->fetch_assoc()) {

    $val = array();
    $val["id"] = $row["id"];
    $val["name"] = $row["name"];
    $val["lastName"] = $row["lastName"];
    
    array_push($result, $val);
}

echo $op->num_rows . "<hr>";
//if ($op->num_rows > 0) {
//} 
$conn->close();


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8' content='1' http-equiv='REFRESH'></meta>
        <title></title>
        <script type="text/javascript" src="jquery-1.9.1.min.js"></script>
        <style>
            .layoutTable { width: 100%; border-collapse: collapse; }
            .layoutTable td { border: 1px solid black; height: 30px; }
        </style>
    </head>
    <body>
        <table class="layoutTable">
        <?php 
            $pos = 1;
            for ($i = 0; $i < 12; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 12; $j++) {
                    echo "<td id = " . $pos . " style='background-color: #f27dc5;' align='center'></td>";
                    $pos ++ ;
                }
                echo "</tr>";
            }
            
        
        ?>
        </table>
    </body>
    <script>
        function getRandID(min, max) {
            return Math.floor(Math.random() * (max - min) + min);
        }
        
        var selectedId = getRandID(1, 144);
        
        $("#" + selectedId).css("background-color", "#DDD");
        
    </script>
</html>

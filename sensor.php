<?php 

require_once "config/db.php";
require_once "selectors/layoutSelector.php";

$layoutID = filter_input(INPUT_GET, "id");

if ($layoutID == NULL) {
    echo "<h1>No se encontro un valor de Layout</h1>";
    echo "<p>Debe ingresar el identificador de Layout para poder cargar"
    . "el mapa de este</p>";
    exit();
}

$sql    = "SELECT * FROM layout WHERE id = " . $layoutID . " LIMIT 1";
$op     = executeQuery($sql);
$row    = $op->fetch_assoc();

$maxRows    = $row["maxRows"];
$maxCols    = $row["maxCols"];

?>
<!DOCTYPE html>
<html>
    <head>
        <!--<meta charset='UTF-8' content='1' http-equiv='REFRESH'></meta>-->
        <title></title>
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <style>
            .layoutTable { width: 50%; border-collapse: collapse; table-layout: fixed; }
            .layoutTable td { border: 1px solid black; height: 30px; }
        </style>
    </head>
    <body>
        <table id="layoutTable" class="layoutTable">
        <?php 
            for ($i = 0; $i < $maxRows ; $i++) {
                echo "<tr>";
                for ($j = 0; $j < $maxCols; $j++) {
                    $style = "";
                    $text = "";
                    
                    $pos = getControlPosition($layoutID, $i, $j);
                    
                    // Posiciones Validas para Estacionar
                    if ($pos["valid"] == VALID_POSITION && $pos["vehicle_type_id"] != "") {
                        
                        if ($pos["state"] == LAYOUT_FREE) {
                            $style = "style='background-color:#8cff66;'";
                            $text = "<b>" . $pos["name"] ."</b>";
                        } elseif ($pos["state"] == LAYOUT_BOOKED) {
                            $style = "style='background-color:#ff4d4d;'";
                            $text = "<b>" . $pos["name"] ."</b>";
                        }
                        
                    }
                    
                    // Posiciones No Validas para Estacionar
                    if ($pos["valid"] == INVALID_POSITION && $pos["vehicle_type_id"] == "") {
                        $style = "style='background-color:#909090;'";
                        $text = "";
                    }
                    
                    // Posiciones Ocupadas por otro Auto
                    if ($pos["state"] == LAYOUT_UNAVAILABLE) {
                        $style = "style='background-color:#000000;'";
                        $text = "";
                    }
                    
                    echo "<td data-id='" . $pos["id"] . "' " . $style ." align='center'>" . $text . "</td>";
                }
                echo "</tr>";
            }
        ?>
        </table>
       
    </body>
</html>
<script>
    $("#layoutTable").on("click", "td", function() {
        var id = $( this ).data("id");
        var color = hexc($( this ).css("background-color"));
        
        // Posicion Libre
        if (color === "#8cff66") {
            $(this).css("background-color", "#ff4d4d");  
            toogleLp(id, <?php echo "'" . LAYOUT_BOOKED . "'"; ?>);
        }
        
        // Posicion Reservada
        if (color === "#ff4d4d") {
            $(this).css("background-color", "#8cff66"); 
            toogleLp(id, <?php echo "'" . LAYOUT_FREE . "'"; ?>);
        }
        
        // Posicion Ocupada
        if (color === "#000000") {
            $(this).css("background-color", "#8cff66"); 
            toogleLp(id, <?php echo "'" . LAYOUT_FREE . "'"; ?>);
        }
         
   });   
   
    function hexc(colorval) {
        var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
        delete(parts[0]);
        for (var i = 1; i <= 3; ++i) {
            parts[i] = parseInt(parts[i]).toString(16);
            if (parts[i].length == 1) parts[i] = '0' + parts[i];
        }
        color = '#' + parts.join('');

        return color;
    }
    
    function toogleLp(id, state)
    {
        var parametros = {"id": id, "state" : state};

        $.ajax({
            data: parametros,
            url: "control_ajax.php",
            type: 'POST',
            beforeSend: function () { },
            success: function () {
                //location.reload();
            },
            error: function (xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            }
        });
    }
   
</script>
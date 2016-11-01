<?php 

require_once "config/db.php";
require_once "selectors/layoutSelector.php";

$layoutID = filter_input(INPUT_GET, "id");

if ($layoutID == NULL) {
    echo "<h2>No se encontro un valor de Layout</h2>";
    echo "<p>Debe ingresar el identificador de Layout para poder cargar"
    . "el mapa de este</p>";
    exit();
}

$sql    = "SELECT * FROM layout WHERE id = " . $layoutID . " LIMIT 1";
$op     = executeQuery($sql);
$row    = $op->fetch_assoc();

if ($row == NULL) {
    echo "<h2>No existe un Layout con ese Identificador</h2>";
    echo "<p>Debe ingresar el identificador de Layout para poder cargar"
    . "el mapa de este</p>";
    exit();
}

$maxRows = $row["maxRows"];
$maxCols = $row["maxCols"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sensor Inductivo</title>
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
                    $state = "data-state=''";
                    
                    $pos = getControlPosition($layoutID, $i, $j);
                    
                    // Posiciones Validas para Estacionar
                    if ($pos["valid"] == VALID_POSITION && $pos["vehicle_type_id"] != "") {
                        switch($pos["state"]) {
                            case LAYOUT_FREE:
                                $state  = "data-state='". LAYOUT_FREE ."'";
                                $style  = "style='background-color:#8cff66;'";
                                $text   = "<b>" . $pos["name"] ."</b>";
                                break;
                            case LAYOUT_BOOKED:
                                $state  = "data-state='" . LAYOUT_BOOKED . "'";
                                $style  = "style='background-color:#ff4d4d;'";
                                $text   = "<b>" . $pos["name"] ."</b>";
                                break;
                            case LAYOUT_UNAVAILABLE:
                                $state  = "data-state='" . LAYOUT_UNAVAILABLE . "'";
                                $style  = "style='background-color:#000000; color:#ffffff;'";
                                $text   = "<b>" . $pos["name"] ."</b>";
                                break;
                            default:
                                break;
                        }
                    }
                    
                    // Posicion de Entrada 
                    if ($pos["din"] == ACTIVE && $pos["valid"] == INVALID_POSITION && $pos["vehicle_type_id"] == "") {
                        // #66bfff
                        $style  = "style='background-color:#66bfff;'";
                        $text   = "<b>ENTRADA</b>";
                    }
                    
                    // Posicion de Salida
                    if ($pos["dout"] == ACTIVE && $pos["valid"] == INVALID_POSITION && $pos["vehicle_type_id"] == "") {
                        $style  = "style='background-color:#fff466;'";
                        $text   = "<b>SALIDA</b>";
                    }
                    
                    // Rampa de Subida
                    if ($pos["rIn"] == ACTIVE && $pos["valid"] == INVALID_POSITION && $pos["vehicle_type_id"] == "") {
                        $style  = "style='background-color:#d366ff;'";
                        $text   = "<b>&#62;</b>";
                    }
                    
                    // Rampa de Bajada
                    if ($pos["rOut"] == ACTIVE && $pos["valid"] == INVALID_POSITION && $pos["vehicle_type_id"] == "") {
                        $style  = "style='background-color:#d366ff;'";
                        $text   = "<b>&#60;</b>";
                    }
                    
                    // Posiciones No Validas para Estacionar
                    $exp = $pos["dout"] == NOT_ACTIVE && $pos["din"] == NOT_ACTIVE && 
                            $pos["rOut"] == NOT_ACTIVE && $pos["rIn"] == NOT_ACTIVE && 
                            $pos["valid"] == INVALID_POSITION && $pos["vehicle_type_id"] == "";
                    if ($exp) {
                        $style = "style='background-color:#909090;'";
                        $text = "";
                    }
                    
                    echo "<td " . $state . " data-id='" . $pos["id"] . "' " . $style ." align='center'>" . $text . "</td>";
                }
                echo "</tr>";
            }
        ?>
        </table>
        <br>
        <p>
            <b>Instrucciones:</b> La siguiente pagina muestra una vista en tiempo
            real de un mapa de un establecimiento.<br> 
            Haga click sobre la celda que desee modificar.<br>
            La actualizacion de la vista, debe hacerse en forma manual<br>
            El ciclo de estados se realiza de esta forma: <br><br>
            <b>Verde:</b> LIBRE<br>
            <b>Rojo:</b> RESERVADO<br>
            <b>Negro:</b> OCUPADO
        </p>
    </body>
</html>
<script>
    $("#layoutTable").on("click", "td", function() {
        var id          = $( this ).data("id");
        var state       = $( this ).data("state");
        var nextState   = "";
        
        switch (state) {
            case "<?php echo LAYOUT_FREE; ?>":
                        
                nextState = "<?php echo LAYOUT_BOOKED; ?>";
                $( this ).css("background-color","#ff4d4d");
                $( this ).data("state", nextState);
                toogleLp(id, nextState);
                console.log(nextState);
                break;
                
            case "<?php echo LAYOUT_BOOKED; ?>":
                        
                nextState = "<?php echo LAYOUT_UNAVAILABLE; ?>";
                $( this ).css("background-color","#000000");
                $( this ).css("color","#ffffff");
                $( this ).data("state", nextState);
                toogleLp(id, nextState);
                console.log(nextState);
                break;
                
            case "<?php echo LAYOUT_UNAVAILABLE; ?>":
                        
                nextState = "<?php echo LAYOUT_FREE; ?>";
                $( this ).css("background-color","#8cff66");
                $( this ).css("color","#000000");
                $( this ).data("state", nextState);
                toogleLp(id, nextState);
                console.log(nextState);
                break;
                
            default:
                break;
        }
   });   

    function toogleLp(id, state)
    {
        var parametros = {"id": id, "state" : state};

        $.ajax({
            data: parametros,
            url: "sensorTogle.php",
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
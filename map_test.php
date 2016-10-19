<html>
    <head>
        <script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
        <link href="css/style_test.css" rel="stylesheet">
        <title>iParking</title>
    </head>

    <body>
        <?php
        include "pathFinder/PathFinder.php";
        include "pathFinder/NodeGraph2D.php";

        // Columnas - Filas
        $NodeGraph = new NodeGraph2D($lyCols, $lyRows);
        $NodeGraph->set($lyGraph);
        
        $PathFinder = new PathFinder($NodeGraph);
        $Path = $PathFinder->Find($start, $end);

        $Table = Array();
        $Rendered = Array();
        
        if ($Path) {
            foreach ($Path as $Node) {
                list($X, $Y) = $NodeGraph->Node2XY($Node);
                $Rendered[$X][$Y] = 'cell path'; 
            }

            list($X, $Y) = $NodeGraph->Node2XY($start);
            $Rendered[$X][$Y] = 'cell start';
            list($X, $Y) = $NodeGraph->Node2XY($end);
            $Rendered[$X][$Y] = 'cell end'; 
            
            
            $Tiles = $NodeGraph->Tiles;
            foreach ($Tiles as $X => $Rows) {
                foreach ($Rows as $Y => $Value) {
                    if (isset($Rendered[$X][$Y])) {
                        $Table[$Y][$X] = $Rendered[$X][$Y];
                    } else {
                        switch ($Value) {
                            case PATH_WALL:
                                $Table[$Y][$X] = 'cell wall';
                                break;
                            case PATH_INVALID:
                                $Table[$Y][$X] = 'cell invalid';
                                break;
                            default:
                                $Table[$Y][$X] = 'cell';
                                break;
                        }
                    }
                }
            }
        }
        ?>
        
        <table class="table">
            <?php 
            foreach ($Table as $Y => $Cols) {
                echo "<tr class='row'>";
                foreach ($Cols as $X => $Class) {
                    echo "<td class='" . $Class . "'></td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </body>
</html>
<script>
    var tid = setInterval(controlProcess, 1000);
    function abortTimer() { 
      clearInterval(tid);
    }
    
    function controlProcess() {
        abortTimer();
        checkPosition();
    }
    
    function checkPosition() {
        var parametros = {
            "id": <?php echo $idPosition; ?>, 
            "client_id" : <?php echo $clientID; ?>
        };

        $.ajax({
            data: parametros,
            url: "check_position.php",
            type: 'POST',
            success: function (response) {
                tid = setInterval(controlProcess, 1000);
                if (response === '<?php echo RESULT_RECALCULATE; ?>') {
                    alert("La posicion se ha ocupado: Debe recalcular");
                    abortTimer();
                    location.reload();
                }
                
                if (response === '<?php echo RESULT_PARK; ?>') {
                    alert("Ha llegado a su Estacionamiento");
                    abortTimer();
                }
                
            },
            error: function (xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
                tid = setInterval(controlProcess, 1000);
            }
        });
    }
</script>



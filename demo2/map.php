<html>
    <head>
        <script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
        <style type="text/css">
            * {
                margin: 0px; padding: 0px;
            }

            table {
                width: 100%;
                height:100%;
                border-collapse: collapse;
            }

            td {
                border: 1px solid black;
            }

            .Start		{ background-color: #66F; }
            .End		{ background-color: #F33; }
            .Path		{ background-color: #9F9; }
            .Open		{ background-color: #252; }
            .Close		{ background-color: #4A4; }
            .Wall		{ background-color: #909090; }

        </style>
        <title>iParking</title>
    </head>

    <body>
        <?php
        include '../pathFinder/PathFinder.php';
        include '../pathFinder/NodeGraph2D.php';

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
                $Rendered[$X][$Y] = 'Path Dir' . $NodeGraph->Direction($PathFinder->Cache[$Node]['Parent'], $Node);
            }

            list($X, $Y) = $NodeGraph->Node2XY($start);
            $Rendered[$X][$Y] = 'Start';
            list($X, $Y) = $NodeGraph->Node2XY($end);
            $Rendered[$X][$Y] = 'End Dir' . $NodeGraph->Direction($PathFinder->Cache[$Node]['Parent'], $end);
            
            
            $Tiles = $NodeGraph->Tiles;
            foreach ($Tiles as $X => $Rows) {
                foreach ($Rows as $Y => $Value) {
                    if (isset($Rendered[$X][$Y])) {
                        $Table[$Y][$X] = $Rendered[$X][$Y];
                    } else {
                        $Table[$Y][$X] = $Value == PATH_WALL ? 'Wall' : 'Floor';
                    }
                }
            }
        }
        ?>
        
        <table>
            <?php 
            foreach ($Table as $Y => $Cols) {
                echo "<tr>";
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
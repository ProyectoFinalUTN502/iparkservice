<html>
    <head>
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <link href="css/style.css" rel="stylesheet">
        <title>iParking</title>
    </head>

    <body>
        <?php
        
        define("STYLE_WALL", "cell wall");
        define("STYLE_INVALID", "cell invalid");
        define("STYLE_CELL", "cell");
        define("STYLE_PATH", "cell path");
        define("STYLE_START", "cell start");
        define("STYLE_END", "cell end");
        define("STYLE_EXIT", "cell exit");
        define("STYLE_RIN", "cell rin");
        define("STYLE_ROUT", "cell rout");
        
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
                $Rendered[$X][$Y] = STYLE_PATH; 
            }

            list($X, $Y) = $NodeGraph->Node2XY($start);
            $Rendered[$X][$Y] = STYLE_START;
            
            list($X, $Y) = $NodeGraph->Node2XY($end);
            $Rendered[$X][$Y] = STYLE_END; 
            
            
            $Tiles = $NodeGraph->Tiles;
            foreach ($Tiles as $X => $Rows) {
                foreach ($Rows as $Y => $Value) {
                    if (isset($Rendered[$X][$Y])) {
                        $Table[$Y][$X] = $Rendered[$X][$Y];
                    } else {
                        switch ($Value) {
                            case PATH_WALL:
                                $Table[$Y][$X] = STYLE_WALL;
                                break;
                            case PATH_INVALID:
                                $Table[$Y][$X] = STYLE_INVALID;
                                break;
                            case PATH_OUT:
                                $Table[$Y][$X] = STYLE_EXIT;
                                break;
                            case PATH_RIN:
                                $Table[$Y][$X] = STYLE_RIN;
                                break;
                            case PATH_ROUT:
                                $Table[$Y][$X] = STYLE_ROUT;
                                break;
                            default:
                                $Table[$Y][$X] = STYLE_CELL;
                                break;
                        }
                    }
                }
            }
        }
        ?>
        
        <table id="mapTable" class="table">
            <?php 
            $xRender = 0;
            foreach ($Table as $Y => $Cols) {
                echo "<tr class='row'>";
                $yRender = 0;
                foreach ($Cols as $X => $Class) {
                    $content = "";
                    switch ($Class) {
                        case STYLE_END:
                            $content = "<img src='css/car.png' style='width:30px;height:30px;'/>";
                            break;
                        case STYLE_START:
                            $content = "<img src='css/position_1.png' style='width:30px;height:30px;'/>";
                            break;
                        case STYLE_WALL :
                            $content = "<img src='css/car.png' style='width:30px;height:30px;'/>";
                            break;
                        case STYLE_INVALID :
                            break;
                        case STYLE_EXIT:
                            $content = "<b>EXIT</b>";
                            break;
                        case STYLE_RIN:
                            $content = "<b>&#62;</b>";
                            break;
                        case STYLE_ROUT:
                            $content = "<b>&#60;</b>";
                            break;
                        case STYLE_CELL:
                            break;
                    }
                    echo "<td id='" . $xRender.$yRender . "' align='center' class='" . $Class . "'>" . $content . "</td>";
                    $yRender++;
                }
                echo "</tr>";
                $xRender++;
            }
            ?>
        </table>
    </body>
</html>
<script>
    var tidPosition;
    var tid = setInterval(controlProcess, 1000);
    
    var clientImage = "position_1.png";
    var clientContent = "<img src='css/position_1.png' style='width:30px;height:30px;'/>";
    var clientX;
    var clientY;
    
    function abortTimer(timer) { 
      clearInterval(timer);
    }
    
    function positionProcess() {
        abortTimer(tidPosition);
        animateClientPosition();
    }
    
    function controlProcess() {
        abortTimer(tid);
        updatePosition();
    }
    
    function updatePosition() {
        var parametros = { 
            "id"    : <?php echo $clientID; ?>,
            "maxX"  : <?php echo $lyRows; ?>,
            "maxY"  : <?php echo $lyCols; ?>
        };

        $.ajax({
            data: parametros,
            dataType: "json",
            url: "rtPosition.php",
            type: "POST",
            success: function (r) {
                tid = setInterval(controlProcess, 1000);
                
                if (r.status === "OK") {
                    clientX = r.x;
                    clientY = r.y;
                    updateClientPosition(clientX, clientY);
                    tidPosition = setInterval(positionProcess, 200);
                    console.log("id: " + r.id + " " + "x: " + r.x + " " + "y: " + r.y);
                } else {
                    console.log("No se pudo leer bien la posicion");
                }
            },
            error: function (xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
                tid = setInterval(controlProcess, 1000);
            }
        });
    }
    
    function updateClientPosition(x,y){
        var tid = x.toString() + "" + y.toString();
        
        console.log("Tid: " + tid);
        
        $("#mapTable td").each(function () {
            var content = $(this).html();
            if (content.indexOf(clientImage) >= 0) {
                $(this).html("");
            }
        });
        
        $("#mapTable #" + tid).html(clientContent);
    }
    
    function animateClientPosition() {
//        var tid = clientX.toString() + "" + clientY.toString();
//        var content = $("#mapTable #" + tid).html();
//        
//        if (content.indexOf(clientImage) >= 0) {
//            $("#mapTable #" + tid).html("");
//        } else {
//            $("#mapTable #" + tid).html(clientContent);
//        } 
//        tidPosition = setInterval(positionProcess, 200);
    }
</script>



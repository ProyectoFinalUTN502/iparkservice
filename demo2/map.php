<html>
    <head>
        <!--<meta charset='UTF-8' content='1' http-equiv='REFRESH'></meta>-->
        <style type="text/css">
            * {
                margin: 0px; padding: 0px;
            }

            table {
                width: 50%;
                height:50%;
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
            .Wall		{ background-color: #F99; }

        </style>
        <title>iParking</title>
    </head>

    <body>
        <?php
        include '../pathFinder/libPathfinding.php';
        include '../pathFinder/libNodeGraph.2D.php';

        // Columnas - Filas
        $NodeGraph = new NodeGraph2D($lyCols, $lyRows);
        $NodeGraph->set($lyGraph);
        
        $PathFinder = new PathFinding($NodeGraph);
        $Path = $PathFinder->Find($start, $end);

        if ($Path) {
            $Rendered = Array();

            foreach ($Path as $Node) {
                list($X, $Y) = $NodeGraph->Node2XY($Node);
                $Rendered[$X][$Y] = 'Path Dir' . $NodeGraph->Direction($PathFinder->Cache[$Node]['Parent'], $Node);
            }

            list($X, $Y) = $NodeGraph->Node2XY($start);
            $Rendered[$X][$Y] = 'Start';
            list($X, $Y) = $NodeGraph->Node2XY($end);
            $Rendered[$X][$Y] = 'End Dir' . $NodeGraph->Direction($PathFinder->Cache[$Node]['Parent'], $end);
            ?>
        
            <table>
            <?php
            $Table = Array();
            $Tiles = $NodeGraph->Tiles;
            foreach ($Tiles as $X => $Rows) {
                foreach ($Rows as $Y => $Value) {
                    if (isset($Rendered[$X][$Y])) {
                        $Table[$Y][$X] = $Rendered[$X][$Y];
                    } else {
                        $Table[$Y][$X] = $Value == 255 ? 'Wall' : 'Floor';
                    }
                }
            }

            foreach ($Table as $Y => $Cols) {
                echo "<tr>";
                foreach ($Cols as $X => $Class) {
                    echo "<td class='" . $Class . "'></td>";
                }
                echo "</tr>";
            }
            ?>
            </table>
            <?php

            }

            ?>

    </body>
</html>
<html>
    <head>
        <meta charset='UTF-8' content='1' http-equiv='REFRESH'></meta>
        <style type="text/css">
            * {
                margin: 0px; padding: 0px;
            }
/*            body {
                margin: 13px 0px 0px 0px;
                background: #000;
                color: #FFF;
            }*/

            table {
                width: 100%;
                height:100%;
                border-collapse: collapse;
            }

/*            td::selection {
                background: rgba(0,0,0,0.3);
                color: #FFF;
            }*/

            td {
                /*width: 20px;*/
                /*height: 40px;*/
                border: 1px solid black;
/*                text-align: center;
                color: rgba(0,0,0,0);*/
            }

/*            .Start, .End, .Path, .Open, .WasOpen, .Close {
                background-image: url('http://chromebackend.net/_img/NodesC.png');
                background-position: 40px 40px;
            }*/

            .Start		{ background-color: #66F; }
            .End		{ background-color: #F33; }
            .Path		{ background-color: #9F9; }
            .Open		{ background-color: #252; }
            .Close		{ background-color: #4A4; }
/*            .Floor		{ background-color: #333; }*/
            .Wall		{ background-color: #F99; }

            .Dir0		{ background-position: 40px 60px; } /* 0,-1*/
            .Dir1		{ background-position: 20px 40px; } /* 1, 0*/
            .Dir2		{ background-position: 40px 20px; } /* 0, 1*/
            .Dir3		{ background-position: 60px 40px; } /*-1, 0*/
            .Dir4		{ background-position: 20px 60px; } /* 1,-1*/
            .Dir5		{ background-position: 20px 20px; } /* 1, 1*/
            .Dir6		{ background-position: 60px 20px; } /*-1, 1*/
            .Dir7		{ background-position: 60px 60px; } /*-1,-1*/
        </style>
        <title>Path Finding</title>
    </head>

    <body>
        <?php
        include 'libPathfinding.php';
        include 'libNodeGraph.2D.php';

        $NodeGraph = new NodeGraph2D(12, 12);
        $NodeGraph->set(Array(
            array(1, 2, 255),
            array(2, 2, 255),
            array(3, 2, 255)
        ));

        $Start = 0; //$NodeGraph->Random();
        $End = 143; //$NodeGraph->Random();
//        while ($NodeGraph->H($Start, $End) < 25)
//            $End = $NodeGraph->Random();



        $PathFinder = new PathFinding($NodeGraph);
        $Path = $PathFinder->Find($Start, $End);

        if ($Path) {
            $Rendered = Array();
//            $Cache = $PathFinder->Cache;
//            foreach ($Cache as $Node => $Caching) {
//                list($X, $Y) = $NodeGraph->Node2XY($Node);
//                if ($Caching['Status'] == 1) {
//                    $Rendered[$X][$Y] = 'Open Dir' . $NodeGraph->Direction($Caching['Parent'], $Node);
//                } else if ($Caching['Status'] == 2) {
//                    $Rendered[$X][$Y] = 'Close Dir' . $NodeGraph->Direction($Caching['Parent'], $Node);
//                }
//            }

            foreach ($Path as $Node) {
                list($X, $Y) = $NodeGraph->Node2XY($Node);
                $Rendered[$X][$Y] = 'Path Dir' . $NodeGraph->Direction($PathFinder->Cache[$Node]['Parent'], $Node);
            }

            list($X, $Y) = $NodeGraph->Node2XY($Start);
            $Rendered[$X][$Y] = 'Start';
            list($X, $Y) = $NodeGraph->Node2XY($End);
            $Rendered[$X][$Y] = 'End Dir' . $NodeGraph->Direction($PathFinder->Cache[$Node]['Parent'], $End);
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

                //echo "<p>Pathfinding in " . round(($t2 - $t1) * 1000) . "msec</p></br>";
//
//                foreach ($Path as &$P) {
//                    $P = implode(' x ', $NodeGraph->Node2XY($P)); // For easier debugging.
//                }
//
//                echo '<pre>Path = ' . print_r($Path, TRUE) . '</pre></br>';

                //echo '<pre>$PathFinder = '.print_r($PathFinder->Cache, TRUE).'</pre></br>';
            } else {
//                echo "<p>Path not found</p></br><p>" . $PathFinder->Debug . "</p>";
//                echo '<pre>' . print_r($PathFinder, TRUE) . '</pre>';
            }
            ?>

    </body>
</html>
<html>
    <body>
        <div class="table">
            <div class="row">
                <div class="cell park left wall ocup"></div>
                <div class="cell"></div>
                <div class="cell park top first wall ocup"></div>
                <div class="cell park top wall ocup"></div>
                <div class="cell park top wall ocup"></div>
                <div class="cell park top wall ocup"></div>
                <div class="cell park top wall ocup"></div>
                <div class="cell park top wall ocup"></div>
                <div class="cell"></div>
                <div class="cell park right wall ocup"></div>
            </div>
            <div class="row">
                <div class="cell park left wall ocup"></div>
                <div class="cell"></div>
                <div class="cell"></div>
                <div class="cell"></div>
                <div class="cell"></div>
                <div class="cell"></div>
                <div class="cell"></div>
                <div class="cell"></div>
                <div class="cell"></div>
                <div class="cell park right wall"></div>
            </div>
            <div class="row">
                <div class="cell salida"></div>
                <div class="cell"></div>
                <div class="cell"></div>
                <div class="cell column"></div>
                <div class="cell column"></div>
                <div class="cell column"></div>
                <div class="cell column"></div>
                <div class="cell column"></div>
                <div class="cell"></div>
                <div class="cell park right wall"></div>
            </div>
            <div class="row">
                <div class="cell entrada left">
                    <img src="position_dot.png">
                </div>
                <div class="cell path corner bottom-left"></div>
                <div class="cell"></div>
                <div class="cell park top first wall"></div>
                <div class="cell park top wall"></div>
                <div class="cell park top wall"></div>
                <div class="cell park top wall"></div>
                <div class="cell park top wall"></div>
                <div class="cell"></div>
                <div class="cell park right wall"></div>
            </div>
            <div class="row">
                <div class="cell park left wall ocup"></div>
                <div class="cell path ver"></div>
                <div class="cell"></div>
                <div class="cell"></div>
                <div class="cell"></div>
                <div class="cell"></div>
                <div class="cell"></div>
                <div class="cell"></div>
                <div class="cell"></div>
                <div class="cell park right wall ocup"></div>
            </div>
            <div class="row">
                <div class="cell park left wall"></div>
                <div class="cell path ver"></div>
                <div class="cell park bottom first wall"></div>
                <div class="cell park bottom wall"></div>
                <div class="cell park bottom wall"></div>
                <div class="cell park bottom wall"></div>
                <div class="cell park bottom wall"></div>
                <div class="cell park bottom wall"></div>
                <div class="cell"></div>
                <div class="cell park right wall ocup"></div>
            </div>
            <div class="row">
                <div class="cell park left wall"></div>
                <div class="cell path ver"></div>
                <div class="cell column"></div>
                <div class="cell column"></div>
                <div class="cell column"></div>
                <div class="cell column"></div>
                <div class="cell column"></div>
                <div class="cell column"></div>
                <div class="cell"></div>
                <div class="cell park right wall ocup"></div>
            </div>
            <div class="row">
                <div class="cell park left wall ocup"></div>
                <div class="cell path ver"></div>
                <div class="cell park top first wall"></div>
                <div class="cell park top wall"></div>
                <div class="cell park top wall"></div>
                <div class="cell park top wall"></div>
                <div class="cell park top wall"></div>
                <div class="cell park top wall"></div>
                <div class="cell"></div>
                <div class="cell park right wall ocup"></div>
            </div>
            <div class="row">
                <div class="cell park left wall"></div>
                <div class="cell path corner top-right"></div>
                <div class="cell path hor"></div>
                <div class="cell path hor"></div>
                <div class="cell path hor"></div>
                <div class="cell path hor"></div>
                <div class="cell path hor"></div>
                <div class="cell path corner bottom-left"></div>
                <div class="cell"></div>
                <div class="cell park right wall ocup"></div>
            </div>
            <div class="row">
                <div class="cell park left wall last"></div>
                <div class="cell"></div>
                <div class="cell park bottom wall first ocup"></div>
                <div class="cell park bottom wall ocup"></div>
                <div class="cell park bottom wall"></div>
                <div class="cell park bottom wall ocup"></div>
                <div class="cell park bottom wall"></div>
                <div class="cell park bottom wall selected"></div>
                <div class="cell"></div>
                <div class="cell park right wall last ocup"></div>
            </div>
        </div>
    </body>


    <style>

        * {
            box-sizing:border-box;
        }

        div.table {
            display: table;
            width: 100%;
            height: 100%;
            table-layout:fixed;
            border: 3px solid gray;
            background-color: #FFFFE0;
        }

        div.row {
            display:table-row;
        }

        div.cell {
            display: table-cell;
            height: 50px;
            width: 50px;
        }

        div.cell.park.left {
            border-left: 3px solid #FFDB00;
            border-bottom: 3px solid #FFDB00;
        }

        div.cell.park.left.first {
            border-top: 3px solid #FFDB00;
        }

        div.cell.park.left.last {
            border-bottom: 0;
        }

        div.cell.park.left.wall {
            border-left: 0;
        }

        div.cell.park.right {
            border-right: 3px solid #FFDB00;
            border-bottom: 3px solid #FFDB00;
        }

        div.cell.park.right.first {
            border-top: 3px solid #FFDB00;
        }

        div.cell.park.right.last {
            border-bottom: 0;
        }

        div.cell.park.right.wall {
            border-right: 0;
        }

        div.cell.park.top {
            border-top: 3px solid #FFDB00;
            border-right: 3px solid #FFDB00;
        }

        div.cell.park.top.first {
            border-left: 3px solid #FFDB00; 
        }

        div.cell.park.top.last {
            border-right: 0;
        }

        div.cell.park.top.wall {
            border-top: 0;
        }

        div.cell.park.bottom {
            border-bottom: 3px solid #FFDB00;
            border-right: 3px solid #FFDB00;
        }

        div.cell.park.bottom.first {
            border-left: 3px solid #FFDB00;
        }

        div.cell.park.bottom.last {
            border-right: 0;
        }

        div.cell.park.bottom.wall {
            border-bottom: 0;
        }

        div.cell.ocup {
            background-image: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%,rgba(0,0,0,0.1) 100%), url("ocupado.png");
        }

        div.cell.column {
            background-image: linear-gradient(to bottom, rgba(0,0,0,0.6) 0%,rgba(0,0,0,0.6) 100%), url("ocupado.png");
        }

        div.cell.entrada.left {
            background: #7db831;
            /*background: linear-gradient(to right, #7db831 0%, #7db831 50%, transparent 50%), linear-gradient(to bottom, transparent 46%, #7db831 46%, #7db831 54%, transparent 54%);*/
        }

        div.cell.entrada.right {
            background: #7db831;
            /*background: linear-gradient(to left, #7db831 0%, #7db831 50%, transparent 50%), linear-gradient(to bottom, transparent 46%, #7db831 46%, #7db831 54%, transparent 54%);*/
        }

        div.cell.entrada.top {
            background: #7db831;
            /*background: linear-gradient(to bottom, #7db831 0%, #7db831 50%, transparent 50%), linear-gradient(to left, transparent 46%, #7db831 46%, #7db831 54%, transparent 54%);*/
        }

        div.cell.entrada.bottom {
            background: linear-gradient(to right, #7db831 0%, #7db831 50%, transparent 50%), linear-gradient(to left, transparent 46%, #7db831 46%, #7db831 54%, transparent 54%);
        }

        div.cell.salida {
            background: #e74c3c;
        }

/*        div.cell.salida.right {
            background: linear-gradient(to left, #e74c3c 0%, #e74c3c 50%, transparent 50%);
        }

        div.cell.salida.top {
            background: linear-gradient(to bottom, #e74c3c 0%, #e74c3c 50%, transparent 50%);
        }

        div.cell.salida.bottom {
            background: linear-gradient(to right, #e74c3c 0%, #e74c3c 50%, transparent 50%);
        }*/

        div.cell.selected {
            background: #3498db;
        }

        div.cell.path.hor {
            /*background-image: linear-gradient(to bottom, transparent 46%, #7db831 46%, #7db831 54%, transparent 54%);*/
        }

        div.cell.path.ver {
/*            background-image: linear-gradient(to left, transparent 46%, #7db831 46%, #7db831 54%, transparent 54%);*/
        }

        div.cell.path.corner.bottom-right {
/*            background-image: radial-gradient(
                circle at 100% 100%, 
                transparent 32%,
                #7db831 33%,
                #7db831 38%,
                transparent 39%
                );*/
        }

        div.cell.path.corner.bottom-left {
/*            background-image: radial-gradient(
                circle at 0 100%, 
                transparent 32%,
                #7db831 33%,
                #7db831 38%,
                transparent 39%
                );*/
        }

        div.cell.path.corner.top-right {
/*            background-image: radial-gradient(
                circle at 100% 0, 
                transparent 32%,
                #7db831 33%,
                #7db831 38%,
                transparent 39%
                );*/
        }
        div.cell.path.corner.top-left {
/*            background-image: radial-gradient(
                circle at 0 0, 
                transparent 32%,
                #7db831 33%,
                #7db831 38%,
                transparent 39%
                );*/
        }



    </style>

</html>
<?php

/**
 * Nombre           : NodeGraph2D.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Clase encargada de trabajar sobre Nodos en 2D                       
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

require_once "iNodeGraph.php";

class NodeGraph2D implements iNodeGraph {
    public $Tiles;
    public $SX;
    public $SY;
    public $Directions = Array(
        Array(0, -1),
        Array(1, 0),
        Array(0, 1),
        Array(-1, 0)
    );
    public $Movement_Horizontally = 10;

    function __construct($SizeX, $SizeY) {
        $this->SX = $SizeX;
        $this->SY = $SizeY;
        // Pos Inicio, Tamanio, contenido
        $this->Tiles = array_fill(0, $SizeX, array_fill(0, $SizeY, 0));
    }

    function Node2XY($Lookup) {
        $X = $Lookup % $this->SX;
        $Y = (int) ($Lookup / $this->SX);
        return Array($X, $Y);
    }

    function Set($NewTiles) {
        foreach ($NewTiles as $NewTile) {
            $this->Tiles[$NewTile[0]][$NewTile[1]] = $NewTile[2];
        }
    }

    function Direction($NodeFrom, $NodeTo) {
        list($FX, $FY) = $this->Node2XY($NodeFrom);
        list($TX, $TY) = $this->Node2XY($NodeTo);
        $Dirs = Array(
            -1 => Array(-1 => 7, 0 => 3, 1 => 6),
            0 => Array(-1 => 0, 0 => 'C', 1 => 2),
            1 => Array(-1 => 4, 0 => 1, 1 => 5)
        );
        return $Dirs[$TX - $FX][$TY - $FY];
    }

    function Neighbours($Node) {
        list($X, $Y) = $this->Node2XY($Node);

        $Neighbours = Array();
        for ($i = 0; $i < 4; ++$i) {
            $NX = $X + $this->Directions[$i][0];
            $NY = $Y + $this->Directions[$i][1];

            $exp = $NX < 0 || $NY < 0 || $NX >= $this->SX || $NY >= $this->SY;
            if ($exp) {
                continue;
            }

            if ($this->Tiles[$NX][$NY] == PATH_WALL) {
                continue;
            }

            $Neighbours[] = ($NY * $this->SX) + $NX;
        }
        return $Neighbours;
    }

    function G($nodeFrom, $nodeTo) {
        // El costo por enlace es la resta de los Circulation Values
        list($fx, $fy) = $this->Node2XY($nodeFrom);
        list($tx, $ty) = $this->Node2XY($nodeTo);
        
        $gFrom   = $this->Tiles[$fx][$fy];
        $gTo     = $this->Tiles[$tx][$ty];
        
        return $gTo - $gFrom;
    }

    function H($NodeFrom, $NodeTo) {
        list($FX, $FY) = $this->Node2XY($NodeFrom);
        list($TX, $TY) = $this->Node2XY($NodeTo);
        return sqrt(pow($TX - $FX, 2) + pow($TY - $FY, 2));
    }

}

<?php

/**
 * Nombre           : PathFinder.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Clase encargada de realizar la implementacion del 
 *                  : Metodo de Busqueda A*                       
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

define('STATUS_UNTOUCHED', 0);
define('STATUS_OPEN', 1);
define('STATUS_CLOSED', 2);

class PathFinder {

    public $Graph;
    public $Limit = 750;
    public $Cache;
    public $Debug;

    function __construct(&$Graph) {
        $this->Graph = &$Graph;
    }

    function Find($NodeStart, $NodeEnd) {
        $Queue = new PriorityQueue(); // Open Nodes ordered based on F cost
        $Queue->setExtractFlags(PriorityQueue::EXTR_DATA);

        $Closed = 0;
        $Found = FALSE;
        $this->Debug = '';

        $this->Cache = Array(// Open and Closed Nodes. Stores calculated costs and parent nodes.
            $NodeStart => Array(
                'G' => 0,
                'F' => 0,
                'Parent' => $NodeStart,
                'Status' => STATUS_OPEN
            )
        );
        $Queue->insert($NodeStart, $this->Cache[$NodeStart]['F']);

        while (!$Queue->isEmpty()) {
            $Node = $Queue->extract();

            if ($this->Cache[$Node]['Status'] == STATUS_CLOSED) {
                continue;
            }

            if ($Node == $NodeEnd) {
                $this->Cache[$Node]['Status'] = STATUS_CLOSED;
                $Found = TRUE;
                break;
            }

            if ($Closed > $this->Limit) {
                $this->Debug = 'Hit limit. (' . $this->Limit . ')';
                return NULL;
            }

            $Neighbours = $this->Graph->Neighbours($Node);
            foreach ($Neighbours as $Neighbour) {
                $G = $this->Cache[$Node]['G'] + $this->Graph->G($Node, $Neighbour);

                $exp = isset($this->Cache[$Neighbour]) && $this->Cache[$Neighbour]['Status'] && $this->Cache[$Neighbour]['G'] <= $G;
                if ($exp) { continue; }

                $F = $G + $this->Graph->H($Neighbour, $NodeEnd);

                $this->Cache[$Neighbour] = Array(
                    'G' => $G,
                    'F' => $F,
                    'Parent' => $Node,
                    'Status' => STATUS_OPEN
                );
                $Queue->insert($Neighbour, $F);
            }
            ++$Closed;
            $this->Cache[$Node]['Status'] = STATUS_CLOSED;
        }

        if ($Found) {
            $Path = Array();
            $Node = $NodeEnd;
            while ($NodeStart != $Node) {
                $Path[] = $Node;
                $Node = $this->Cache[$Node]['Parent'];
            }
            $Path[] = $Node;
            return array_reverse($Path);
        }
        $this->Debug = 'Path not found, ran out of open nodes.';
        return NULL;
    }

}

class PriorityQueue extends SplPriorityQueue {

    public function compare($a, $b) { // Reversed to favor lowest costs!
        if ($a < $b) {
            return 1;
        }
        if ($a > $b) {
            return -1;
        }
        return 0;
    }

}

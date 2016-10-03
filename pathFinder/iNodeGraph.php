<?php

/**
 * Nombre           : iNodeGraph.php                                                          
 * Autor            : Gurpo 502
 * Descripcion      : Interfaz NodeGraph                       
 * Fecha            : Septiembre 2016                                                         
 * Observaciones    :     
 */

interface iNodeGraph {

    public function Neighbours($Node);

    // Return an array of connected neighbours.

    public function G($NodeFrom, $NodeTo);

    // We need the 'G' costs. The cost of choosing this node. (Choice costs? -- i.e. breaking down a door)
    // You may interpret this as how difficult it would be to move to/in this node. (Movement costs?)
    // As if it were a slope or other difficult terrain to manouver. (Terrain costs?)

    public function H($NodeFrom, $NodeTo);
    // We want the 'H' or heuristic cost between two nodes.
    // You can interpret this as the euclidean distance.
    // Using square roots isn't too bad and returns an extremely accurate result we need for a good path.
}

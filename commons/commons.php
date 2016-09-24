<?php

function getPositionNumber($x, $y, $maxX, $maxY) {
    $return = 0;
    $pos = 0;
    for ($i = 0; $i < $maxX; $i ++) {
        for ($j = 0 ; $j < $maxY; $j ++) {
            if ($x == $i && $y == $j) {
                $return = $pos;
            }
            $pos ++;
        }
    }
    return $return;
}


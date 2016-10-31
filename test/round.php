<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$original = 0.6;

$fRounded = round($original, 1, PHP_ROUND_HALF_UP);
$n = explode(".", $fRounded);

echo "Original: " . $original . "<br>";
echo "E: " . $n[0] . " D: " . $n[1] . "<br>";

if ($n[1] < 5) {
    $pos = $n[0] . ".0";
} elseif($n[1] == 5) {
    $pos = $n[0] . ".5";
} elseif($n[1] > 5) {
    $t = $n[0] + 1;
    $pos = $t;
}
echo $pos;
echo "<hr>";
//$redondeado = 1.2;
//echo round($redondeado);


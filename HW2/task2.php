<?php

function read_val($name)
{
    $val = null;
    if (defined('STDIN')) {
        echo "Введите $name: ";
        $val = trim(fgets(STDIN));
    }
    return $val;
}

$A = (float) read_val('A');
$B = (float) read_val('B');
$C = (float) read_val('C');

$X1 = ($A + $B) / $C;
$X2 = ($A + $C) / $B;
$Y = max($X1, $X2)*pow($A-$B,2);
$Z = (max($X1, $X2)>=1)?($X1+$X2):(($A*$B)/($X1*$X2));

echo "Результаты:\n";
echo "X1 = {$X1}\n";
echo "X2 = {$X2}\n";
echo "Y = {$Y}\n";
echo "Z = {$Z}\n";
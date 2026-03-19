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

$M = (float) read_val('M');
$N = (float) read_val('N');
$K = (float) read_val('K');

$Z = pow($N + $M, 2) / abs($N - $M);
$Z1 = $K * sqrt(pow($Z, 2) + pow($M, 2));
$Z2 = cos($M);

echo "Результаты:\n";
echo "Z = {$Z}\n";
echo "Z1 = {$Z1}\n";
echo "Z2 = {$Z2}\n";
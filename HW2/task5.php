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

function factorial($n)
{
    if ($n <= 1)
        return 1;
    $result = 1;
    for ($i = 2; $i <= $n; ++$i) {
        $result *= $i;
    }
    return $result;
}

function expression($x, $n)
{
    return pow(-1, $n) * pow(2 * $x, 2 * $n) / factorial(2 * $n);
}

$x = 0.1;
$epsilon = (float) read_val('ξ');

$S = 0.0;
$n = 1;
$temp = 0;

do {
    $temp = expression($x, $n);
    $S += $temp;
    ++$n;
} while (abs($temp) >= $epsilon);

echo "Результаты:\n";
echo "S = {$S}\n";
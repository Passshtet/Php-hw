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

$x = [];
for ($i = 1; $i <= 7; $i++) {
    $x[$i] = (float) read_val("x{$i}");
}

$l = [];
for ($i = 1; $i <= 5; $i++) {
    $l[$i] = (float) read_val("l{$i}");
}

$a = (float) read_val('a');
$b = (float) read_val('b');

$sumX = 0.0;
for ($i = 1; $i <= 7; $i++) {
    $sumX += ($x[$i] - $a * $b);
}

$sumY = 0.0;
for ($i = 1; $i <= 5; $i++) {
    $sumY += ($l[$i] - $a);
}

$s = $sumX / $sumY;

$p = [];

for ($i = 1; $i <= 5; $i++) {
    $p[$i] = $s * $l[$i];
}

echo "Результаты:\n";
echo "S = {$s}\n";
for ($i = 1; $i <= 5; $i++ ) {
    echo "P{$i} = {$p[$i]}\n";
}
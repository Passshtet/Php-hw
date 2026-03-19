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

$HD = ['A1', 'A2', 'A3', 'A4', 'M1', 'M2', 'M3', 'M4'];
$KAT = [1, 1, 1, 1, 2, 2, 3, 3];
$S = [100, 200, 300, 400, 500, 600, 700, 800];

shuffle($HD);
shuffle($KAT);
shuffle($S);

echo "Дороги 1-й категории свыше 300 км:\n";
for ($i = 0; $i < count($HD); $i++) {
    if ($KAT[$i] == 1 && $S[$i] > 300) {
        echo "{$HD[$i]} {$KAT[$i]} {$S[$i]}\n";
    }
}

echo "Дороги 3-й категории:\n";
for ($i = 0; $i < count($HD); $i++) {
    if ($KAT[$i] == 3) {
        echo "{$HD[$i]} {$KAT[$i]} {$S[$i]}\n";
    }
}
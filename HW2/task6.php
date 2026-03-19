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

$arr = [];
for ($i = 0; $i < 40; $i++) {
    $arr[$i] = rand(-100, 100);
}

$maxIndex = array_search(max($arr), $arr);
$minIndex = array_search(min($arr), $arr);

$start = min($maxIndex, $minIndex) + 1;
$end = max($maxIndex, $minIndex) - 1;

for ($i = $start; $i <= $end; $i++) {
    $arr[$i] = 0;
}

echo "Результаты:\n";
print_r($arr);
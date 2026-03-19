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

$a = read_val('слово 1');
$b = read_val('слово 2');
$c = read_val('слово 3');

if ($a === $b && $b === $c) {
    echo "Ошибок не найдено. Все слова одинаковы: {$a}\n";
} elseif ($a === $b && $a !== $c) {
    echo "Найдена ошибка: {$c}\n";
} elseif ($a === $c && $a !== $b) {
    echo "Найдена ошибка: {$b}\n";
} elseif ($b === $c && $a !== $b) {
    echo "Найдена ошибка: {$a}\n";
}
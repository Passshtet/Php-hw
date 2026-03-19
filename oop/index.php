<?php

require_once __DIR__ . '/src/Models/Circle.php';
require_once __DIR__ . '/src/Models/Rectangle.php';
require_once __DIR__ . '/src/Models/Triangle.php';
require_once __DIR__ . '/src/Models/Square.php';

$circle   = new Circle(5, 'красный');
$rect     = new Rectangle(4, 6, 'синий');
$triangle = new Triangle(3, 4, 5, 'зелёный');
$square   = new Square(4, 'жёлтый');

echo "=== Объекты ===\n";
echo $circle . "\n";
echo $rect . "\n";
echo $triangle . "\n";
echo $square . "\n";

echo "\n=== describe() ===\n";
$shapes = [$circle, $rect, $triangle, $square];
foreach ($shapes as $shape) {
    echo $shape->describe() . "\n";
}

echo "\n=== Клонирование ===\n";
$circleCopy = clone $circle;
echo "Оригинал: {$circle}\n";
echo "Копия:    {$circleCopy}\n";

echo "\n=== Сериализация ===\n";
$serialized = serialize($circle);
echo "Строка: {$serialized}\n";
$restored = unserialize($serialized);
echo "Восстановлен: {$restored}\n";

echo "\n=== var_dump (Square) ===\n";
var_dump($square);

echo "\n=== Анонимный класс — калькулятор фигур ===\n";
$calc = new class($shapes) {
    private array $shapes;

    public function __construct(array $shapes)
    {
        $this->shapes = $shapes;
    }

    public function totalArea(): float
    {
        $total = 0.0;
        foreach ($this->shapes as $s)
            $total += $s->area();
        return round($total, 2);
    }

    public function largest(): AbstractShape
    {
        $largest = $this->shapes[0];
        foreach ($this->shapes as $s) {
            if ($s->area() > $largest->area())
                $largest = $s;
        }
        return $largest;
    }
};

echo "Суммарная площадь: " . $calc->totalArea() . "\n";
echo "Наибольшая фигура: " . $calc->largest() . "\n";

echo "\n=== Лог Circle ===\n";
foreach ($circle->getLog() as $entry)
    echo $entry . "\n";

echo "\n=== Завершение (деструкторы) ===\n";

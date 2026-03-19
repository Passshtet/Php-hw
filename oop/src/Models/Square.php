<?php

require_once __DIR__ . '/Rectangle.php';

final class Square extends Rectangle
{
    public function __construct(float $side, string $color = 'жёлтый')
    {
        parent::__construct($side, $side, $color);
    }

    public function describe(): string
    {
        return "Square, цвет: {$this->color}, сторона: {$this->width}, площадь: " . $this->area() . ', периметр: ' . $this->perimeter();
    }
}

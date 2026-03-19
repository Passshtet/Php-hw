<?php

require_once __DIR__ . '/AbstractShape.php';

class Triangle extends AbstractShape
{
    private float $a;
    private float $b;
    private float $c;

    public function __construct(float $a, float $b, float $c, string $color = 'зелёный')
    {
        if ($a <= 0 || $b <= 0 || $c <= 0)
            throw new InvalidArgumentException('Стороны должны быть больше нуля');

        if ($a + $b <= $c || $a + $c <= $b || $b + $c <= $a)
            throw new InvalidArgumentException('Такой треугольник не существует');

        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        parent::__construct($color);
    }

    public function area(): float
    {
        $s = $this->perimeter() / 2;
        return round(sqrt($s * ($s - $this->a) * ($s - $this->b) * ($s - $this->c)), 2);
    }

    public function perimeter(): float
    {
        return round($this->a + $this->b + $this->c, 2);
    }
}

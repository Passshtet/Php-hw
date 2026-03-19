<?php

require_once __DIR__ . '/AbstractShape.php';

class Rectangle extends AbstractShape
{
    protected float $width;
    protected float $height;

    public function __construct(float $width, float $height, string $color = 'синий')
    {
        if ($width <= 0 || $height <= 0)
            throw new InvalidArgumentException('Стороны должны быть больше нуля');

        $this->width  = $width;
        $this->height = $height;
        parent::__construct($color);
    }

    public function area(): float
    {
        return round($this->width * $this->height, 2);
    }

    public function perimeter(): float
    {
        return round(2 * ($this->width + $this->height), 2);
    }
}

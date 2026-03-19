<?php

require_once __DIR__ . '/AbstractShape.php';

class Circle extends AbstractShape
{
    private float $radius;

    public function __construct(float $radius, string $color = 'красный')
    {
        if ($radius <= 0)
            throw new InvalidArgumentException('Радиус должен быть больше нуля');

        $this->radius = $radius;
        parent::__construct($color);
    }

    public function area(): float
    {
        return round(M_PI * $this->radius ** 2, 2);
    }

    public function perimeter(): float
    {
        return round(2 * M_PI * $this->radius, 2);
    }

    public function __clone()
    {
        $this->resetLog();
        $this->addLog('Circle клонирован');
    }

    public function __sleep(): array
    {
        return ['radius', 'color'];
    }

    public function __wakeup(): void
    {
        $this->resetLog();
        $this->addLog('Circle восстановлен из сериализации');
    }
}

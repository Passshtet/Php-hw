<?php

require_once __DIR__ . '/../Interfaces/Describable.php';
require_once __DIR__ . '/../Traits/LogTrait.php';

abstract class AbstractShape implements Describable
{
    use LogTrait;

    protected string $color;

    public function __construct(string $color)
    {
        $this->color = $color;
        $this->addLog(get_class($this) . ' создан');
    }

    public function __destruct()
    {
        echo get_class($this) . " уничтожен\n";
    }

    abstract public function area(): float;
    abstract public function perimeter(): float;

    public function describe(): string
    {
        return get_class($this) . ", цвет: {$this->color}, площадь: " . $this->area() . ', периметр: ' . $this->perimeter();
    }

    public function __toString(): string
    {
        return $this->describe();
    }

    public function __debugInfo(): array
    {
        return [
            'class'     => get_class($this),
            'color'     => $this->color,
            'area'      => $this->area(),
            'perimeter' => $this->perimeter(),
        ];
    }
}

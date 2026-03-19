# ООП — Геометрические фигуры

## Описание

Мини-проект на PHP, демонстрирующий инструменты ООП на предметной области «Геометрические фигуры».

## Структура

```
oop/
  src/
    Interfaces/
      Describable.php
    Traits/
      LogTrait.php
    Models/
      AbstractShape.php
      Circle.php
      Rectangle.php
      Triangle.php
      Square.php
  index.php
  README.md
```

## Реализованные требования

| Пункт | Элемент | Где |
|-------|---------|-----|
| 3.1 | `__construct()` | все классы фигур |
| 3.2 | `__destruct()` | `AbstractShape` |
| 3.3 | `__toString()`, `__debugInfo()`, `__clone()`, `__sleep()`, `__wakeup()` | `AbstractShape`, `Circle` |
| 3.4 | Наследование | `AbstractShape` → `Circle`, `Rectangle`, `Triangle`; `Rectangle` → `Square` |
| 3.5 | Абстрактный класс | `AbstractShape` (`area()`, `perimeter()`) |
| 3.6 | Интерфейс | `Describable` → `describe()` |
| 3.7 | Трейт | `LogTrait` — логирование событий объекта |
| 3.8 | Анонимный класс | `index.php` — калькулятор суммарной площади |
| 3.9 | `final` | класс `Square` |
| 3.10 | Клонирование | `clone $circle`, `__clone()` в `Circle` |
| 3.11 | Сериализация | `serialize()` / `unserialize()`, `__sleep()` / `__wakeup()` в `Circle` |

## Запуск

```bash
php oop/index.php
```

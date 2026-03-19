<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Администратор
        User::create([
            'name'     => 'Админ',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Покупатель
        User::create([
            'name'     => 'Иванов Иван Иванович',
            'email'    => 'buyer@example.com',
            'password' => Hash::make('password'),
            'role'     => 'buyer',
        ]);

        // Категории строительных инструментов
        $ruchnoy = Category::create([
            'name'        => 'Ручной инструмент',
            'description' => 'Молотки, отвёртки, плоскогубцы и т.д.',
        ]);

        $electro = Category::create([
            'name'        => 'Электроинструмент',
            'description' => 'Дрели, шуруповёрты, болгарки и т.д.',
        ]);

        $izmer = Category::create([
            'name'        => 'Измерительный инструмент',
            'description' => 'Рулетки, уровни, лазерные дальномеры',
        ]);

        // Подкатегория
        Category::create([
            'name'        => 'Отвёртки',
            'description' => 'Крестовые, шлицевые, торцевые',
            'parent_id'   => $ruchnoy->id,
        ]);

        // Товары
        Product::create([
            'name'        => 'Молоток слесарный 500г',
            'description' => 'Молоток с деревянной рукояткой, вес бойка 500г',
            'price'       => 650,
            'category_id' => $ruchnoy->id,
            'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/84/Claw-hammer.jpg/600px-Claw-hammer.jpg',
        ]);

        Product::create([
            'name'        => 'Дрель-шуруповёрт аккумуляторная 18В',
            'description' => 'Аккумуляторный шуруповёрт, 2 скорости, Li-Ion',
            'price'       => 4500,
            'category_id' => $electro->id,
            'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/39/Cordless_drill.jpg/600px-Cordless_drill.jpg',
        ]);

        Product::create([
            'name'        => 'Болгарка 125мм 850Вт',
            'description' => 'Угловая шлифмашина, диск 125мм',
            'price'       => 3200,
            'category_id' => $electro->id,
            'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/db/AngleGrinder.jpg/600px-AngleGrinder.jpg',
        ]);

        Product::create([
            'name'        => 'Рулетка 5м',
            'description' => 'Рулетка измерительная с фиксатором, 5 метров',
            'price'       => 350,
            'category_id' => $izmer->id,
            'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d9/Stanley_PowerLock_tape_measure.jpg/600px-Stanley_PowerLock_tape_measure.jpg',
        ]);

        Product::create([
            'name'        => 'Уровень пузырьковый 60см',
            'description' => 'Строительный уровень, алюминиевый корпус',
            'price'       => 890,
            'category_id' => $izmer->id,
            'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/SpiritLevel.jpg/600px-SpiritLevel.jpg',
        ]);

        Product::create([
            'name'        => 'Набор отвёрток 6 шт.',
            'description' => 'Набор крестовых и шлицевых отвёрток',
            'price'       => 780,
            'category_id' => $ruchnoy->id,
            'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Screwdriver_set.jpg/600px-Screwdriver_set.jpg',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SparePartTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('spare_part_types')->insert([
            ['name' => 'Автосвет', 'product_types_id' => 1],
            ['name' => 'Аккумуляторы', 'product_types_id' => 1],
            ['name' => 'Двигатель', 'product_types_id' => 1],
            ['name' => 'Кузов', 'product_types_id' => 1],
            ['name' => 'Подвеска', 'product_types_id' => 1],
            ['name' => 'Рулевое управление', 'product_types_id' => 1],
            ['name' => 'Салон', 'product_types_id' => 1],
            ['name' => 'Стёкла', 'product_types_id' => 1],
            ['name' => 'Топливная и выхлопная системы', 'product_types_id' => 1],
            ['name' => 'Тормозная система', 'product_types_id' => 1],
            ['name' => 'Трансмиссия и привод', 'product_types_id' => 1],
            ['name' => 'Электрооборудование', 'product_types_id' => 1],
            ['name' => 'Система охлаждения', 'product_types_id' => 1],
            ['name' => 'Автомобиль на запчасти', 'product_types_id' => 1],
            ['name' => 'Двигатели и комплектующие', 'product_types_id' => 2],
            ['name' => 'Трансмиссия и привод', 'product_types_id' => 2],
            ['name' => 'Подвеска и рулевое управление', 'product_types_id' => 2],
            ['name' => 'Кабина', 'product_types_id' => 2],
            ['name' => 'Рамы, Кузова и надстройки', 'product_types_id' => 2],
            ['name' => 'Электроника и свет', 'product_types_id' => 2],
            ['name' => 'Гидравлические и пневмосистемы', 'product_types_id' => 2],
            ['name' => 'Для навесного оборудования', 'product_types_id' => 2],
            ['name' => 'Техника на разбор', 'product_types_id' => 2],
            ['name' => 'Тормозная система', 'product_types_id' => 2],
            ['name' => 'Для прицепной техники', 'product_types_id' => 2],
        ]);
    }
}

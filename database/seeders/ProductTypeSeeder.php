<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_types')->insert([
            ['name' => 'Для автомобилей', 'goods_types_id' => 1],
            ['name' => 'Для грузовиков и спецтехники', 'goods_types_id' => 1],
        ]);
    }
}

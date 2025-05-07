<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('city_list')->insert([
            'region' => 'Москва',
            'token' => 'DsPGRWHt5G7ckpL84Uy3P5xsCESYzG4E',
            'phone' => '+7 (495) 215-09-94',
            'address' => '117638, Москва, Болотниковская д 18к 2'
        ]);
    }
}

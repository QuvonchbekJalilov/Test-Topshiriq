<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Region::insert([
            ['name' => 'Qoraqalpog‘iston Respublikasi'],
            ['name' => 'Andijon viloyati'],
            ['name' => 'Buxoro viloyati'],
            ['name' => 'Jizzax viloyati'],
            ['name' => 'Qashqadaryo viloyati'],
            ['name' => 'Navoiy viloyati'],
            ['name' => 'Namangan viloyati'],
            ['name' => 'Samarqand viloyati'],
            ['name' => 'Surxandaryo viloyati'],
            ['name' => 'Sirdaryo viloyati'],
            ['name' => 'Toshkent viloyati'],
            ['name' => 'Farg‘ona viloyati'],
            ['name' => 'Xorazm viloyati'],
            ['name' => 'Toshkent shahri'],
        ]);
    }
}

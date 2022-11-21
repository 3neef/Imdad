<?php

namespace Database\Seeders;

use App\Models\Emdad\Categories;
use Database\Factories\CategriesFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategriesFactory::factory()->count(50)->create();
    }
}

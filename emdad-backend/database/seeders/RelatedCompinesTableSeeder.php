<?php

namespace Database\Seeders;

use App\Models\Emdad\RelatedCompanies;
use Database\Factories\RelatedCompanyFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelatedCompinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RelatedCompanies::factory(6)->create();

    }
}

<?php

namespace Database\Seeders;

use App\Models\Emdad\Categories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
        $Categories = [
            ["id" => 1, 'name_ar' => 'طعام', 'name_en' => 'Food', 'parent_id' => rand(0, 1), 'isleaf' => rand(0, 1), 'status' => 'pending'],
            ["id" => 2, 'name_ar' => 'أجهزه كهربائية', 'name_en' => 'electerc Device',  'parent_id' => rand(0, 1), 'isleaf' => rand(0, 1), 'status' => 'pending'],
            ["id" => 3, 'name_ar' => 'البناء والتشييد', 'name_en' => 'Building and Construction',  'parent_id' => rand(0, 1), 'isleaf' => rand(0, 1), 'status' => 'pending']
        ];
        foreach ($Categories as $Category) {
            Categories::create([
                'id' => $Category['id'],
                'name_ar' => $Category['name_ar'],
                'name_en' => $Category['name_en'],
                'parent_id' => $Category['parent_id'],
                'isleaf' => $Category['isleaf'],
                'status' => $Category['status']
            ]);
        }
    }
}

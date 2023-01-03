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
            ["id" => 1, 'name_ar' => 'طعام', 'name_en' => 'Food', 'parent_id' => '0', 'isleaf' => rand(0, 1), 'status' => 'pending', 'type' => 'products'],
            ["id" => 2, 'name_ar' => 'أجهزه كهربائية', 'name_en' => 'electerc Device',  'parent_id' => '0', 'isleaf' => rand(0, 1), 'status' => 'pending' , 'type' => 'products'],
            ["id" => 3, 'name_ar' => 'البناء والتشييد', 'name_en' => 'Building and Construction',  'parent_id' => '0', 'isleaf' => rand(0, 1), 'status' => 'pending' , 'type' => 'products'],
            ["id" => 4, 'name_ar' => 'بحري', 'name_en' => 'Sea Food', 'parent_id' => '1', 'isleaf' => rand(0, 1), 'status' => 'pending' , 'type' => 'products'],
            ["id" => 5, 'name_ar' => 'وجبات', 'name_en' => 'Meals', 'parent_id' => '1', 'isleaf' => rand(0, 1), 'status' => 'pending', 'type' => 'products'],
            ["id" => 6, 'name_ar' => 'سندويتشات', 'name_en' => 'sandwiches', 'parent_id' => '1', 'isleaf' => rand(0, 1), 'status' => 'pending', 'type' => 'products'],
            ["id" => 7, 'name_ar' => 'لابتوبات', 'name_en' => 'laptops',  'parent_id' => '2', 'isleaf' => rand(0, 1), 'status' => 'pending', 'type' => 'products'],
            ["id" => 8, 'name_ar' => 'هواتف ذكية', 'name_en' => 'Smart Phones',  'parent_id' => '2', 'isleaf' => rand(0, 1), 'status' => 'pending', 'type' => 'products'],
            ["id" => 9, 'name_ar' => 'شاحنات', 'name_en' => 'Trucks',  'parent_id' => '3', 'isleaf' => rand(0, 1), 'status' => 'pending', 'type' => 'products'],
            ["id" => 10, 'name_ar' => 'سوشي', 'name_en' => 'Sushi', 'parent_id' => '4', 'isleaf' => rand(0, 1), 'status' => 'pending', 'type' => 'products'],
            ["id" => 11, 'name_ar' => 'سمك مقلي', 'name_en' => 'Fried Fish', 'parent_id' => '4', 'isleaf' => rand(0, 1), 'status' => 'pending', 'type' => 'products'],
            ["id" => 12, 'name_ar' => 'دجاج مقلي', 'name_en' => 'Fried Chicken', 'parent_id' => '5', 'isleaf' => rand(0, 1), 'status' => 'pending', 'type' => 'products'],
            ["id" => 13, 'name_ar' => 'فول اسكندراني', 'name_en' => 'Alexendnian Bean', 'parent_id' => '5', 'isleaf' => rand(0, 1), 'status' => 'pending', 'type' => 'products'],
            ["id" => 14, 'name_ar' => 'فورد', 'name_en' => 'Ford',  'parent_id' => '9', 'isleaf' => rand(0, 1), 'status' => 'pending', 'type' => 'products'],





        ];
        foreach ($Categories as $Category) {
            Categories::create([
                'id' => $Category['id'],
                'name_ar' => $Category['name_ar'],
                'name_en' => $Category['name_en'],
                'parent_id' => $Category['parent_id'],
                'isleaf' => $Category['isleaf'],
                'status' => $Category['status'],
                'products' => $Category['products']
            ]);
        }
    }
}

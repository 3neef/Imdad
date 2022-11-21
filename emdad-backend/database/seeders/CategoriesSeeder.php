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
        $Categories=[['name_ar'=>'طعام','name_en'=>'Food','aproved'=>rand(0,1),'parent_id'=>rand(0,1),'isleaf'=>rand(0,1)],
        ['name_ar'=>'أجهزه كهربائية','name_en'=>'electerc Device','aproved'=>rand(0,1),'parent_id'=>rand(0,1),'isleaf'=>rand(0,1)],
        ['name_ar'=>'لورم','name_en'=>'lorem','aproved'=>rand(0,1),'parent_id'=>rand(0,1),'isleaf'=>rand(0,1)]
    ];
    foreach($Categories as $Category)
    {
        Categories::create([
            'name_ar' => $Category['name_ar'],
            'name_en' => $Category['name_en'],

            'aproved'=>$Category['aproved'],
            'parent_id'=>$Category['parent_id'],
            'isleaf'=>$Category['isleaf'],
        ]);
    }
     
        

    }
}

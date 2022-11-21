<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UOMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $unit_of_measuerments=[
            ["name_ar"=>'كيلو متر',"name_en"=>"kilometer","symbol"=>"KM","relation"=>"%","value"=>"1000","related_unit"=>0],
            ["name_ar"=>'متر',"name_en"=>"meter","symbol"=>"M","relation"=>"*","value"=>"1000","related_unit"=>1],
            ["name_ar"=>'سنتمتر',"name_en"=>"centimeters","symbol"=>"CM","relation"=>"*","value"=>"100","related_unit"=>2]
            ];
        foreach ($unit_of_measuerments as $unit_of_measuerment) {
            DB::table('unit_of_measures')->insert([
            "name_ar"=>$unit_of_measuerment['name_ar'],
              "name_en"=> $unit_of_measuerment['name_en'],
            "symbol"=>$unit_of_measuerment['symbol'],
            "relation"=>$unit_of_measuerment['relation'],
            "value"=>$unit_of_measuerment['value'],
            "related_unit"=>$unit_of_measuerment['related_unit'],
            "created_at"=>Carbon::now(),
           ]);
    }
    }
}

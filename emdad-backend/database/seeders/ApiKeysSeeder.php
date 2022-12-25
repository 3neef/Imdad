<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apikeys = [["id"=>"1" , "name"=>"key" , "key"=>"Rmkmb7wG8p5xOEo0hlS2DhxHL71HsuT3Y8TSNDhoYDwFSp8L9gniikitjNeBwPQK","active"=>"1"]];
        foreach ($apikeys as $key) {
            DB::table('api_keys')->insert([
                'id' => $key['id'],
                'name' => $key['name'],
                'key' => $key['key'],
                'active' => $key['active']
            ]);
        }
    }
}

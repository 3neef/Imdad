<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles=[
            ["name"=>"GM","type"=>0 ,"for_reg"=>1],
            ["name"=>"CEO","type"=>1 ,"for_reg"=>1],
            ["name"=>"OWNER","type"=>2 ,"for_reg"=>1],
        ];

        foreach ($roles as $role) {
            # code...
            \DB::table('roles')->insert([
                "name"=>$role['name'],
                  "type"=>$role['type'],
                "for_reg"=>$role['for_reg'],
               ]);
        }
    }
}

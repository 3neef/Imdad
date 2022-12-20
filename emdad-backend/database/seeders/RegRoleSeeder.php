<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ["id" => 1, "name" => "GM", "type" => 'emdad', "for_reg" => 1],
            ["id" => 2, "name" => "CEO", "type" => 'supplier', "for_reg" => 1],
            ["id" => 3, "name" => "OWNER", "type" => 'buyier', "for_reg" => 1],
        ];

        foreach ($roles as $role) {
            # code...
            DB::table('roles')->insert([
                "id" => $role['id'],
                "name" => $role['name'],
                "type" => $role['type'],
                "for_reg" => $role['for_reg'],
                "created_at" => Carbon::now()
            ]);
        }
    }
}

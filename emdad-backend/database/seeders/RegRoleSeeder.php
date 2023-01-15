<?php

namespace Database\Seeders;

use App\Models\UM\Permission;
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
            ["id" => 3, "name" => "OWNER", "type" => 'buyer', "for_reg" => 1],
        ];

        $persomsions = Permission::pluck('label');

        // dd($persomsions);

        foreach ($roles as $role) {
            # code...
            DB::table('roles')->insert([
                "id" => $role['id'],
                "name_en" => $role['name_en'],
                "name_ar" => $role['name_ar'],
                "type" => $role['type'],
                "for_reg" => $role['for_reg'],
                'permissions_list' => $persomsions,
                "created_at" => now(),
            ]);
        }
    }
}

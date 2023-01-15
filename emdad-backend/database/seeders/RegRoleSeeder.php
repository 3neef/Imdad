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

            ["id" => 1, "name_ar" => "GM","name_en" => "مدير عام", "type" => 'emdad', "for_reg" => 1],
            ["id" => 2,  "name_ar" => "CEO","name_en" => "مدير تنفيذي", "type" => 'supplier', "for_reg" => 1],
            ["id" => 3,  "name_ar" => "OWNER","name_en" => "مالك المؤسسة", "type" => 'buyer', "for_reg" => 1],
            ["id" => 4, "name_ar" => "GM","name_en" => "GM", "type" => 'supplier', "for_reg" => 0],
            ["id" => 5, "name_ar" => "CEO","name_en" => "GM", "type" => 'supplier', "for_reg" => 0],
            ["id" => 6, "name_ar" => "OWNER","name_en" => "GM", "type" => 'supplier', "for_reg" => 0],
            
            ["id" => 7, "name_ar" => "GM","name_en" => "GM", "type" => 'supplier', "for_reg" => 0],
            ["id" => 8, "name_ar" => "CEO","name_en" => "GM", "type" => 'supplier', "for_reg" => 0],
            ["id" => 9, "name_ar" => "OWNER","name_en" => "GM", "type" => 'buyer', "for_reg" => 0],
            
            ["id" => 10, "name_ar" => "GM","name_en" => "GM", "type" => 'buyer', "for_reg" => 0],
            ["id" => 11, "name_ar" => "CEO","name_en" => "GM", "type" => 'buyer', "for_reg" => 0],
            ["id" => 12, "name_ar" => "OWNER","name_en" => "GM", "type" => 'buyer', "for_reg" => 0],
            ["id" => 13, "name_ar" => "OWNER","name_en" => "GM", "type" => 'buyer', "for_reg" => 0],
            
        ];


        

        // dd($persomsions);

        foreach ($roles as $role) {

            if($role['id']<4){
                $persomsions = Permission::pluck('label');
                $this->insertRole($role,$persomsions);
                continue;

            }
            
            if($role['type']=='supplier' && $role['name_en']==''){
                $persomsions=['SDF','sds'];
                $this->insertRole($role,$persomsions);
                continue;
            }

            if($role['type']=='supplier' && $role['name_en']==''){
                $persomsions=[''];
                $this->insertRole($role,$persomsions);
                continue;
            }

            if($role['type']=='supplier' && $role['name_en']==''){
                $persomsions=[''];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='supplier' && $role['name_en']==''){
                $persomsions=[''];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='supplier' && $role['name_en']==''){
                $persomsions=[''];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']==''){
                $persomsions=[''];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']==''){
                $persomsions=[''];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']==''){
                $persomsions=[''];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']==''){
                $persomsions=[''];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']==''){
                $persomsions=[''];
                $this->insertRole($role,$persomsions);
                continue;
            }
           
        }


      
    }

    function insertRole($role,$persomsions){
        DB::table('roles')->insert([
            "id" => $role['id'],
            "name_ar" => $role['name_ar'],
            "name_en" => $role['name_en'],
            "type" => $role['type'],
            "for_reg" => $role['for_reg'],
            'permissions_list' => $persomsions,
            "created_at" => now(),
        ]);
    }
}

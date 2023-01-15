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

            ["id" => 1, "name_en" => "GM","name_ar" => "مدير عام", "type" => 'emdad', "for_reg" => 1],
            ["id" => 2,  "name_en" => "CEO","name_ar" => "مدير تنفيذي", "type" => 'supplier', "for_reg" => 1],
            ["id" => 3,  "name_en" => "OWNER","name_ar" => "مالك المؤسسة", "type" => 'buyer', "for_reg" => 1],
            ["id" => 4, "name_en" => "Business owner","name_ar" => "رئيس تنفيذي ", "type" => 'supplier', "for_reg" => 0],
            ["id" => 5, "name_en" => "Sales manager","name_ar" => "مدير المبيعات", "type" => 'supplier', "for_reg" => 0],
            ["id" => 6, "name_en" => "Finance manager","name_ar" => "المدير المالي", "type" => 'supplier', "for_reg" => 0],
            
            ["id" => 7, "name_en" => "Wharehouse manager","name_ar" => "مدير المستودع", "type" => 'supplier', "for_reg" => 0],
            ["id" => 8, "name_en" => "Sales officer ","name_ar" => "مسؤول المبيعات", "type" => 'supplier', "for_reg" => 0],
            ["id" => 9, "name_en" => "Finance officer","name_ar" => "مسؤول مالي", "type" => 'supplier', "for_reg" => 0],
            
            ["id" => 10, "name_en" => "Wharehouse officer","name_ar" => "مسؤول المستودع", "type" => 'supplier', "for_reg" => 0],
            ["id" => 11, "name_en" => "Driver","name_ar" => "السائق ", "type" => 'supplier', "for_reg" => 0],
           


            ["id" => 12, "name_en" => "Business owner","name_ar" => "رئيس تنفيذي ", "type" => 'buyer', "for_reg" => 0],
            ["id" => 13, "name_en" => "Procurement manager","name_ar" => "مدير المشتريات", "type" => 'buyer', "for_reg" => 0],
            ["id" => 14, "name_en" => "Finance manager","name_ar" => "المدير المالي", "type" => 'buyer', "for_reg" => 0],
            
            ["id" => 15, "name_en" => "Wharehouse manager","name_ar" => "مدير المستودع", "type" => 'buyer', "for_reg" => 0],
            ["id" => 16, "name_en" => "Procurement officer","name_ar" => "مسؤول المشتريات", "type" => 'buyer', "for_reg" => 0],
            ["id" => 17, "name_en" => "Finance officer","name_ar" => "مسؤول مالي", "type" => 'buyer', "for_reg" => 0],
            
            ["id" => 18, "name_en" => "Wharehouse officer","name_ar" => "مسؤول المستودع", "type" => 'buyer', "for_reg" => 0],
            
        ];

               
        // dd($persomsions);

        foreach ($roles as $role) {
         
    

            if($role['id']<4){
                $persomsions = Permission::pluck('label');
                $this->insertRole($role,$persomsions);
                continue;

            }
            
            if($role['type']=='supplier' && $role['name_en']=='Wharehouse officer'){
                $persomsions=['SDD3','SMUP1'];
                $this->insertRole($role,$persomsions);
                continue;
            }

            // if($role['type']=='supplier' && $role['name_en']==''){
            //     $persomsions=[''];
            //     $this->insertRole($role,$persomsions);
            //     continue;
            // }

            // if($role['type']=='supplier' && $role['name_en']==''){
            //     $persomsions=[''];
            //     $this->insertRole($role,$persomsions);
            //     continue;
            // }
            // if($role['type']=='supplier' && $role['name_en']==''){
            //     $persomsions=[''];
            //     $this->insertRole($role,$persomsions);
            //     continue;
            // }
            // if($role['type']=='supplier' && $role['name_en']==''){
            //     $persomsions=[''];
            //     $this->insertRole($role,$persomsions);
            //     continue;
            // }
            // if($role['type']=='buyer' && $role['name_en']==''){
            //     $persomsions=[''];
            //     $this->insertRole($role,$persomsions);
            //     continue;
            // }
            // if($role['type']=='buyer' && $role['name_en']==''){
            //     $persomsions=[''];
            //     $this->insertRole($role,$persomsions);
            //     continue;
            // }
            // if($role['type']=='buyer' && $role['name_en']==''){
            //     $persomsions=[''];
            //     $this->insertRole($role,$persomsions);
            //     continue;
            // }
            // if($role['type']=='buyer' && $role['name_en']==''){
            //     $persomsions=[''];
            //     $this->insertRole($role,$persomsions);
            //     continue;
            // }
            // if($role['type']=='buyer' && $role['name_en']==''){
            //     $persomsions=[''];
            //     $this->insertRole($role,$persomsions);
            //     continue;
            // }
           
        }


      
    }

    function insertRole($role,$persomsions){
        DB::table('roles')->insert([
            "id" => $role['id'],
            "name_ar" => $role['name_ar'],
            "name_en" => $role['name_en'],
            "type" => $role['type'],
            "for_reg" => $role['for_reg'],
            'permissions_list' => json_encode($persomsions,true),
            "created_at" => now(),
        ]);
    }
}

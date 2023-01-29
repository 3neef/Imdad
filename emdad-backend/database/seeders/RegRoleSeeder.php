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
                // $persomsions = Permission::pluck('label');
                $persomsions = DB::table('permissions')->pluck('label')->first();
                $this->insertRole($role,$persomsions);
                continue;

            }
            
            if($role['type']=='supplier' && $role['name_en']=='Wharehouse officer'){
                $persomsions=['SMC4'];
                $this->insertRole($role,$persomsions);
                continue;
            }

            // if($role['type']=='supplier' && $role['name_en']=='Driver'){
            //     $persomsions=['SAP8','SAP15','SMCS4'];
            //     $this->insertRole($role,$persomsions);
            //     continue;
            // }

            if($role['type']=='supplier' && $role['name_en']=='Finance officer'){//موظف مالي
                $persomsions=['SMC4'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='supplier' && $role['name_en']=='Sales officer'){
                $persomsions=['SMC4'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='supplier' && $role['name_en']=='Wharehouse manager'){
                $persomsions=['SMW48','SMW1','SMW2','SMW4','SMFLD2','SMFLD1','SMFLD4','SMFLD3','SMFLT2','SMFLT1','SMFLT4','SMFLT3','SMCO50','SMU4'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='supplier' && $role['name_en']=='Finance manager'){
                $persomsions=['SMU4','SMCO31','SMCO30','SMCO49','SMCO50','SMC4'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='supplier' && $role['name_en']=='Sales manager'){
                $persomsions=['SMU4','SMT48','SMT5','SMT1','SMT12','SMT4','SMP48','SMP1','SMP4','SMC4'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='supplier' && $role['name_en']=='bussnies owner'){
                $persomsions= DB::table('permissions')->where("category", 'LIKE', "S%")->pluck('label');
                $this->insertRole($role,$persomsions);
                continue;
            }




            if($role['type']=='buyer' && $role['name_en']=='Warehouse officer'){
                $persomsions=['BMC4'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']=='Finance officer'){
                $persomsions=['BMC4'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']=='Procurement officer'){
                $persomsions=['BMT48','BMT5','BMT1','BMT12','BMT4','BMP48','BMP1','BMP4','BMC4'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']==' Warehouse manager'){
                $persomsions=['BMU4','BMW48','BMW1','BMW4','BMW2','BMT48','BMT5','BMT1','BMT12','BMT4','BMP48','BMP1','BMP4','BMC4'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']=='Finance manager'){
                $persomsions=['BMU4','BMCO50','BMC4','BMCO30','BMCO31','BMCO49'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']=='Procurement manager'){
                $persomsions=['BMT48','BMT5','BMT1','BMT12','BMT4','BMP48','BMP1','BMP4','BMC4','BMU4'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']=='Business owner'){
                $persomsions= DB::table('permissions')->where("category", "LIKE", "B%")->pluck('label');
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
            'permissions_list' => json_encode($persomsions,true),
            "created_at" => now(),
        ]);
    }
}

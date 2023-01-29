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
                $persomsions=['SDD13','SMCS4','SML14','SMC4','SMAP14'];
                $this->insertRole($role,$persomsions);
                continue;
            }

            if($role['type']=='supplier' && $role['name_en']=='Driver'){
                $persomsions=['SAP8','SAP15','SMCS4'];
                $this->insertRole($role,$persomsions);
                continue;
            }

            if($role['type']=='supplier' && $role['name_en']=='Finance officer'){
                $persomsions=['SPO4','SCL4','SCR4','SMCS4','SML14','SMC4','SMUP14','SMAP14'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='supplier' && $role['name_en']=='Sales officer'){
                $persomsions=['SRFQ8','SQ2','SQ1','SPO4','SMCS1','SMCS17','SML1','SMC1','SMUP1','SMAP1'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='supplier' && $role['name_en']=='Wharehouse manager'){
                $persomsions=['SDD4','SMCS1','SMU1','SML14','SMUP4','SMAP14'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='supplier' && $role['name_en']=='Finance manager'){
                $persomsions=['SPO4','SCL4','SCR16','SDD4','SMCS8','SMCS9','SMU4','SML14','SMC4','SMUP14','SMAP14'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='supplier' && $role['name_en']=='Sales manager'){
                $persomsions=['SRFQ9','SQ18','SPO4','SCR19','SCR9','SCR8','SMCS9','SMCS8',
                'SMU4','SML14','SMC4','SMCT1','SMCT20',
                'SMUP14','SMAP14'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='supplier' && $role['name_en']=='bussnies owner'){
                $persomsions=['SRFQ4','SRFQ9','SRFQ8','SQ1','SQ4','SQ2','SQ18','SPO4','SPO21',
                'SDD4','SDD13','SDD22','SDD23','SAP24','SAP25','SAP9',
                'SMCS4','SMCS1','SMCS8','SMCS9','SMCS26','SMCS27',
                'SMU1','SMU2','SMU4','SMU9','SMU8','SMU28','SMU5',
                'SML14','SML29','SMC4','SMC30','SMC31','SMUP14','SMUP29',
                'SMCD1','SMAL4','SMMB1','SMMB4','SMFL1','SMFL4','SMFL2','SMFL5','SMFL6','SMAP14','SMAP29'];
                $this->insertRole($role,$persomsions);
                continue;
            }




            if($role['type']=='buyer' && $role['name_en']=='Warehouse officer'){
                $persomsions=['BCDN4','BCDN32','BCDN33','BCDN34','BMCD4','BML14','BMCO4','BMNM14','BMDE14'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']=='Finance officer'){
                $persomsions=['BCPO4','BCIN35','BMCD4','BML14','BMCO4','BMNM14','BMCT8','BMCT9','BMCT20','BMDE14'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']=='Procurement officer'){
                $persomsions=['BCFQ1','BCFQ2','BCQ36','BCPO1','BMCD36','BML14','BMCO4','BMCT37','BMNM14','BMCT4','BMDE14'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']==' Warehouse manager'){
                $persomsions=['BCPO4','BCDN34','BMCD37','BMU4','BML14','BMCO4','BMCT14','BMCT37','BMNM14','BMDE14'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']=='Finance manager'){
                $persomsions=['BCPO4','BCIN35','BCDN4','BMCD37','BMU4','BML14','BMCO14','BMNM14','BMCT20','BMCT8','BMCT9','BMDE14'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']=='Procurement manager'){
                $persomsions=['BCFQ39','BCQ36','BCPO40','BMCD8','BMCD9','BMU4','BML14','BMCO14','BMCT20','BMCT1','BMNM14','BMCT20','BMCT20','BMCT8','BMCT9','BMDE14'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']=='Business owner'){
                $persomsions=['BCFQ1','BCFQ2','BCFQ39','BCFQ41',
                'BCQ4','BCQ9','BCQ36','BCPO4','BCPO42','BCPO43','BCIN4','BCIN35','BCDN4',
                'BCDN34','BCDN33','BCDN32','BMCD4','BMCD37','BMCD8','BMCD9','BMCD26',
                'BMU4','BMU1','BMU2','BMU8','BMU9','BMU28',
                'BMCO4','BMCO44','BMCO45','BMCT4','BMCT2','BMCT20','BMNM29','BMNM14',
                'BMCA4','BMMB46','BMMB4','BMCD1','BMCT4','BMCT20','BMCT8','BMCT9','BMDE29','BMDE14'];
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

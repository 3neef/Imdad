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
                'SDD1','SCL4','SCR4','SCR2','SCR1','SDD4','SDD3',
                'SDD2','SDD1','SAP3','SAP2','SAP1','SMCS3','SMCS2','SMCS1','SMU3','SMU2','SMU1','SML3','SML2',
                'SML1','SMC3','SMC2','SMC1','SMCT2','SMCT1','SMUP2','SMUP1','SMCD1','SMAL1','SMMB3','SMMB2','SMMB1','SMFL4','SMFL3','SMFL2','SMFL1','SMAP1','SMAP2'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']=='Wharehouse officer'){
                $persomsions=['BCDN3','BML1','BMCO1','BMNM1','BMDE1'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']=='Finance officer'){
                $persomsions=['BCPO','BCIN2','BMCD1','BML1','BMCO1','BMNM2','BMDE1'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']=='Procurement officer'){
                $persomsions=['BCFQ2','BCQ2','BCPO2','BMCD2','BML1','BML1','BMCO1','BMCT2','BMNM1','BMCT1','BMDE1'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']==' Warehouse manager'){
                $persomsions=['BCPO1','BCDN3','BMCD2','BMU1','BML1','BMCO1','BMCT2','BMNM1','BMDE1'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']=='Finance manager'){
                $persomsions=['BCPO1','BCIN2','BCDN1','BMCD','BMU1','BML1','BMCO2','BMNM1','BMNM2','BMDE1'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']=='Procurement manager'){
                $persomsions=['BCFQ3','BCQ2','BCPO3','BMCD3','BMU1','BML1','BMCO1','BMCT2','BMNM1','BMCT2','BMDE1'];
                $this->insertRole($role,$persomsions);
                continue;
            }
            if($role['type']=='buyer' && $role['name_en']=='Business owner'){
                $persomsions=['BCFQ4','BCFQ3','BCFQ2','BCFQ1','BCQ3','BCQ2',
                'BCQ1','BCPO3','BCPO2','BCPO1','BCIN2','BCIN1','BCDN4',
                'BCDN3','BCDN2','BCDN1','BMCD4','BMCD3','BMCD2','BMCD1','BMU4','BMU3','BMU2','BMU1',
            'BMCO3','BMCO2','BMCO1','BMCT2','BMCT1','BMNM2','BMNM1','BMCA1','BMMB3','BMMB1','BMCD1','BMCT2','BMCT1','BMDE2','BMDE1'];
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

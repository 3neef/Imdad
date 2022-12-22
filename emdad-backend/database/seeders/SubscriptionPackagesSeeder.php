<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Accounts\SubscriptionPackages;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubscriptionPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $subscriptionsDetails = [
            ["id" => 1, "packageNameAr" => 'الأساسية', "packageNameEn"=>'Basic', "type" => 'Buyer',"price1" => "0", "price2" => "12250",
             "features" =>
             [["key"=>"delivery","titleEn"=>"Delivery Scheduling","titleAr"=>"التوصيل","systemValue"=>1,"text_en"=>"One Time Delivery","text_ar"=>"التوصيل لمرة واحدة","descriptionEn"=>"lorem epsom",
            "descriptionAr"=>"تفاصيل شرح الميزة"],
            ["key"=>"users","titleEn"=>"Users Scheduling","titleAr"=>"المستخدمين","systemValue"=>1,"text_en"=>"10 users","text_ar"=>"  عشرة مستخدمين","descriptionEn"=>"lorem epsom",
            "descriptionAr"=>"تفاصيل شرح الميزة"]]],


            ["id" => 2, "packageNameAr" => 'الفضية', "packageNameEn"=>'silver', "type" => 'Buyer',"price2" => "1250", "price1" => "0",
             "features" =>
             [["titleEn"=>"Delivery Scheduling","systemValue"=>1,"text_en"=>"One Time Delivery","titleAr"=>"التوصيل","text_ar"=>"التوصيل لمرة واحدة","descriptionEn"=>"lorem epsom",
            "descriptionAr"=>"تفاصيل شرح الميزة","key"=>"delivery"],
            ["titleEn"=>"Users Scheduling","key"=>"users","titleAr"=>"المستخدمين","text_en"=>"10 users","text_ar"=>"  عشرة مستخدمين","descriptionEn"=>"lorem epsom",
            "systemValue"=>1,"descriptionAr"=>"تفاصيل شرح الميزة"] ] ]
        ];

        foreach ($subscriptionsDetails as $subscriptionsDetail) {
            DB::table('subscription_packages')->insert([
                "id" => $subscriptionsDetail["id"],
                "package_name_ar" => $subscriptionsDetail["packageNameAr"],
                "package_name_en" => $subscriptionsDetail["packageNameEn"],
                "type" => $subscriptionsDetail["type"],
                "price_1" => $subscriptionsDetail["price1"],
                "price_2" => $subscriptionsDetail["price2"],
                "features" => json_encode($subscriptionsDetail['features'], true),
                "created_at" => Carbon::now(),
            ]);
        }
    }
}

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
        ["id" => 1, "packageNameAr" => 'الأساسية', "packageNameEn"=>'Basic', "type" => 'Buyer',"price1" => "0", "price2" => "4500",
             "features" =>
             [
		["key"=>"owner","titleEn"=>"Business owner","titleAr"=>"المستخدم المالك/الرئيس التنفيذي","systemValue"=>1,"text_en"=>"1","text_ar"=>"1","descriptionEn"=>"The official account for the company, with full access to all pages and permissions.",
            "descriptionAr"=>"هو حساب الرئيس التنفيذي للشركة الذي يمتلك جميع صالحيات الوصول"],

		["key"=>"user","titleEn"=>"User Management","titleAr"=>"ادارة المستخدمين","systemValue"=>1,"text_en"=>"3","text_ar"=>"3","descriptionEn"=>"The additional accounts with multiple roles and permissions assigned by the business owner, e.g.,Procurement Manager, Finance Officer…","descriptionAr"=>"الموظفين التابعين للشركة والمسؤولين عن أدوار وظيفية محددة بصالحيات محددة يحددها مالك 
الشركة؛ على سبيل المثال: مسؤول مشتريات، مسؤول مالي..."],

        ["key"=>"Delivery","titleEn"=>"Delivery Scheduling ","titleAr"=>"جدولة التوريد","systemValue"=>1,"text_en"=>"One-Time Delivery","text_ar"=>"التوريد لمرة واحدة ","descriptionEn"=>"The additional accounts with multiple roles and permissions assigned by the business owner, e.g.,Procurement Manager, Finance Officer…","descriptionAr"=>"التوريد لمرة واحدة: في امر شراء عند تحديد جدولة التوريد لمرة واحدة، يكون توريد الطلب على 
        .
        دفعة واحدة للطلب كامال 
        التوريد المجزأ: في امر الشراء عند تحديد جدولة التوريد المجزأ، يتم تقسيم التوريدات لدفعات على 
        فترات مختلفة"],
        ["key"=>"Warehouse","titleEn"=>"Branch and Warehouse Management","titleAr"=>"ادارة المستخدمين","systemValue"=>1,"text_en"=>"2","text_ar"=>"2","descriptionEn"=>"The place to which the requisition is delivered.","descriptionAr"=>"في أمر شراء يتم تحديد الفرع او المستودع الذي سيتم توريد الطلب إليه. "],

            ]


        ],


        ["id" => 2, "packageNameAr" => 'الفضية', "packageNameEn"=>'silver', "type" => 'Buyer',"price1" => "7500", "price2" => "7500",
             "features" =>
             [
                ["key"=>"owner","titleEn"=>"Business owner","titleAr"=>"المستخدم المالك/الرئيس التنفيذي","systemValue"=>1,"text_en"=>"1","text_ar"=>"1","descriptionEn"=>"The official account for the company, with full access to all pages and permissions.",
                "descriptionAr"=>"هو حساب الرئيس التنفيذي للشركة الذي يمتلك جميع صالحيات الوصول"],
    
            ["key"=>"user","titleEn"=>"User Management","titleAr"=>"ادارة المستخدمين","systemValue"=>1,"text_en"=>"15","text_ar"=>"15","descriptionEn"=>"The additional accounts with multiple roles and permissions assigned by the business owner, e.g.,Procurement Manager, Finance Officer…","descriptionAr"=>"الموظفين التابعين للشركة والمسؤولين عن أدوار وظيفية محددة بصالحيات محددة يحددها مالك 
    الشركة؛ على سبيل المثال: مسؤول مشتريات، مسؤول مالي..."],
    
            ["key"=>"Delivery","titleEn"=>"Delivery Scheduling ","titleAr"=>"جدولة التوريد","systemValue"=>1,"text_en"=>"Standing Order – 6 Times","text_ar"=>"التوريد المجزأ – 6 فترات","descriptionEn"=>"The additional accounts with multiple roles and permissions assigned by the business owner, e.g.,Procurement Manager, Finance Officer…","descriptionAr"=>"التوريد لمرة واحدة: في امر شراء عند تحديد جدولة التوريد لمرة واحدة، يكون توريد الطلب على 
            .
            دفعة واحدة للطلب كامال 
            التوريد المجزأ: في امر الشراء عند تحديد جدولة التوريد المجزأ، يتم تقسيم التوريدات لدفعات على 
            فترات مختلفة"],
            ["key"=>"Warehouse","titleEn"=>"Branch and Warehouse Management","titleAr"=>"ادارة المستخدمين","systemValue"=>1,"text_en"=>"15","text_ar"=>"15","descriptionEn"=>"The place to which the requisition is delivered.","descriptionAr"=>"في أمر شراء يتم تحديد الفرع او المستودع الذي سيتم توريد الطلب إليه. "]
            
            
            
             ]



 ],
 ["id" => 3, "packageNameAr" => 'الذهبية', "packageNameEn"=>'Gold', "type" => 'Buyer',"price1" => "15000", "price2" => "15000",
             "features" =>
             [
                ["key"=>"owner","titleEn"=>"Business owner","titleAr"=>"المستخدم المالك/الرئيس التنفيذي","systemValue"=>1,"text_en"=>"1","text_ar"=>"1","descriptionEn"=>"The official account for the company, with full access to all pages and permissions.",
                "descriptionAr"=>"هو حساب الرئيس التنفيذي للشركة الذي يمتلك جميع صالحيات الوصول"],
    
            ["key"=>"user","titleEn"=>"User Management","titleAr"=>"ادارة المستخدمين","systemValue"=>1,"text_en"=>"30","text_ar"=>"30","descriptionEn"=>"The additional accounts with multiple roles and permissions assigned by the business owner, e.g.,Procurement Manager, Finance Officer…","descriptionAr"=>"الموظفين التابعين للشركة والمسؤولين عن أدوار وظيفية محددة بصالحيات محددة يحددها مالك 
    الشركة؛ على سبيل المثال: مسؤول مشتريات، مسؤول مالي..."],
    
            ["key"=>"Delivery","titleEn"=>"Delivery Scheduling ","titleAr"=>"جدولة التوريد","systemValue"=>1,"text_en"=>"Standing Order – 24 Times","text_ar"=>"لتوريد المجزأ – 24 فترة","descriptionEn"=>"The additional accounts with multiple roles and permissions assigned by the business owner, e.g.,Procurement Manager, Finance Officer…","descriptionAr"=>"التوريد لمرة واحدة: في امر شراء عند تحديد جدولة التوريد لمرة واحدة، يكون توريد الطلب على 
            .
            دفعة واحدة للطلب كامال 
            التوريد المجزأ: في امر الشراء عند تحديد جدولة التوريد المجزأ، يتم تقسيم التوريدات لدفعات على 
            فترات مختلفة"],
            ["key"=>"Warehouse","titleEn"=>"Branch and Warehouse Management","titleAr"=>"ادارة المستخدمين","systemValue"=>1,"text_en"=>"30","text_ar"=>"15","descriptionEn"=>"The place to which the requisition is delivered.","descriptionAr"=>"في أمر شراء يتم تحديد الفرع او المستودع الذي سيتم توريد الطلب إليه. "]
            
            
            
             ]



 ],


["id" => 4, "packageNameAr" => 'الأساسية', "packageNameEn"=>'Basic', "type" => 'Supplier',"price1" => "0", "price2" => "4500",
        "features" =>[
            ["key"=>"owner","titleEn"=>"Business owner","titleAr"=>"المستخدم المالك/الرئيس التنفيذي","systemValue"=>1,"text_en"=>"1","text_ar"=>"1","descriptionEn"=>"The official account for the company, with full access to all pages and permissions.",
            "descriptionAr"=>"هو حساب الرئيس التنفيذي للشركة الذي يمتلك جميع صالحيات الوصول"],
            ["key"=>"user","titleEn"=>"User Management","titleAr"=>"ادارة المستخدمين","systemValue"=>1,"text_en"=>"15","text_ar"=>"15","descriptionEn"=>"The additional accounts with multiple roles and permissions assigned by the business owner, e.g.,Procurement Manager, Finance Officer…","descriptionAr"=>"الموظفين التابعين للشركة والمسؤولين عن أدوار وظيفية محددة بصالحيات محددة يحددها مالك 
الشركة؛ على سبيل المثال: مسؤول مشتريات، مسؤول مالي..."],
            ["key"=>"Warehouse","titleEn"=>"Branch and Warehouse Management","titleAr"=>"ادارة المستخدمين","systemValue"=>1,"text_en"=>"10","text_ar"=>"10","descriptionEn"=>"The place to which the requisition is delivered.","descriptionAr"=>"في أمر شراء يتم تحديد الفرع او المستودع الذي سيتم توريد الطلب إليه. "]
 ]
 

],

["id" => 5, "packageNameAr" => 'الذهبية', "packageNameEn"=>'Gold', "type" => 'Supplier',"price1" => "10000", "price2" => "10000",
        "features" =>[
            ["key"=>"owner","titleEn"=>"Business owner","titleAr"=>"المستخدم المالك/الرئيس التنفيذي","systemValue"=>1,"text_en"=>"1","text_ar"=>"1","descriptionEn"=>"The official account for the company, with full access to all pages and permissions.",
            "descriptionAr"=>"هو حساب الرئيس التنفيذي للشركة الذي يمتلك جميع صالحيات الوصول"],
            ["key"=>"user","titleEn"=>"User Management","titleAr"=>"ادارة المستخدمين","systemValue"=>1,"text_en"=>"50","text_ar"=>"50","descriptionEn"=>"The additional accounts with multiple roles and permissions assigned by the business owner, e.g.,Procurement Manager, Finance Officer…","descriptionAr"=>"الموظفين التابعين للشركة والمسؤولين عن أدوار وظيفية محددة بصالحيات محددة يحددها مالك 
الشركة؛ على سبيل المثال: مسؤول مشتريات، مسؤول مالي..."],
            ["key"=>"Warehouse","titleEn"=>"Branch and Warehouse Management","titleAr"=>"ادارة المستخدمين","systemValue"=>1,"text_en"=>"50","text_ar"=>"50","descriptionEn"=>"The place to which the requisition is delivered.","descriptionAr"=>"في أمر شراء يتم تحديد الفرع او المستودع الذي سيتم توريد الطلب إليه. "]
 ]
 

],



];


        // $subscriptionsDetails = [
        //     ["id" => 1, "packageNameAr" => 'الأساسية', "packageNameEn"=>'Basic', "type" => 'Buyer',"price1" => "1250", "price2" => "1250",
        //      "features" =>
        //      [["key"=>"delivery","titleEn"=>"Delivery Scheduling","titleAr"=>"التوصيل","systemValue"=>1,"text_en"=>"One Time Delivery","text_ar"=>"التوصيل لمرة واحدة","descriptionEn"=>"lorem epsom",
        //     "descriptionAr"=>"تفاصيل شرح الميزة"],
        //     ["key"=>"users","titleEn"=>"Users Scheduling","titleAr"=>"المستخدمين","systemValue"=>1,"text_en"=>"10 users","text_ar"=>"  عشرة مستخدمين","descriptionEn"=>"lorem epsom",
        //     "descriptionAr"=>"تفاصيل شرح الميزة"]]],


        //     ["id" => 2, "packageNameAr" => 'الفضية', "packageNameEn"=>'silver', "type" => 'Buyer',"price2" => "1250", "price1" => "1250",
        //      "features" =>
        //      [["titleEn"=>"Delivery Scheduling","systemValue"=>1,"text_en"=>"One Time Delivery","titleAr"=>"التوصيل","text_ar"=>"التوصيل لمرة واحدة","descriptionEn"=>"lorem epsom",
        //     "descriptionAr"=>"تفاصيل شرح الميزة","key"=>"delivery"],
        //     ["titleEn"=>"Users Scheduling","key"=>"users","titleAr"=>"المستخدمين","text_en"=>"10 users","text_ar"=>"  عشرة مستخدمين","descriptionEn"=>"lorem epsom",
        //     "systemValue"=>1,"descriptionAr"=>"تفاصيل شرح الميزة"] ] ],

        //     ["id"=> 2, ""]
        // ];

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

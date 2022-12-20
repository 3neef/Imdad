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
            ["id" => 1, "subscription_name" => 'basic', "type" => 2, "subscription_details" => ["superAdmin" => 1, "users" => 21, "paymentMethods" => "cash/credit", "delivery" => "one_time_delivery/standing_order", "warehouses" => 6, "addSuppliers" => 16, "item_in_each_requisition" => 11, "live_tracking" => true, "FreePrice" => "15.000", "BasePrice" => "10000"]],
            ["id" => 2, "subscription_name" => 'sliver', "type" => 1, "subscription_details" =>
            ["id" => 3, "superAdmin" => 1, "users" => 20, "paymentMethods" => "cash/credit", "delivery" => "one_time_delivery/standing_order", "warehouses" => 5, "addSuppliers" => 15, "item_in_each_requisition" => 10, "live_tracking" => true, "FreePrice" => "5.000", "BasePrice" => "10000"]],
            ["id" => 4, "subscription_name" => 'Gold', "type" => 2, "subscription_details" =>
            ["id" => 5, "superAdmin" => 1, "users" => 5, "paymentMethods" => "cash", "delivery" => "one_time_delivery", "warehouses" => 2, "addSuppliers" => 5, "item_in_each_requisition" => 5, "live_tracking" => false, "FreePrice" => "0", "BasePrice" => "10000"]],
            ["id" => 6, "subscription_name" => 'basic_2', "type" => 2, "subscription_details" =>
            ["id" => 7, "superAdmin" => 1, "users" => 5, "paymentMethods" => "cash", "delivery" => "one_time_delivery", "warehouses" => 2, "addSuppliers" => 5, "item_in_each_requisition" => 5, "live_tracking" => false, "FreePrice" => "1.000", "BasePrice" => "10000"]],
        ];

        foreach ($subscriptionsDetails as $subscriptionsDetail) {
            DB::table('subscription_packages')->insert([
                "id" => $subscriptionsDetail["id"],
                "subscription_name" => $subscriptionsDetail['subscription_name'],
                "type" => $subscriptionsDetail['type'],
                "subscription_details" => json_encode($subscriptionsDetail['subscription_details'], true),
                "created_at" => Carbon::now(),

            ]);
        }
    }
}

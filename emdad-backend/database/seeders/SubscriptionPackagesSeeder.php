<?php

namespace Database\Seeders;

use App\Models\Accounts\SubscriptionPackages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscriptions=[
            ["name"=>"sub_a","superAdmin"=>1,"users"=>21,"paymentMethods"=>"cash/credit","delivery"=>"one_time_delivery/standing_order","warehouses"=>6,"addSuppliers"=>16,"item_in_each_requisition"=>11,"live_tracking"=>true,"price"=>"15.000"],
            ["name"=>"sub_b","superAdmin"=>1,"users"=>20,"paymentMethods"=>"cash/credit","delivery"=>"one_time_delivery/standing_order","warehouses"=>5,"addSuppliers"=>15,"item_in_each_requisition"=>10,"live_tracking"=>true,"price"=>"5.000"],
            ["name"=>"sub_c","superAdmin"=>1,"users"=>5,"paymentMethods"=>"cash","delivery"=>"one_time_delivery","warehouses"=>2,"addSuppliers"=>5,"item_in_each_requisition"=>5,"live_tracking"=>false,"price"=>"0"],
        ];

        foreach ($subscriptions as $subscription) {
            # code...
           SubscriptionPackages::factory()->create([
            "name"=>$subscription['name'],
            "superAdmin"=>$subscription['superAdmin'],
            "users"=>$subscription['users'],
            "paymentMethods"=>$subscription['paymentMethods'],
            "delivery"=>$subscription['delivery'],
            "warehouses"=>$subscription['warehouses'],
            "addSuppliers"=>$subscription['addSuppliers'],
            "item_in_each_requisition"=>$subscription['item_in_each_requisition'],
            "live_tracking"=>$subscription['live_tracking'],
            "price"=>$subscription['price'],
            "subscription_details"=>$subscription
           ]);
        }
    }
}

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

        $subscriptionsDetails=[
            ["subscription_name"=>'basic',"type"=>2,"subscription_details"=>["superAdmin"=>1,"users"=>21,"paymentMethods"=>"cash/credit","delivery"=>"one_time_delivery/standing_order","warehouses"=>6,"addSuppliers"=>16,"item_in_each_requisition"=>11,"live_tracking"=>true,"price"=>"15.000"]],
            ["subscription_name"=>'sliver',"type"=>1,"subscription_details"=>
            ["superAdmin"=>1,"users"=>20,"paymentMethods"=>"cash/credit","delivery"=>"one_time_delivery/standing_order","warehouses"=>5,"addSuppliers"=>15,"item_in_each_requisition"=>10,"live_tracking"=>true,"price"=>"5.000"]],
            ["subscription_name"=>'Gold',"type"=>2,"subscription_details"=>
            ["superAdmin"=>1,"users"=>5,"paymentMethods"=>"cash","delivery"=>"one_time_delivery","warehouses"=>2,"addSuppliers"=>5,"item_in_each_requisition"=>5,"live_tracking"=>false,"price"=>"0"]],
            ["subscription_name"=>'basic_2',"type"=>2,"subscription_details"=>
            ["superAdmin"=>1,"users"=>5,"paymentMethods"=>"cash","delivery"=>"one_time_delivery","warehouses"=>2,"addSuppliers"=>5,"item_in_each_requisition"=>5,"live_tracking"=>false,"price"=>"1.000"]],
        ];
        // dd($subscriptionsDetails);
        foreach ($subscriptionsDetails as $subscriptionsDetail) {
            DB::table('subscription_packages')->insert([
            "subscription_name"=>$subscriptionsDetail['subscription_name'],
              "type"=> $subscriptionsDetail['type'],
            "subscription_details"=>json_encode($subscriptionsDetail['subscription_details'], true ),
            "created_at"=>Carbon::now(),
           ]);
        }
    }
}

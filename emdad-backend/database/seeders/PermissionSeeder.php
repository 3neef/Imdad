<?php

namespace Database\Seeders;

use App\Models\UM\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $permissions=[
            ["name"=>"buyer_rfq_view_create_publish","label"=>"BR1","description"=>""],
            ["name"=>"buyer_rfq_view_create","label"=>"BR2","description"=>""],
            ["name"=>"buyer_rfq_view","label"=>"BR3","description"=>""],
            ["name"=>"buyer_quotes_view_negotiate_accept_reject","label"=>"BQ1","description"=>""],
            ["name"=>"buyer_quotes_view_negotiate","label"=>"BQ2","description"=>""],
            ["name"=>"buyer_quotes_view","label"=>"BQ3","description"=>""],
            ["name"=>"buyer_po_view_create_publish","label"=>"BP1","description"=>""],
            ["name"=>"buyer_po_view_create","label"=>"BP2","description"=>""],
            ["name"=>"buyer_po_view","label"=>"BP3","description"=>""],
            ["name"=>"buyer_invoice_view_pay","label"=>"BI1","description"=>""],
            ["name"=>"buyer_invoice_view","label"=>"BI2","description"=>""],
            ["name"=>"buyer_delivery_view_recieve_return","label"=>"BD1","description"=>""],
            ["name"=>"buyer_delivery_view","label"=>"BD2","description"=>""],
            ["name"=>"supplier_rfq_view_accept_reject","label"=>"SR1","description"=>""],
            ["name"=>"supplier_rfq_view_accept","label"=>"SR2","description"=>""],
            ["name"=>"supplier_quotes_send_cancel_renew_reject","label"=>"SQ3","description"=>""],

        ];

        foreach ($permissions as $permission) {
            # code...
       
               DB::table('permissions')->insert([
                "name" => $permission['name'],
                "label" => $permission['label'],
                "description" => $permission['description'],
                "created_at" => now()
            ]);
        }
    }
}

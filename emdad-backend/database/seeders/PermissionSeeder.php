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
            ["name"=>"supplier_rfq_reject","label"=>"SRFQ3","description"=>""],
            ["name"=>"supplier_rfq_accept","label"=>"SRFQ2","description"=>""],
            ["name"=>"supplier_rfq_view","label"=>"SRFQ1","description"=>""],
            ["name"=>"supplier_quotes_send_cancel_renew_reject","label"=>"SQ3","description"=>""],
            ["name"=>"supplier_quotes_create_edit","label"=>"SQ2","description"=>""],
            ["name"=>"supplier_quotes_send_cancel_renew_reject","label"=>"SQ1","description"=>""],
            ["name"=>"supplier_orders_cancel","label"=>"SPO2","description"=>""],
            ["name"=>"supplier_orders_view","label"=>"SPO1","description"=>""],
            ["name"=>"supplier_tax_invoices_view","label"=>"SCL1","description"=>""],
            ["name"=>"supplier_credit_Agreements_edit","label"=>"SCR3","description"=>""],
            ["name"=>"supplier_credit_Agreements_invite_accept_reject","label"=>"SCR2","description"=>""],
            ["name"=>"supplier_credit_Agreements_view","label"=>"SCR1","description"=>""],
            ["name"=>"supplier_pending_deliveries_return_accept","label"=>"SDD4","description"=>""],
            ["name"=>"supplier_pending_deliveries_assign_driver_truck","label"=>"SDD3","description"=>""],
            ["name"=>"supplier_pending_deliveries_requst_edit_accept","label"=>"SDD2","description"=>""],
            ["name"=>"supplier_pending_deliveries_view","label"=>"SDD1","description"=>""],
            ["name"=>"supplier_tracking_accept_edit_delivery","label"=>"SAP3","description"=>""],
            ["name"=>"supplier_tracking_reject_return","label"=>"SAP2","description"=>""],
            ["name"=>"supplier_tracking_proceding_full_chain_delivery","label"=>"SAP1","description"=>""],











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

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
            ["name"=>"buyer_rfq_view_create_publish","label"=>"BR1","category"=>"BR","description"=>""],
            ["name"=>"buyer_rfq_view_create","label"=>"BR2","category"=>"BR","description"=>""],
            ["name"=>"buyer_rfq_view","label"=>"BR3","category"=>"BR","description"=>""],
            ["name"=>"buyer_quotes_view_negotiate_accept_reject","label"=>"BQ1","category"=>"BQ","description"=>""],
            ["name"=>"buyer_quotes_view_negotiate","label"=>"BQ2","category"=>"BQ","description"=>""],
            ["name"=>"buyer_quotes_view","label"=>"BQ3","category"=>"BQ","description"=>""],
            ["name"=>"buyer_po_view_create_publish","label"=>"BP1","category"=>"BP","description"=>""],
            ["name"=>"buyer_po_view_create","label"=>"BP2","category"=>"BP","description"=>""],
            ["name"=>"buyer_po_view","label"=>"BP3","category"=>"BP","description"=>""],
            ["name"=>"buyer_invoice_view_pay","label"=>"BI1","category"=>"BI","description"=>""],
            ["name"=>"buyer_invoice_view","label"=>"BI2","category"=>"BI","description"=>""],
            ["name"=>"buyer_delivery_view_recieve_return","label"=>"BD1","category"=>"BD","description"=>""],
            ["name"=>"buyer_delivery_view","label"=>"BD2","category"=>"BD","description"=>""],
            ["name"=>"supplier_rfq_reject","label"=>"SRFQ3","category"=>"SRFQ","description"=>""],
            ["name"=>"supplier_rfq_accept","label"=>"SRFQ2","category"=>"SRFQ","description"=>""],
            ["name"=>"supplier_rfq_view","label"=>"SRFQ1","category"=>"SRFQ","description"=>""],
            ["name"=>"supplier_quotes_send_cancel_renew_reject","label"=>"SQ3","category"=>"SQ","description"=>""],
            ["name"=>"supplier_quotes_create_edit","label"=>"SQ2","category"=>"SQ","description"=>""],
            ["name"=>"supplier_quotes_send_cancel_renew_reject","label"=>"SQ1","category"=>"SQ","description"=>""],
            ["name"=>"supplier_orders_cancel","label"=>"SPO2","category"=>"SPO","description"=>""],
            ["name"=>"supplier_orders_view","label"=>"SPO1","category"=>"SPO","description"=>""],
            ["name"=>"supplier_tax_invoices_view","label"=>"SCL1","category"=>"SCL","description"=>""],
            ["name"=>"supplier_credit_Agreements_edit","label"=>"SCR3","category"=>"SCR","description"=>""],
            ["name"=>"supplier_credit_Agreements_invite_accept_reject","label"=>"SCR2","category"=>"SCR","description"=>""],
            ["name"=>"supplier_credit_Agreements_view","label"=>"SCR1","category"=>"SCR1","description"=>""],
            ["name"=>"supplier_pending_deliveries_return_accept","label"=>"SDD4","category"=>"SDD","description"=>""],
            ["name"=>"supplier_pending_deliveries_assign_driver_truck","label"=>"SDD3","category"=>"SDD","description"=>""],
            ["name"=>"supplier_pending_deliveries_requst_edit_accept","label"=>"SDD2","category"=>"SDD","description"=>""],
            ["name"=>"supplier_pending_deliveries_view","label"=>"SDD1","category"=>"SDD","description"=>""],
            ["name"=>"supplier_tracking_accept_edit_delivery","label"=>"SAP3","category"=>"SAP","description"=>""],
            ["name"=>"supplier_tracking_reject_return","label"=>"SAP2","category"=>"SAP","description"=>""],
            ["name"=>"supplier_tracking_proceding_full_chain_delivery","label"=>"SAP1","category"=>"SAP","description"=>""],
            ["name"=>"supplier_customer_freeze_delayed_payment","label"=>"SMCS5","category"=>"SMCS","description"=>""],
            ["name"=>"supplier_customer_partnership_freeze","label"=>"SMCS4","category"=>"SMCS","description"=>""],
            ["name"=>"supplier_customer_reject_accept","label"=>"SMCS3","category"=>"SMCS","description"=>""],
            ["name"=>"supplier_customer_add_request_join","label"=>"SMCS2","category"=>"SMCS","description"=>""],
            ["name"=>"supplier_customer_view","label"=>"SMCS1","category"=>"SMCS","description"=>""],
            ["name"=>"supplier_user_inter","label"=>"SMU4","category"=>"SMU","description"=>""],
            ["name"=>"supplier_user_accept_reject_activate_edit","label"=>"SMU3","category"=>"SMU","description"=>""],
            ["name"=>"supplier_user_add","label"=>"SMU2","category"=>"SMU","description"=>""],
            ["name"=>"supplier_user_view","label"=>"SMU1","category"=>"SMU","description"=>""],
            ["name"=>"supplier_communication_company_messages","label"=>"SML2","category"=>"SML","description"=>""],
            ["name"=>"supplier_communication_user_messages","label"=>"SML1","category"=>"SML","description"=>""],
            ["name"=>"supplier_account_subscription_freeze","label"=>"SMC3","category"=>"SMC","description"=>""],
            ["name"=>"supplier_account_subscription_view_sub_upgrade","label"=>"SMC2","category"=>"SMC","description"=>""],
            ["name"=>"supplier_account_subscription_view_company","label"=>"SMC1","category"=>"SMC","description"=>""],
            ["name"=>"supplier_category_prdouct_managment_request_add","label"=>"SMCT2","category"=>"SMCT","description"=>""],
            ["name"=>"supplier_category_prdouct_managment_view","label"=>"SMCT1","category"=>"SMCT","description"=>""],
            ["name"=>"supplier_notification_all_company","label"=>"SMUP2","category"=>"SMUP","description"=>""],
            ["name"=>"supplier_notification_user","label"=>"SMUP1","category"=>"SMUP","description"=>""],
            ["name"=>"supplier_add_companies_add","label"=>"SMCD1","category"=>"SMUD","description"=>""],
            ["name"=>"supplier_alrts_view","label"=>"SMAL1","category"=>"SMAL","description"=>""],
            ["name"=>"supplier_business_mail_create_action_send","label"=>"SMMB2","category"=>"SMMB","description"=>""],
            ["name"=>"supplier_business_mail_view","label"=>"SMMB1","category"=>"SMMB","description"=>""],
            ["name"=>"supplier_Fleet_unactive_active","label"=>"SMFL4","category"=>"SMFL","description"=>""],
            ["name"=>"supplier_Fleet_edit","label"=>"SMFL3","category"=>"SMFL","description"=>""],
            ["name"=>"supplier_Fleet_add","label"=>"SMFL2","category"=>"SMFL","description"=>""],
            ["name"=>"supplier_Fleet_view","label"=>"SMFL1","category"=>"SMFL","description"=>""],
            ["name"=>"supplier_digital_apps_all_reports","label"=>"SMAP2","category"=>"SMAP","description"=>""],
            ["name"=>"supplier_digital_user_reports","label"=>"SMAP1","category"=>"SMAP","description"=>""],











        ];

        foreach ($permissions as $permission) {
            # code...
       
               DB::table('permissions')->insert([
                "name" => $permission['name'],
                "label" => $permission['label'],
                "description" => $permission['description'],
                'category'=>$permission['category'],
                "created_at" => now()
            ]);
        }
    }
}

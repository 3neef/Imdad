<?php

namespace Database\Seeders;

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

        $permissions = [
            ["id" => 1, "name" => "buyer_rfq_view_create_publish", "label" => "BR1", "category" => "BR", "description" => ""],
            ["id" => 2, "name" => "buyer_rfq_view_create", "label" => "BR2", "category" => "BR", "description" => ""],
            ["id" => 3, "name" => "buyer_rfq_view", "label" => "BR3", "category" => "BR", "description" => ""],
            ["id" => 4, "name" => "buyer_quotes_view_negotiate_accept_reject", "label" => "BQ1", "category" => "BQ", "description" => ""],
            ["id" => 5, "name" => "buyer_quotes_view_negotiate", "label" => "BQ2", "category" => "BQ", "description" => ""],
            ["id" => 6, "name" => "buyer_quotes_view", "label" => "BQ3", "category" => "BQ", "description" => ""],
            ["id" => 7, "name" => "buyer_po_view_create_publish", "label" => "BP1", "category" => "BP", "description" => ""],
            ["id" => 8, "name" => "buyer_po_view_create", "label" => "BP2", "category" => "BP", "description" => ""],
            ["id" => 9, "name" => "buyer_po_view", "label" => "BP3", "category" => "BP", "description" => ""],
            ["id" => 10, "name" => "buyer_invoice_view_pay", "label" => "BI1", "category" => "BI", "description" => ""],
            ["id" => 11, "name" => "buyer_invoice_view", "label" => "BI2", "category" => "BI", "description" => ""],
            ["id" => 12, "name" => "buyer_delivery_view_recieve_return", "label" => "BD1", "category" => "BD", "description" => ""],
            ["id" => 13, "name" => "buyer_delivery_view", "label" => "BD2", "category" => "BD", "description" => ""],
            ["id" => 14, "name" => "supplier_rfq_reject", "label" => "SRFQ3", "category" => "SRFQ", "description" => ""],
            ["id" => 15, "name" => "supplier_rfq_accept", "label" => "SRFQ2", "category" => "SRFQ", "description" => ""],
            ["id" => 16, "name" => "supplier_rfq_view", "label" => "SRFQ1", "category" => "SRFQ", "description" => ""],
            ["id" => 17, "name" => "supplier_quotes_send_cancel_renew_reject", "label" => "SQ3", "category" => "SQ", "description" => ""],
            ["id" => 18, "name" => "supplier_quotes_create_edit", "label" => "SQ2", "category" => "SQ", "description" => ""],
            ["id" => 19, "name" => "supplier_quotes_send_cancel_renew_reject", "label" => "SQ1", "category" => "SQ", "description" => ""],
            ["id" => 20, "name" => "supplier_orders_cancel", "label" => "SPO2", "category" => "SPO", "description" => ""],
            ["id" => 21, "name" => "supplier_orders_view", "label" => "SPO1", "category" => "SPO", "description" => ""],
            ["id" => 22, "name" => "supplier_tax_invoices_view", "label" => "SCL1", "category" => "SCL", "description" => ""],
            ["id" => 23, "name" => "supplier_credit_Agreements_edit", "label" => "SCR3", "category" => "SCR", "description" => ""],
            ["id" => 24, "name" => "supplier_credit_Agreements_invite_accept_reject", "label" => "SCR2", "category" => "SCR", "description" => ""],
            ["id" => 25, "name" => "supplier_credit_Agreements_view", "label" => "SCR1", "category" => "SCR1", "description" => ""],
            ["id" => 26, "name" => "supplier_pending_deliveries_return_accept", "label" => "SDD4", "category" => "SDD", "description" => ""],
            ["id" => 27, "name" => "supplier_pending_deliveries_assign_driver_truck", "label" => "SDD3", "category" => "SDD", "description" => ""],
            ["id" => 28, "name" => "supplier_pending_deliveries_requst_edit_accept", "label" => "SDD2", "category" => "SDD", "description" => ""],
            ["id" => 29, "name" => "supplier_pending_deliveries_view", "label" => "SDD1", "category" => "SDD", "description" => ""],
            ["id" => 30, "name" => "supplier_tracking_accept_edit_delivery", "label" => "SAP3", "category" => "SAP", "description" => ""],
            ["id" => 31, "name" => "supplier_tracking_reject_return", "label" => "SAP2", "category" => "SAP", "description" => ""],
            ["id" => 32, "name" => "supplier_tracking_proceding_full_chain_delivery", "label" => "SAP1", "category" => "SAP", "description" => ""],
            ["id" => 33, "name" => "supplier_customer_freeze_delayed_payment", "label" => "SMCS5", "category" => "SMCS", "description" => ""],
            ["id" => 34, "name" => "supplier_customer_partnership_freeze", "label" => "SMCS4", "category" => "SMCS", "description" => ""],
            ["id" => 35, "name" => "supplier_customer_reject_accept", "label" => "SMCS3", "category" => "SMCS", "description" => ""],
            ["id" => 36, "name" => "supplier_customer_add_request_join", "label" => "SMCS2", "category" => "SMCS", "description" => ""],
            ["id" => 37, "name" => "supplier_customer_view", "label" => "SMCS1", "category" => "SMCS", "description" => ""],
            ["id" => 38, "name" => "supplier_user_inter", "label" => "SMU4", "category" => "SMU", "description" => ""],
            ["id" => 39, "name" => "supplier_user_accept_reject_activate_edit", "label" => "SMU3", "category" => "SMU", "description" => ""],
            ["id" => 40, "name" => "supplier_user_add", "label" => "SMU2", "category" => "SMU", "description" => ""],
            ["id" => 41, "name" => "supplier_user_view", "label" => "SMU1", "category" => "SMU", "description" => ""],
            ["id" => 42, "name" => "supplier_communication_company_messages", "label" => "SML2", "category" => "SML", "description" => ""],
            ["id" => 43, "name" => "supplier_communication_user_messages", "label" => "SML1", "category" => "SML", "description" => ""],
            ["id" => 44, "name" => "supplier_account_subscription_freeze", "label" => "SMC3", "category" => "SMC", "description" => ""],
            ["id" => 45, "name" => "supplier_account_subscription_view_sub_upgrade", "label" => "SMC2", "category" => "SMC", "description" => ""],
            ["id" => 46, "name" => "supplier_account_subscription_view_company", "label" => "SMC1", "category" => "SMC", "description" => ""],
            ["id" => 47, "name" => "supplier_category_prdouct_managment_request_add", "label" => "SMCT2", "category" => "SMCT", "description" => ""],
            ["id" => 48, "name" => "supplier_category_prdouct_managment_view", "label" => "SMCT1", "category" => "SMCT", "description" => ""],
            ["id" => 49, "name" => "supplier_notification_all_company", "label" => "SMUP2", "category" => "SMUP", "description" => ""],
            ["id" => 50, "name" => "supplier_notification_user", "label" => "SMUP1", "category" => "SMUP", "description" => ""],
            ["id" => 51, "name" => "supplier_add_companies_add", "label" => "SMCD1", "category" => "SMUD", "description" => ""],
            ["id" => 52, "name" => "supplier_alrts_view", "label" => "SMAL1", "category" => "SMAL", "description" => ""],
            ["id" => 53, "name" => "supplier_business_mail_create_action_send", "label" => "SMMB2", "category" => "SMMB", "description" => ""],
            ["id" => 54, "name" => "supplier_business_mail_view", "label" => "SMMB1", "category" => "SMMB", "description" => ""],
            ["id" => 55, "name" => "supplier_Fleet_unactive_active", "label" => "SMFL4", "category" => "SMFL", "description" => ""],
            ["id" => 56, "name" => "supplier_Fleet_edit", "label" => "SMFL3", "category" => "SMFL", "description" => ""],
            ["id" => 57, "name" => "supplier_Fleet_add", "label" => "SMFL2", "category" => "SMFL", "description" => ""],
            ["id" => 58, "name" => "supplier_Fleet_view", "label" => "SMFL1", "category" => "SMFL", "description" => ""],
            ["id" => 59, "name" => "supplier_digital_apps_all_reports", "label" => "SMAP2", "category" => "SMAP", "description" => ""],
            ["id" => 60, "name" => "supplier_digital_user_reports", "label" => "SMAP1", "category" => "SMAP", "description" => ""],
            ["id" => 61, "name" => "buyer_supplier_Partenership_freeze", "label" => "BMCD4", "category" => "BMCD", "description"=>""],
            ["id" => 62, "name" => "buyer_supplier_Rejecting_and_Accepting", "label" => "BMCD3", "category" => "BMCD", "description"=>""],
            ["id" => 63, "name" => "buyer_supplier_Adding_and_request_to_join", "label" => "BMCD2", "category" => "BMCD", "description"=>""],
            ["id" => 64, "name" => "buyer_supplier_Viewing_suppliers_profile", "label" => "BMCD1", "category" => "BMCD", "description"=>""],
            ["id" => 65, "name" => "buyer_User_Management_Entering_to_users_account", "label" => "BMU4", "category" => "BMU", "description"=>""],
            ["id" => 66, "name" => "buyer_User_Management_Accepting_rejecting_activating_and_editing", "label" => "BMU3", "category" => "BMU", "description"=>""],
            ["id" => 67, "name" => "buyer_User_Management_Adding", "label" => "BMU2", "category" => "BMU", "description"=>""],
            ["id" => 68, "name" => "buyer_User_Management_Viewing", "label" => "BMU1", "category" => "BMU", "description"=>""],
            ["id" => 69, "name" => "buyer_User_Live_Communication_All_company_messeges", "label" => "BML2", "category" => "BML", "description"=>""],
            ["id" => 70, "name" => "buyer_User_Live_Communication_User's_own_messages", "label" => "BML1", "category" => "BML", "description"=>""],
            ["id" => 71, "name" => "buyer_Company_Account_and_Subscription_Requesting_subscription_freeze_for_a_period", "label" => "BMCO3", "category" => "BMCO", "description"=>""],
            ["id" => 72, "name" => "buyer_Company_Account_and_Subscription_Viewing_subscription_and_upgarde", "label" => "BMCO2", "category" => "BMCO", "description"=>""],
            ["id" => 73, "name" => "buyer_Company_Account_and_Subscription_Viewing_company_profile", "label" => "BMCO1", "category" => "BMCO", "description"=>""],
            ["id" => 74, "name" => "buyer_Category_and_Products_Management_Requesting_and_adding", "label" => "BMCT2", "category" => "BMCT", "description"=>""],
            ["id" => 75, "name" => "buyer_Category_and_Products_Management_Viewing", "label" => "BMCT1", "category" => "BMCT", "description"=>""],
            ["id" => 76, "name" => "buyer_Notifications_All_company_notifications", "label" => "BMNM2", "category" => "BMNM", "description"=>""],
            ["id" => 77, "name" => "buyer_Notifications_User's_own_notifications", "label" => "BMNM1", "category" => "BMNM", "description"=>""],
            ["id" => 78, "name" => "buyer_Alrts_Box_Viewing", "label" => "BMCA2", "category" => "BMCA", "description"=>""],
            ["id" => 79, "name" => "buyer_Bussiness_Mail_Creating_approving_and_closing_agreements", "label" => "BMMB2", "category" => "BMMB", "description"=>""],
            ["id" => 80, "name" => "buyer_Bussiness_Mail_Viewing", "label" => "BMMB1", "category" => "BMMB", "description"=>""],
            ["id" => 81, "name" => "buyer_Adding_More_Company_Adding", "label" => "BMCD1", "category" => "BMCD", "description"=>""],
            ["id" => 82, "name" => "buyer_Credit_Agreements_Requesting_rejecting_and_accepting", "label" => "BMCT2", "category" => "BMCT", "description"=>""],
            ["id" => 83, "name" => "buyer_Credit_Agreements_Viewing", "label" => "BMCT1", "category" => "BMCT", "description"=>""],
            ["id" => 84, "name" => "buyer_Digital_Engines_Apps_All_company_reports", "label" => "BMDE2", "category" => "BMDE", "description"=>""],
            ["id" => 85, "name" => "buyer_Digital_Engines_Apps_User's_own_reports", "label" => "BMDE1", "category" => "BMDE", "description"=>""],
        ];

        foreach ($permissions as $permission) {
            # code...

            DB::table('permissions')->insert([
                "id" => $permission['id'],
                "name" => $permission['name'],
                "label" => $permission['label'],
                "description" => $permission['description'],
                'category' => $permission['category'],
                "created_at" => now()
            ]);
        }
    }
}

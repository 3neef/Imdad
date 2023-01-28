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
            ["name" => "buyer_rfq_publish", "label" => "BR1", "category" => "BR", "description" => ""],
            ["name" => "buyer_rfq_view_create", "label" => "BR2", "category" => "BR", "description" => ""],
            ["name" => "buyer_rfq_view", "label" => "BR3", "category" => "BR", "description" => ""],
            ["name" => "buyer_quotes_negotiate_accept", "label" => "BQ1", "category" => "BQ", "description" => ""],
            ["name" => "buyer_quotes_view_negotiate", "label" => "BQ2", "category" => "BQ", "description" => ""],
            ["name" => "buyer_quotes_view_rejected", "label" => "BQ3", "category" => "BQ", "description" => ""],
            ["name" => "buyer_po_publish", "label" => "BP1", "category" => "BP", "description" => ""],
            ["name" => "buyer_po_create", "label" => "BP2", "category" => "BP", "description" => ""],
            ["name" => "buyer_po_view", "label" => "BP3", "category" => "BP", "description" => ""],
            ["name" => "buyer_invoice_pay", "label" => "BI1", "category" => "BI", "description" => ""],
            ["name" => "buyer_invoice_view", "label" => "BI2", "category" => "BI", "description" => ""],
            ["name" => "buyer_delivery_recieve", "label" => "BD1", "category" => "BD", "description" => ""],
            ["name" => "buyer_delivery_view", "label" => "BD2", "category" => "BD", "description" => ""],
            ["name" => "buyer_delivery_return", "label" => "BD3", "category" => "BD", "description" => ""],
            ["name" => "supplier_rfq_reject", "label" => "SRFQ3", "category" => "SRFQ", "description" => ""],
            ["name" => "supplier_rfq_accept", "label" => "SRFQ2", "category" => "SRFQ", "description" => ""],
            ["name" => "supplier_rfq_view", "label" => "SRFQ1", "category" => "SRFQ", "description" => ""],
            ["name" => "supplier_quotes_send", "label" => "SQ6", "category" => "SQ", "description" => ""],
            ["name" => "supplier_quotes_cancel", "label" => "SQ5", "category" => "SQ", "description" => ""],
            ["name" => "supplier_quotes_renew", "label" => "SQ4", "category" => "SQ", "description" => ""],
            ["name" => "supplier_quotes_reject", "label" => "SQ3", "category" => "SQ", "description" => ""],
            ["name" => "supplier_quotes_edit", "label" => "SQ2", "category" => "SQ", "description" => ""],
            ["name" => "supplier_quotes_create", "label" => "SQ1", "category" => "SQ", "description" => ""],
            ["name" => "supplier_orders_cancel", "label" => "SPO2", "category" => "SPO", "description" => ""],
            ["name" => "supplier_orders_view", "label" => "SPO1", "category" => "SPO", "description" => ""],
            ["name" => "supplier_tax_invoices_view", "label" => "SCL1", "category" => "SCL", "description" => ""],
            ["name" => "supplier_credit_Agreements_edit", "label" => "SCR45", "category" => "SCR", "description" => ""],
            ["name" => "supplier_credit_Agreements_accept", "label" => "SCR4", "category" => "SCR", "description" => ""],
            ["name" => "supplier_credit_Agreements_invite", "label" => "SCR3", "category" => "SCR", "description" => ""],
            ["name" => "supplier_credit_Agreements_reject", "label" => "SCR2", "category" => "SCR", "description" => ""],
            ["name" => "supplier_credit_Agreements_view", "label" => "SCR1", "category" => "SCR1", "description" => ""],
            ["name" => "supplier_pending_deliveries_return", "label" => "SDD7", "category" => "SDD", "description" => ""],
            ["name" => "supplier_pending_deliveries_accept", "label" => "SDD6", "category" => "SDD", "description" => ""],
            ["name" => "supplier_pending_deliveries_assign_driver_to_truck", "label" => "SDD5", "category" => "SDD", "description" => ""],
            ["name" => "supplier_pending_deliveries_requst", "label" => "SDD4", "category" => "SDD", "description" => ""],
            ["name" => "supplier_pending_deliveries_edit", "label" => "SDD3", "category" => "SDD", "description" => ""],
            ["name" => "supplier_pending_deliveries_accept", "label" => "SDD2", "category" => "SDD", "description" => ""],
            ["name" => "supplier_pending_deliveries_view", "label" => "SDD1", "category" => "SDD", "description" => ""],
            ["name" => "supplier_tracking_accept", "label" => "SAP6", "category" => "SAP", "description" => ""],
            ["name" => "supplier_tracking_edit", "label" => "SAP5", "category" => "SAP", "description" => ""],
            ["name" => "supplier_tracking_delivery", "label" => "SAP4", "category" => "SAP", "description" => ""],
            ["name" => "supplier_tracking_reject", "label" => "SAP3", "category" => "SAP", "description" => ""],
            ["name" => "supplier_tracking_return", "label" => "SAP2", "category" => "SAP", "description" => ""],
            ["name" => "supplier_tracking_proceding_full_chain_delivery", "label" => "SAP1", "category" => "SAP", "description" => ""],
            ["name" => "supplier_customer_freeze_delayed_payment", "label" => "SMCS6", "category" => "SMCS", "description" => ""],
            ["name" => "supplier_customer_partnership_freeze", "label" => "SMCS5", "category" => "SMCS", "description" => ""],
            ["name" => "supplier_customer_accept", "label" => "SMCS4", "category" => "SMCS", "description" => ""],
            ["name" => "supplier_customer_reject", "label" => "SMCS3", "category" => "SMCS", "description" => ""],
            ["name" => "supplier_customer_add_request_join", "label" => "SMCS2", "category" => "SMCS", "description" => ""],
            ["name" => "supplier_customer_view", "label" => "SMCS1", "category" => "SMCS", "description" => ""],
            ["name" => "supplier_user_inter", "label" => "SMU7", "category" => "SMU", "description" => ""],
            ["name" => "supplier_user_accept", "label" => "SMU6", "category" => "SMU", "description" => ""],
            ["name" => "supplier_user_reject", "label" => "SMU5", "category" => "SMU", "description" => ""],
            ["name" => "supplier_user_activate", "label" => "SMU4", "category" => "SMU", "description" => ""],
            ["name" => "supplier_user_edit", "label" => "SMU3", "category" => "SMU", "description" => ""],
            ["name" => "supplier_user_add", "label" => "SMU2", "category" => "SMU", "description" => ""],
            ["name" => "supplier_user_view", "label" => "SMU1", "category" => "SMU", "description" => ""],
            ["name" => "supplier_communication_company_messages", "label" => "SML2", "category" => "SML", "description" => ""],
            ["name" => "supplier_communication_user_messages", "label" => "SML1", "category" => "SML", "description" => ""],
            ["name" => "supplier_account_subscription_freeze", "label" => "SMC3", "category" => "SMC", "description" => ""],
            ["name" => "supplier_account_subscription_view_sub_upgrade", "label" => "SMC2", "category" => "SMC", "description" => ""],
            ["name" => "supplier_account_subscription_view_company", "label" => "SMC1", "category" => "SMC", "description" => ""],
            ["name" => "supplier_category_prdouct_managment_request_add", "label" => "SMCT2", "category" => "SMCT", "description" => ""],
            ["name" => "supplier_category_prdouct_managment_view", "label" => "SMCT1", "category" => "SMCT", "description" => ""],
            ["name" => "supplier_notification_all_company", "label" => "SMUP2", "category" => "SMUP", "description" => ""],
            ["name" => "supplier_notification_user", "label" => "SMUP1", "category" => "SMUP", "description" => ""],
            ["name" => "supplier_add_companies_add", "label" => "SMCD1", "category" => "SMUD", "description" => ""],
            ["name" => "supplier_alrts_view", "label" => "SMAL1", "category" => "SMAL", "description" => ""],
            ["name" => "supplier_business_mail_create_action_send", "label" => "SMMB2", "category" => "SMMB", "description" => ""],
            ["name" => "supplier_business_mail_view", "label" => "SMMB1", "category" => "SMMB", "description" => ""],
            ["name" => "supplier_Fleet_active", "label" => "SMFL5", "category" => "SMFL", "description" => ""],
            ["name" => "supplier_Fleet_unactive", "label" => "SMFL4", "category" => "SMFL", "description" => ""],
            ["name" => "supplier_Fleet_edit", "label" => "SMFL3", "category" => "SMFL", "description" => ""],
            ["name" => "supplier_Fleet_add", "label" => "SMFL2", "category" => "SMFL", "description" => ""],
            ["name" => "supplier_Fleet_view", "label" => "SMFL1", "category" => "SMFL", "description" => ""],
            ["name" => "supplier_digital_apps_all_reports", "label" => "SMAP2", "category" => "SMAP", "description" => ""],
            ["name" => "supplier_digital_user_reports", "label" => "SMAP1", "category" => "SMAP", "description" => ""],
            ["name" => "buyer_supplier_Partenership_freeze", "label" => "BMCD7", "category" => "BMCD", "description" => ""],
            ["name" => "buyer_supplier_Accepting", "label" => "BMCD6", "category" => "BMCD", "description" => ""],
            ["name" => "buyer_supplier_Rejecting", "label" => "BMCD5", "category" => "BMCD", "description" => ""],
            ["name" => "buyer_supplier_Adding", "label" => "BMCD4", "category" => "BMCD", "description" => ""],
            ["name" => "buyer_supplier_request_to_join", "label" => "BMCD3", "category" => "BMCD", "description" => ""],
            ["name" => "buyer_Adding_More_Company_Adding", "label" => "BMCD2", "category" => "BMCD", "description" => ""],
            ["name" => "buyer_supplier_Viewing_suppliers_profile", "label" => "BMCD1", "category" => "BMCD", "description" => ""],
            ["name" => "buyer_User_Management_Entering_to_users_account", "label" => "BMU5", "category" => "BMU", "description" => ""],
            ["name" => "buyer_User_Management_activating", "label" => "BMU4", "category" => "BMU", "description" => ""],
            ["name" => "buyer_User_Management_editing", "label" => "BMU3", "category" => "BMU", "description" => ""],
            ["name" => "buyer_User_Management_Adding", "label" => "BMU2", "category" => "BMU", "description" => ""],
            ["name" => "buyer_User_Management_Viewing", "label" => "BMU1", "category" => "BMU", "description" => ""],
            ["name" => "buyer_User_Live_Communication_All_company_messeges", "label" => "BML2", "category" => "BML", "description" => ""],
            ["name" => "buyer_User_Live_Communication_User's_own_messages", "label" => "BML1", "category" => "BML", "description" => ""],
            ["name" => "buyer_Company_Account_and_Subscription_Requesting_subscription_freeze_for_a_period", "label" => "BMCO3", "category" => "BMCO", "description" => ""],
            ["name" => "buyer_Company_Account_and_Subscription_Viewing_subscription_and_upgarde", "label" => "BMCO2", "category" => "BMCO", "description" => ""],
            ["name" => "buyer_Company_Account_and_Subscription_Viewing_company_profile", "label" => "BMCO1", "category" => "BMCO", "description" => ""],
            ["name" => "buyer_Category_and_Products_Management_adding", "label" => "BMCT7", "category" => "BMCT", "description" => ""],
            ["name" => "buyer_Category_and_Products_Management_Requesting", "label" => "BMCT6", "category" => "BMCT", "description" => ""],
            ["name" => "buyer_Credit_Agreements_Requesting", "label" => "BMCT5", "category" => "BMCT", "description" => ""],
            ["name" => "buyer_Credit_Agreements_rejecting", "label" => "BMCT4", "category" => "BMCT", "description" => ""],
            ["name" => "buyer_Credit_Agreements_accepting", "label" => "BMCT3", "category" => "BMCT", "description" => ""],
            ["name" => "buyer_Credit_Agreements_Viewing", "label" => "BMCT2", "category" => "BMCT", "description" => ""],
            ["name" => "buyer_Category_and_Products_Management_Viewing", "label" => "BMCT1", "category" => "BMCT", "description" => ""],
            ["name" => "buyer_Notifications_All_company_notifications", "label" => "BMNM2", "category" => "BMNM", "description" => ""],
            ["name" => "buyer_Notifications_User's_own_notifications", "label" => "BMNM1", "category" => "BMNM", "description" => ""],
            ["name" => "buyer_Alrts_Box_Viewing", "label" => "BMCA2", "category" => "BMCA", "description" => ""],
            ["name" => "buyer_Bussiness_Mail_Creating", "label" => "BMMB5", "category" => "BMMB", "description" => ""],
            ["name" => "buyer_Bussiness_Mail_Creating", "label" => "BMMB4", "category" => "BMMB", "description" => ""],
            ["name" => "buyer_Bussiness_Mail_approving", "label" => "BMMB3", "category" => "BMMB", "description" => ""],
            ["name" => "buyer_Bussiness_Mail_closing_agreements", "label" => "BMMB2", "category" => "BMMB", "description" => ""],
            ["name" => "buyer_Bussiness_Mail_Viewing", "label" => "BMMB1", "category" => "BMMB", "description" => ""],
            ["name" => "buyer_Digital_Engines_Apps_All_company_reports", "label" => "BMDE2", "category" => "BMDE", "description" => ""],
            ["name" => "buyer_Digital_Engines_Apps_User's_own_reports", "label" => "BMDE1", "category" => "BMDE", "description" => ""],
        ];

        foreach ($permissions as $permission) {
            # code...

            DB::table('permissions')->insert([
                "name" => $permission['name'],
                "label" => $permission['label'],
                "description" => $permission['description'],
                'category' => $permission['category'],
                "created_at" => now()
            ]);
        }
    }
}

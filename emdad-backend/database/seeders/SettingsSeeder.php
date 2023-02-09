<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\SettingsModel;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $names = [
            ['Key'=>'version','Value'=>'0.01'],
            ['Key'=>'sms_otp_en','Value'=>'604'],
            ['Key'=>'sms_password_en','Value'=>'582'],
        ];

        foreach ($names as $name) {
            DB::table('app_settings')->insert([
                "Key" => $name["Key"],
                "Value" => $name["Value"],
            ]);
        }
    }
}

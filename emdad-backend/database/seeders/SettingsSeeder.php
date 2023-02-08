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
        $names = ['Key'=>'','Value'=>''];

        foreach ($names as $name) {
            DB::table('settings_models')->insert([
                "Key" => $name["Key"],
                "Value" => $name["Value"],
            ]);
        }
    }
}

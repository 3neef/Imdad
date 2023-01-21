<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coupons = [
            'code' => rand(100, 99),
            'value' => rand(100, 99),
            'is_percentage' => 1,
            'start_date' => '2025-1-1',
            'end_date' => '2026-1-1',
            'allowed' => 100,
            'used'=>0,

        ];
            
            DB::table('coupons')->insert([
                "code" => $coupons['code'],
                "value" => $coupons['value'],
                "is_percentage" => $coupons['is_percentage'],
                "start_date" => $coupons['start_date'],
                "end_date" => $coupons['end_date'],
                "allowed" => $coupons['allowed'],
                "used" => $coupons['used']
            ]);
        
    }
    
}

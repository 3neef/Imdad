<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppSetting;
use App\Http\Resources\General\AppSettingsResource;
use App\Http\Services\General\AppSettingsService;
use App\Models\AppSetting;
use App\Models\Settings\Setting;

class AppSettingController extends Controller
{
    public function index()
    {
        $AppSetting = AppSetting::get();
        return response()->json(['success' => true, 'data' => AppSettingsResource::collection($AppSetting), 'statusCode' => '000'], 200);
    }

    public function store(StoreAppSetting $request, AppSettingsService $appSettings)

    {
        $output = $appSettings->store($request->all());
        return response()->json(['success' => true, 'data' => AppSettingsResource::collection($output), 'statusCode' => '000', 'message' => 'settings created successfluy'], 200);
    }
}

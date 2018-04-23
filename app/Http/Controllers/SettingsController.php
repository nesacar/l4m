<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function edit($id){
        $setting = Setting::find(1);

        return response()->json([
            'setting' => $setting
        ]);
    }

    public function update(Request $request, $id){
        $setting = Setting::find(1);
        $setting->update(request()->all());

        return response()->json([
            'setting' => $setting
        ]);
    }
}

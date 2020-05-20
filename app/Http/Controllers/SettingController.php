<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {
        $this->authorize('settings_access');
    	$settings = Setting::get()->all();
    	return view('admin/settings')->with('settings', $settings);
    }

    public function update(Request $request)
    {
        $this->authorize('settings_update');
    	foreach ($request->input('settings') as $setting) {
    		Setting::where('id', $setting['id'])
    				->update(['setting_value' => $setting['setting_value']]);
    	}

    	return redirect()->back()->withErrors('UPDATED !! Settings are succcessfully updated');
    }
}

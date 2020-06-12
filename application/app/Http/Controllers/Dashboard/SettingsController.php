<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $settings = Settings::paginate(5);
        return view('settings.index', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings){
        $settings->fill($request->input())->save();
        Cache::forget('settings');
        toast('Settings Updated Successfully!','success','top-right');
        return redirect()->route('dashboard.settings.index');
    }

    /**
     * Search for settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $settings = Settings::where('pretty_title', 'LIKE', '%' . $request->search . '%')->get();
        return view('settings.search', compact('settings'));
    }
}

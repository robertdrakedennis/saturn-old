<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\SteamApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SteamApiKeyController extends Controller{

    private static $sapi_gps_url = 'https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=%s&steamids=%s';

    public function index(){
        $steam = SteamApi::first();

        $attribute = Auth::user();

        $steamApi = (new SteamApi)->steamApi($steam, $attribute);
        return view('steam.api.index', compact('steam', 'steamApi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SteamApi $steamApi
     * @return \Illuminate\Http\Response
     */
    public function edit(SteamApi $steamApi){
        return view('steam.api.edit', compact('steamApi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \App\Models\SteamApi $steamApi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SteamApi $steamApi){
        if ($request->api_key === $steamApi->api_key) {
            alert()
                ->warning('Wait!', "This API key is the same as the current one. Try using a different one!")
                ->showCloseButton('aria-label')
                ->showConfirmButton('Ok, got it', '#3085d6')
                ->autoClose(10000);

            return back()->withInput();
        } else {
            try {
                file_get_contents(sprintf(static::$sapi_gps_url, $request->api_key, Auth::user()->steamid));
            } catch (\Exception $e) {
                alert()
                    ->error('Oops!', "It looks like your Steam API key is invalid. Please double check that you've entered it correctly.")
                    ->footer('Need help? Contact support!')
                    ->showCloseButton('aria-label')
                    ->showConfirmButton('Ok, got it', '#3085d6')
                    ->autoClose(10000);
                return back()->withInput();
            }
        }

        $steamApi->api_key = $request->api_key;
        $steamApi->save();
        Cache::forget('steamApi');
        alert()
            ->success('Success!', 'Your Steam API key has been successfully changed!')
            ->showCloseButton('aria-label')
            ->showConfirmButton('Ok, got it', '#3085d6')
            ->autoClose(10000);

        return back();
    }
}

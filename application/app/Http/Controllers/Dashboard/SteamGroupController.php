<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\SteamGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SteamGroupController extends Controller{
    public function index(){
        $steam = SteamGroup::first();

        try{
            $steamRawInfo = file_get_contents( $steam->group_url . '/memberslistxml?xml=1');

            $steamLoadedInfo = simplexml_load_string($steamRawInfo);
        } catch (\Exception $e){
            $steamLoadedInfo = null;
        }


        return view('steam.group.index', compact('steam', 'steamLoadedInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SteamGroup $steamGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(SteamGroup $steamGroup){
        return view('steam.group.edit', compact('steamGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \App\Models\SteamGroup $steamGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SteamGroup $steamGroup){
        if($request->group_url === $steamGroup->group_url){
            alert()
                ->warning('Wait!', "You've already set this group url! Try using a different one.")
                ->showCloseButton('aria-label')
                ->showConfirmButton('Ok, got it','#3085d6')
                ->autoClose(10000);
            return back()->withInput();

        } else {
            try {
                $steamRawInfo =  file_get_contents($request->group_url . "/memberslistxml?xml=1");
                simplexml_load_string($steamRawInfo);
            } catch (\Exception $e) {
                alert()
                    ->error('Oops!', 'Seems like we can\'t find your steam group ..')
                    ->footer('Are you sure you entered your url correctly?')
                    ->showCloseButton('aria-label')
                    ->showConfirmButton('Ok, got it', '#3085d6')
                    ->autoClose(10000);
                return back()->withInput();
            }
        }

        $steamGroup->group_url = $request->group_url;
        $steamGroup->save();
        Cache::forget('steamGroup');
        alert()->success('Steam Group Url Set Successfully!', 'Your changes will show soon!')
            ->showCloseButton('aria-label')
            ->showConfirmButton('Ok, got it','#3085d6')
            ->autoClose(10000);

        return back();
    }
}

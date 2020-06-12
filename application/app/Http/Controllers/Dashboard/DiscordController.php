<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Discord;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscordController extends Controller{
    public function index(){
        $discordId = Discord::first();

        $discord = Cache::remember('discord', 10, function() {
            $discordId = Discord::first();
            return (new Discord)->discord($discordId);
        });

        // quick data to use from widget.json
        $invite = $discord->instant_invite;
        $name = $discord->name;
        $onlineMembers = count($discord->members);
        
        
        return view('discord.index', compact('discord', 'discordId', 'invite', 'name', 'onlineMembers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Discord $discord
     * @return \Illuminate\Http\Response
     */
    public function edit(Discord $discord){
        return view('discord.edit', compact('discord'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \App\Models\Discord $discord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discord $discord){
        if($request->server_id === $discord->server_id){
            alert()
                ->warning('Wait!', 'You\'ve already set this server id! Try using a different one.')
                ->showCloseButton('aria-label')
                ->showConfirmButton('Ok, got it','#3085d6')
                ->autoClose(10000);
            return back()->withInput();
        } else

            try {
                $testDiscordUrl = "https://discordapp.com/api/v6/servers/" . $request->server_id . "/widget.json";
                $getTestDiscordContent = file_get_contents($testDiscordUrl);
                json_decode($getTestDiscordContent);
                $invcheck =  json_decode($getTestDiscordContent);

            } catch (\Exception $e) {
                alert()
                    ->error('Oops!','Seems like either: your discord widget isn\'t enabled, hasn\'t enabled on discord\'s side, or isn\'t a server ID at all.')
                    ->footer('Try again in a few moments.')
                    ->showCloseButton('aria-label')
                    ->showConfirmButton('Ok, got it','#3085d6')
                    ->autoClose(10000);
                return back()->withInput();
            }


        if (is_null($invcheck->instant_invite)) {
            alert()->error('Oops!','Seems like you forgot to set an instant invite channel for your widget.')
                ->footer('Try again in a few moments.')
                ->showCloseButton('aria-label')
                ->showConfirmButton('Ok, got it','#3085d6')
                ->autoClose(10000);
            return back()->withInput();
        }else {
            $discord->server_id = $request->server_id;
            $discord->save();
            Cache::forget('discord');

            alert()->success('Server Set Successfully!', 'Your changes will show soon!')
                ->showCloseButton('aria-label')
                ->showConfirmButton('Ok, got it', '#3085d6')
                ->autoClose(10000);
            return back();
        }
        }
    }

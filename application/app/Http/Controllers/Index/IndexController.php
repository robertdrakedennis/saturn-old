<?php

namespace App\Http\Controllers\Index;

use App\Models\CurrentTheme;
use App\Models\Discord;
use App\Models\Feature;
use App\Models\Link;
use App\Models\Server;
use App\Models\Settings;
use App\Models\SteamGroup;
use App\Models\Team;
use App\User;
use Igaster\LaravelTheme\Facades\Theme;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use xPaw\SourceQuery\SourceQuery;

class IndexController extends Controller{

    public function index(){

            $currentTheme = Cache::rememberForever('currentTheme', function() {
                return CurrentTheme::first();
            });

            Theme::set($currentTheme->currentTheme->name);


        // grab all features to run through
        $settings = Cache::rememberForever('settings', function() {
            return Settings::all();
        });

        $setting = [];
        foreach($settings as $key) {
            $setting[$key->title] = [
                'value' => $key->value,
                'enabled' => $key->enabled
            ];
        }

        $users = Cache::rememberForever('users', function() {
            return User::all();
        });

        $teams = Cache::rememberForever('teams', function() {
            return Team::all();
        });

        $discord = Cache::remember('discord', 10, function() {
            $discordId = Discord::first();
            return (new Discord)->discord($discordId);
        });

        $steam = Cache::remember('steam', 10, function() {
            return  SteamGroup::first();
        });


        //look at model for quick reference to what you can pull
        $cachedSteamLoadedInfo = Cache::remember('steamLoadedInfo', 10, function() {
            $steam = SteamGroup::first();
            return  (new SteamGroup)->steamGroup($steam);
        });

        // have to do this bc cache doesn't allow xml for w/e reason
        $steamLoadedInfo = simplexml_load_string($cachedSteamLoadedInfo);

        // grab all features to run through
        $features = Cache::rememberForever('features', function() {
            return Feature::all();
        });

        $servers = Cache::remember('servers', 10, function (){
            $servers = [];
            $query = new SourceQuery();
            $gameServers = Server::all();
            foreach ($gameServers as $gameServer){
                try{
                    $query->Connect($gameServer->ip, $gameServer->port, 3, SourceQuery::SOURCE);
                    $servers[] = [
                        'server' => $query->GetInfo(),
                        'info' => $gameServer
                    ];
                } catch (\Exception $e){
                    $servers[] = [
                        'server' =>  null,
                        'info' =>  null
                    ];
                }
                finally {
                    $query->disconnect();
                }
            }
            return $servers;
        });

        $links = Cache::rememberForever('links', function() {
            return Link::all();
        });

        return view('index', compact('setting', 'discord', 'steamLoadedInfo', 'users', 'teams', 'features', 'servers', 'steam', 'links'));
    }
}

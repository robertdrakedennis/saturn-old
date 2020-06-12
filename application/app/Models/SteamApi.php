<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SteamApi extends Model{
    protected $table = 'steam_api';

    protected $fillable = [
        'api_key'
    ];

    private static $sapi_gps_url = 'https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=%s&steamids=%s';

    public $timestamps = false;

    public function steamApi($steam, $attribute = null){
        try{
            $url = sprintf(static::$sapi_gps_url, $steam->api_key, $attribute->steamid ?? $attribute);
            $decodeSteam = json_decode(file_get_contents($url), false);
            return $decodeSteam->response->players[0];
        } catch (\Exception $e){
            return $decodeSteam = null;
        }
    }
}

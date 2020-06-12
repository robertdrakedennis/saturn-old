<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discord extends Model{
    protected $table = 'discord';

    protected $fillable = [
        'server_id'
    ];

    public $timestamps = false;

    public function discord($discordId){
        $discordUrl = "https://discordapp.com/api/servers/" . $discordId->server_id . "/widget.json";
		
		function get_http_response_code($url) {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
		}
		if(get_http_response_code($discordUrl) != "200"){
        $getDiscordContent = file_get_contents('https://discordapp.com/api/servers/474522322901008386/widget.json');
			}else{
        $getDiscordContent = file_get_contents($discordUrl);
				}

        // what you can pull from this function
        //        $discord->instant_invite;
        //       $discord->name;
        //       count($discord->members);
             return json_decode($getDiscordContent);
    }
}

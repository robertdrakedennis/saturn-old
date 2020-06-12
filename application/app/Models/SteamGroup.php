<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SteamGroup extends Model{
    protected $table = 'steam_group';

    public $timestamps = false;

    public function steamGroup($steam){

        $steamRawInfo = file_get_contents( $steam->group_url . '/memberslistxml?xml=1');
		if(!is_object($steamRawInfo)){
            \Artisan::call('cache:clear');
			$steamRawInfo = file_get_contents( 'https://steamcommunity.com/groups/facepunch/memberslistxml?xml=1');
		}
        // what you can pull from this function
//         (string) $steamLoadedInfo->groupDetails->groupName;
//         $steamLoadedInfo->groupDetails->memberCount;
//         $steamLoadedInfo->groupDetails->membersOnline;
//         $steamLoadedInfo->groupDetails->membersInChat;
//         (string) $steamLoadedInfo->groupDetails->avatarFull;
//         (string) $steamLoadedInfo->groupDetails->summary;
           return $steamRawInfo;
    }
}

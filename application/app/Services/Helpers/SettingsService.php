<?php
/**
 * Created by PhpStorm.
 * User: atlas
 * Date: 10/7/2018
 * Time: 11:49 PM
 */

namespace App\Services\Helpers;

use App\Models\Settings;
use Illuminate\Support\Facades\Cache;

class SettingsService{
    public function settings(){

        $settings = Cache::rememberForever('settings', function (){
            return Settings::all();
        });

        $setting = [];
        foreach($settings as $key) {
            $setting[$key->title] = [
                'value' => $key->value,
                'enabled' => $key->enabled
            ];
        }

        return $setting;
    }
}


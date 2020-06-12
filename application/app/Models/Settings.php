<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Settings extends Model{
    protected $fillable = [
        'title',
        'enabled',
        'value'
    ];

    //protected $primaryKey = 'title';

    public function getRouteKeyName(){
        return 'title';
    }

    public $timestamps = false;

    protected $casts = [
        'enabled'
    ];

    public function settings(){
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

        return $setting;
    }
}

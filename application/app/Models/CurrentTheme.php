<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrentTheme extends Model{
    protected $table = 'active_theme';

    public $timestamps = false;

    public function currentTheme(){
        return $this->belongsTo(Themes::class);
    }
}

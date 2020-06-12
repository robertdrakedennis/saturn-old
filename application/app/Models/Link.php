<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model{
    public $timestamps = false;


    protected $fillable = [
        'title',
        'url',
        'fa_icon',
        'new_tab',
    ];
}

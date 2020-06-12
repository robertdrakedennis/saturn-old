<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{

    protected $table = 'feature';

    protected $fillable = [
        'title',
        'description',
        'img_url',
        'fa_icon',
        'fa_color',
        'display'
    ];

    public $timestamps = false;
}

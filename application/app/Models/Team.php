<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Team extends Model
{
    protected $table = 'team';

    protected $with = ['users'];

    protected $fillable = [
        'name',
        'description',
        'img_url',
        'fa_icon',
        'fa_color',
        'display'
    ];

    public $timestamps = false;

    public function users(){
        return $this->hasMany(User::class);
    }
}

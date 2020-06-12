<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDefaultFeatures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('feature')->insert([
            'title' => 'Professional',
            'description' => 'We carefully pick out our staff to make sure people have the best role-play experience. Our application process includes background checks, training and regular meetings. We take the staff complaints very seriously as they can affect the role-play experience.',
            'img_url' => null,
            'fa_icon' => 'fas fa-suitcase',
            'fa_color' => '#000',
            'display' => 'fontawesome'
        ]);
        DB::table('feature')->insert([
            'title' => 'Why us',
            'description' => 'We are a community that wants to set a standard for what a good server is and are putting all our efforts into making this a reality.',
            'img_url' => null,
            'fa_icon' => 'fas fa-question',
            'fa_color' => '#000',
            'display' => 'fontawesome'
        ]);
        DB::table('feature')->insert([
            'title' => 'Reliable',
            'description' => 'Most of our content is bought from Gmodstore or custom made with the rest being from the workshop. Every one of our addons are checked thoroughly before being considered for the servers player base which leaves no room for hacks like other amateur communities.',
            'img_url' => null,
            'fa_icon' => 'fas fa-lock',
            'fa_color' => '#000',
            'display' => 'fontawesome'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

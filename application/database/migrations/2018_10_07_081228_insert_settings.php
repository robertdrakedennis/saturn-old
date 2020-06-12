<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        DB::table('settings')->insert([
            'pretty_title' => 'Site Name',
            'title' => 'site_name',
            'enabled' => null,
            'value' => env('APP_NAME', 'Saturn'),
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Site Url',
            'title' => 'site_url',
            'enabled' => null,
            'value' => env('APP_URL', 'http://localhost'),
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Site Logo',
            'title' => 'site_logo',
            'enabled' => 1,
            'value' => 'https://xenin.co/assets/media/logo/light.svg',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Site About',
            'title' => 'site_about',
            'enabled' => 1,
            'value' => 'Gmod, but it\'s not shit.',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Links',
            'title' => 'links',
            'enabled' => 1,
            'value' => null
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Background Image',
            'title' => 'background_image',
            'enabled' => 1,
            'value' => 'https://i.imgur.com/8bkDMpJ.jpg',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Features',
            'title' => 'features',
            'enabled' => 1,
            'value' => null,
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Features - Title',
            'title' => 'features_title',
            'enabled' => 1,
            'value' => 'Features',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Features - About',
            'title' => 'features_about',
            'enabled' => 1,
            'value' => 'Some key features that make us stand out from the rest!',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Teams',
            'title' => 'teams',
            'enabled' => 1,
            'value' => null,
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Teams - Title',
            'title' => 'teams_title',
            'enabled' => 1,
            'value' => 'Meet the staff!',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Teams - About',
            'title' => 'teams_about',
            'enabled' => 1,
            'value' => 'Our team of talented staff members are shown below!',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Servers',
            'title' => 'servers',
            'enabled' => 1,
            'value' => null,
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Servers - Title',
            'title' => 'servers_title',
            'enabled' => 1,
            'value' => 'Servers',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Servers - About',
            'title' => 'servers_about',
            'enabled' => 1,
            'value' => 'Our awesome lineup of servers!',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Discord',
            'title' => 'discord',
            'enabled' => 1,
            'value' => null,
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Discord - Title',
            'title' => 'discord_title',
            'enabled' => 1,
            'value' => 'Discord',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Discord - About',
            'title' => 'discord_about',
            'enabled' => 1,
            'value' => 'Join our discord for the latest info!',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Steam Group',
            'title' => 'steam_group',
            'enabled' => 1,
            'value' => null,
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Steam Group - Title',
            'title' => 'steam_group_title',
            'enabled' => 1,
            'value' => 'Steam',
        ]);


        DB::table('settings')->insert([
            'pretty_title' => 'Steam Group - About',
            'title' => 'steam_group_about',
            'enabled' => 1,
            'value' => 'Our steamgroup with our ever growing list of members',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Meta - Site Name',
            'title' => 'meta_site_name',
            'enabled' => 1,
            'value' => 'Saturn',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Meta - Title',
            'title' => 'meta_title',
            'enabled' => 1,
            'value' => 'Saturn',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Meta - Logo',
            'title' => 'meta_logo',
            'enabled' => 1,
            'value' => env('APP_URL') . '/img/default/icon.png',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Meta - Description',
            'title' => 'meta_description',
            'enabled' => 1,
            'value' => 'Saturn',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Meta - Image',
            'title' => 'meta_image',
            'enabled' => 1,
            'value' => 'https://google.com',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Twitter - Card',
            'title' => 'twitter_card',
            'enabled' => 0,
            'value' => null,
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Twitter - Site',
            'title' => 'twitter_site',
            'enabled' => 1,
            'value' => '@username',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Twitter - Title',
            'title' => 'twitter_title',
            'enabled' => 1,
            'value' => 'Saturn',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Twitter - Description',
            'title' => 'twitter_description',
            'enabled' => 1,
            'value' => 'Saturn is a fully configurable index.',
        ]);

        DB::table('settings')->insert([
            'pretty_title' => 'Twitter - Image',
            'title' => 'twitter_image',
            'enabled' => 1,
            'value' => 'https://i.imgur.com/8bkDMpJ.jpg',
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

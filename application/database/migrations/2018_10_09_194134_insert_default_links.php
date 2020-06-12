<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDefaultLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('links')->insert([
            'title' => 'Forums',
            'url' => 'https://xenin.co/forums',
            'fa_icon' => 'fas fa-book',
            'new_tab' => 1
        ]);
        DB::table('links')->insert([
            'title' => 'Store',
            'url' => 'https://xenin.co/store',
            'fa_icon' => 'fas fa-shopping-cart',
            'new_tab' => 1
        ]);
        DB::table('links')->insert([
            'title' => 'News',
            'url' => 'https://xenin.co/news',
            'fa_icon' => 'fas fa-newspaper',
            'new_tab' => 1
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

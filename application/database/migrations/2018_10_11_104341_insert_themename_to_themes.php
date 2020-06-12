<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertThemenameToThemes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('theme')->insert([
            'name' => 'spooky',
            'image' => 'https://cdn.wrld.digital/saturn/themes/spooky.png'
        ]);
        

        DB::table('theme')->insert([
            'name' => 'military',
            'image' => 'https://cdn.wrld.digital/saturn/themes/military.png'
        ]);

        DB::table('theme')->insert([
            'name' => 'mars',
            'image' => 'https://cdn.wrld.digital/saturn/themes/mars.png'
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

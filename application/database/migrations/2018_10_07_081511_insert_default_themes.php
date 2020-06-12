<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDefaultThemes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        DB::table('theme')->insert([
            'name' => 'default',
            'image' => 'https://cdn.wrld.digital/saturn/themes/default.png'
        ]);

        DB::table('theme')->insert([
            'name' => 'lunar_index', // lunar index
            'image' => 'https://cdn.wrld.digital/saturn/themes/lunar_index.png'
        ]);

        DB::table('theme')->insert([
            'name' => 'orion', // lunar index
            'image' => 'https://cdn.wrld.digital/saturn/themes/orion.png'
        ]);

        DB::table('theme')->insert([
            'name' => 'babywitch', // lunar index
            'image' => 'https://cdn.wrld.digital/saturn/themes/babywitch.png'
        ]);

        DB::table('theme')->insert([
            'name' => 'witch', // lunar index
            'image' => 'https://cdn.wrld.digital/saturn/themes/witch.png'
        ]);

        DB::table('theme')->insert([
            'name' => 'onyx',
            'image' => 'https://cdn.wrld.digital/saturn/themes/onyx.png'
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

<?php

use Igaster\LaravelTheme\Facades\Theme;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFlux extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('theme')->where('name', 'flux')->delete();

        DB::table('active_theme')->where('id', '=', 1)->delete();

        DB::table('active_theme')->insert([
            'id' => 1,
            'current_theme_id' => 1
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

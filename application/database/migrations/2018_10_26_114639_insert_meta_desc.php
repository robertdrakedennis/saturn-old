<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertMetaDesc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        DB::table('settings')
            ->where('title', 'meta_description')
            ->update(['value' => 'Gmod, but it\'s not shit.']);
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

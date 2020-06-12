<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveTheme extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_theme', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('current_theme_id')->nullable();
        });

        Schema::table('active_theme', function (Blueprint $table) {
            $table->foreign('current_theme_id')->references('id')->on('theme')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('active_theme');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('img_url')->nullable();
            $table->string('fa_icon')->nullable();
            $table->string('fa_color')->default('#333639');
            $table->enum('display', ['fontawesome', 'image']);
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature');
    }
}

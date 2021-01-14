<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchemesImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheme_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('scheme_id')->unsigned();
            $table->string('title', 255)->default('');
            $table->string('scheme_img')->default('');
            $table->timestamps();
            $table->index('scheme_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scheme_images');
    }
}

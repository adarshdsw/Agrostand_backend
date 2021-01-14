<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crop_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('crop_id')->unsigned();
            $table->string('image_name', 255)->default('');
            $table->string('crop_image')->default('');
            $table->timestamps();
            $table->index('crop_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crop_images');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgronomistLeadImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agronomist_lead_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('agronimist_lead_id');
            $table->string('img_path');
            $table->string('img_value');
            $table->enum('media_type', ['1', '2'])->comment('1 = image | 2 = video');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agronomist_lead_images');
    }
}

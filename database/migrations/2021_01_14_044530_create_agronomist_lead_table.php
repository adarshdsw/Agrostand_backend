<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgronomistLeadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agronomist_lead', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->integer('commodity_id');
            $table->text('plant_variety');
            $table->text('desc');
            $table->date('date_of_plantation');
            $table->text('report');
            $table->string('upload_report')->default('');
            $table->text('specification');
            $table->index('category_id');
            $table->index('commodity_id');
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
        Schema::dropIfExists('agronomist_lead');
    }
}

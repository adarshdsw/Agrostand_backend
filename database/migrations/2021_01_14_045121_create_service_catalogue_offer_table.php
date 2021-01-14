<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCatalogueOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_offer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->unsigned();
            $table->string('offer_name', 255)->default('');
            $table->integer('discount')->comment('discount in percent')->unsigned();
            $table->float('amount', 8, 2);
            $table->datetime('start_offer');
            $table->datetime('end_offer');
            $table->text('offer_specification');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
            $table->index('service_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_offer');
    }
}

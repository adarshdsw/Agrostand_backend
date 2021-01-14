<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sell_lead_id');
            $table->integer('vendor_id');
            $table->integer('seller_id');
            $table->enum('seller_type', ['1', '2'])->comment('1 = former | 2 = business');
            $table->enum('request_status', ['1', '2'])->comment('1 = Accept | 2 = Decline');
            $table->index('sell_lead_id');
            $table->index('vendor_id');
            $table->index('seller_id');
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
        Schema::dropIfExists('sell_request');
    }
}

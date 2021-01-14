<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyleadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buylead', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('commodity_id');
            $table->string('product_title')->default('');
            $table->integer('qty');
            $table->text('buy_specification');
            $table->tinyInteger('size');
            $table->float('min_price');
            $table->float('max_price');
            $table->text('product_specification');
            $table->string('location');
            $table->text('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->timestamps();
            $table->index('category_id');
            $table->index('commodity_id');
            $table->index('product_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buylead');
    }
}

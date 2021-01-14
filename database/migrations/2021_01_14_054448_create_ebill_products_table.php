<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbillProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebill_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ebill_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('commodity_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('varity', 255)->default('');
            $table->integer('packet_number')->unsigned();
            $table->integer('total_volume')->unsigned();
            $table->float('rate', 8, 2);
            $table->string('rate_unit', 255)->default('');
            $table->float('product_tax', 8, 2);
            $table->string('product_img')->default('');
            $table->text('specification');
            $table->float('total_amount', 8, 2);
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
            $table->index('ebill_id');
            $table->index('category_id');
            $table->index('commodity_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ebill_products');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellleadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_lead', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('commodity_id');
            $table->integer('crop_catelog_id');
            $table->date('selling_date');
            $table->text('sell_specification');
            $table->text('product_specification');
            $table->timestamps();
            $table->softDeletes('deleted_at',0);
            $table->index('user_id');
            $table->index('category_id');
            $table->index('commodity_id');
            $table->index('crop_catelog_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sell_lead');
    }
}

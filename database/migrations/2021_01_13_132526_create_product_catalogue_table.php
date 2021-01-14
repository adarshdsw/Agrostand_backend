<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCatalogueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_catalogues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('commodity_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->string('title', 255)->default('');
            $table->text('description');
            $table->string('product_url', 255)->default('');
            $table->string('website_url', 255)->default('');
            $table->string('feature_img')->default('');
            $table->string('document')->default('');
            $table->string('package_size')->default('');
            $table->string('unit', 255)->default('');
            $table->text('product_use');
            $table->text('specification');
            $table->enum('status', ['0', '1'])->comment('0 = inactive | 1 = active')->default(1);
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
            $table->index('user_id');
            $table->index('category_id');
            $table->index('commodity_id');
            $table->index('brand_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_catalogues');
    }
}

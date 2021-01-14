<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCatalogueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_catalogues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('commodity_id')->unsigned();
            $table->string('service_name', 255)->default('');
            $table->text('description');
            $table->text('specification');
            $table->float('fees', 8, 2);
            $table->string('unit', 255)->default('');
            $table->enum('status', ['0', '1'])->comment('0 = inactive | 1 = active')->default(1);
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
            $table->index('user_id');
            $table->index('category_id');
            $table->index('commodity_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_catalogues');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbillShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebill_shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ebill_id')->unsigned();
            $table->enum('shipping_type', ['1', '2', '3'])->comment('1 = local | 2 = company | 3 = courier');
            $table->string('transport_name', 255)->default('');
            $table->string('bill_number', 255)->default('');
            $table->string('courier_name', 255)->default('');
            $table->string('tracking_number', 255)->default('');
            $table->string('courier_receipt_img')->default('');
            $table->string('lt_driver_name', 255)->default('');
            $table->string('lt_driver_mobile', 255)->default('');
            $table->string('lt_vehcile_number', 255)->default('');
            $table->string('lt_owner_name', 255)->default('');
            $table->string('lt_driver_img')->default('');
            $table->string('lt_loading_vehcile_img')->default('');
            $table->string('lt_driver_identity', 255)->default('');
            $table->string('lt_driver_identity_img', 255)->default('');
            $table->string('lt_driver_otp', 255)->default('');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
            $table->index('ebill_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ebill_shippings');
    }
}

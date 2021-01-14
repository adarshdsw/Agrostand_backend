<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('commodity_id')->unsigned();
            $table->integer('sender_id')->comment('who generate ebill')->unsigned();
            $table->integer('receiver_id')->comment('who receive RFP')->unsigned();
            $table->string('order_id', 255)->default('');
            $table->text('specification');
            $table->text('ship_to');
            $table->text('bill_to');
            $table->bigInteger('bill_number');
            $table->date('bill_date');
            $table->date('due_date');
            $table->float('shipping_charge', 8, 2)->unsigned();
            $table->float('total_amount', 8, 2)->unsigned();
            $table->enum('status', ['0', '1'])->comment('0 = inactive | 1 = active')->default(1);
            $table->enum('rfp_status', ['0', '1'])->comment('0 = decline | 1 = accept')->default(1);
            $table->string('reason', 255)->default('');
            $table->enum('seller_type', ['1', '2'])->comment('1 = former | 2 = bussiness');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
            $table->index('category_id');
            $table->index('commodity_id');
            $table->index('sender_id');
            $table->index('receiver_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ebills');
    }
}

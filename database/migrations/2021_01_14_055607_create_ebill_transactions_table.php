<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbillTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebill_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ebill_id')->unsigned();
            $table->integer('sender_id')->unsigned();
            $table->integer('receiver_id')->unsigned();
            $table->float('transaction_amount', 8, 2);
            $table->enum('status', ['0', '1', '2'])->comment('0 = fail | 1 = pending| 2 = success')->default(1);
            $table->timestamps();
            $table->index('ebill_id');
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
        Schema::dropIfExists('ebill_transactions');
    }
}

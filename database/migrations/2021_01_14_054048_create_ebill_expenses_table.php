<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbillExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebill_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ebill_id')->unsigned();
            $table->float('adv_amount', 8, 2);
            $table->float('bank_charges', 8, 2);
            $table->float('mandi_tax', 8, 2);
            $table->float('other_expenses', 8, 2);
            $table->timestamps();
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
        Schema::dropIfExists('ebill_expenses');
    }
}

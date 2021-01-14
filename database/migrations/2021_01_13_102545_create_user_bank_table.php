<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bank', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('bank_name')->default('');
            $table->text('bank_address');
            $table->string('account_number')->default('');
            $table->string('account_owner')->default('');
            $table->string('passbook_img')->default('');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('user_back');
    }
}

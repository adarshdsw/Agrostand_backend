<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserKycTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_kyc', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->enum('kyc_type', ['0', '1', '2'])->comment('aadhar_card =>0, voter_id =>1, pan_card=>2')->default('0');
            $table->string('card_number')->default('');
            $table->string('card_img')->default('');
            $table->string('land_proof_img')->default('');
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
        Schema::dropIfExists('user_kyc');
    }
}

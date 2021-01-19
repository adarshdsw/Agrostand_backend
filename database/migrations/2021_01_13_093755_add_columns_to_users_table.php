<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile', 255)->nullable()->after('password');
            $table->smallInteger('otp')->default(0)->after('mobile');
            $table->smallInteger('role_id')->after('otp');
            $table->smallInteger('assured_id')->after('role_id');
            $table->smallInteger('language_id')->after('assured_id');
            $table->text('address')->after('language_id');
            $table->text('land_area')->after('address');
            $table->string('pincode')->default('')->after('land_area');
            $table->smallInteger('country_id')->after('pincode');
            $table->smallInteger('state_id')->after('country_id');
            $table->string('city')->default('')->after('state_id');
            $table->string('latitude')->after('city');
            $table->string('longitude')->after('latitude');
            $table->index('mobile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}

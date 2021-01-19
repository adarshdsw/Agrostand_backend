<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
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
            /*if (Schema::hasColumn('name', 'email', 'password', 'otp', 'role_id', 'assured_id', 'language_id', 'country_id', 'state_id', 'latitude', 'longitude')) {
            }*/
                $table->string('name', 255)->default('')->change();
                $table->string('email', 255)->default('')->change();
                $table->string('password', 255)->default('')->change();
                $table->integer('otp')->unsigned()->change();
                $table->integer('role_id')->default(0)->change();
                $table->integer('assured_id')->default(0)->change();
                $table->integer('language_id')->default(0)->change();
                $table->integer('country_id')->default(0)->change();
                $table->integer('state_id')->default(0)->change();
                $table->string('address', 255)->default('')->change();
                $table->string('land_area', 255)->default('')->change();
                $table->string('latitude', 255)->default('')->change();
                $table->string('longitude', 255)->default('')->change();
        });
    }
}

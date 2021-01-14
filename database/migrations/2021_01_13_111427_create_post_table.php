<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('posted by')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('title', 255)->default();
            $table->text('description');
            $table->string('feature_img')->default('');
            $table->integer('views')->unsigned();
            $table->enum('status', ['0', '1'])->comment('0 = inactive | 1 = active')->default(1);
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
            $table->index('user_id');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

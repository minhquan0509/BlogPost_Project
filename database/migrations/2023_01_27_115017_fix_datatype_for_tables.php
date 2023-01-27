<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\Type;

class FixDatatypeForTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->change();
            $table->unsignedBigInteger('category_id')->change();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')->change();
            $table->unsignedBigInteger('user_id')->change();
        });

        Schema::table('like_post', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')->change();
            $table->unsignedBigInteger('user_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('created_by')->change();
            $table->integer('category_id')->change();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->integer('post_id')->change();
            $table->integer('user_id')->change();
        });

        Schema::table('like_post', function (Blueprint $table) {
            $table->integer('post_id')->change();
            $table->integer('user_id')->change();
        });
    }
}

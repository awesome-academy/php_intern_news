<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles_categories', function (Blueprint $table) {
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles_categories', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
            $table->dropForeign(['category_id']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['approved_by']);
        });
    }
}

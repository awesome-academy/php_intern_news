<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('cover_image')->nullable()->default('default_cover');
            $table->string('title');
            $table->string('slug')->unique();
            $table->mediumText('content')->nullable();
            $table->unsignedBigInteger('author_id');
            $table->enum('published', [1, 2, 3, 4])->nullable()->default(1)->comment('1: non-publish, 2: pending, 3: approved, 4: rejected');
            $table->timestamp('published_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}

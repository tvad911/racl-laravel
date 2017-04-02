<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_lang', function (Blueprint $table) {
            $table->integer('post_id');
            // $table->foreign('post_id')->references('id')->on('post');
            $table->integer('lang_id');
            // $table->foreign('lang_id')->references('id')->on('lang');
            $table->primary(['post_id', 'lang_id']);
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->string('description', 255)->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->text('content')->nullable();
            $table->integer('thumbnail')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('post_lang');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_lang', function (Blueprint $table) {
            $table->integer('category_id');
            $table->foreign('category_id')->references('id')->on('category');
            $table->integer('lang_id');
            $table->foreign('lang_id')->references('id')->on('lang');
            $table->primary(['category_id', 'lang_id']);
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->string('description', 255)->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
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
        Schema::dropIfExists('category_lang');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable()->default(null)->index();
            $table->foreign('parent_id')->references('id')->on('category');
            $table->integer('lft')->unsigned()->nullable()->index();
            $table->integer('rgt')->unsigned()->nullable()->index();
            $table->integer('depth')->unsigned()->nullable();
            $table->smallInteger('type')->default(0);
            $table->integer('position')->unsigned()->nullable()->default(0);
            $table->tinyInteger('is_root_category')->default('0');
            $table->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('category');
    }
}

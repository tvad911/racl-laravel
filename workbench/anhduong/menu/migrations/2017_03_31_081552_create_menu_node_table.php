<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuNodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_nodes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('menu_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('related_id')->unsigned()->nullable();
            $table->string('type', 255);
            $table->string('url', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('icon_font', 255)->nullable();
            $table->string('css_class', 255)->nullable();
            $table->string('target', 255)->nullable();
            $table->integer('sort_order')->unsigned()->default(0);
            $table->timestamps();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('menu_nodes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_nodes');
    }
}

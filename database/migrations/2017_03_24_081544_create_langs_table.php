<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->string('iso_code', 2);
            $table->string('language_code', 5);
            $table->string('locale', 5);
            $table->string('date_format_lite', 32);
            $table->string('date_format_full', 32);
            $table->tinyInteger('is_rtl');
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
        Schema::dropIfExists('lang');
    }
}

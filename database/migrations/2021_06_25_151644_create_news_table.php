<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_table', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('tid');
            $table->string('title')->nullable();
            $table->string('imageurl')->nullable();
            $table->string('newsurl')->nullable();
            $table->text('description')->nullable();
            $table->date('rdate')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_table');
    }
}

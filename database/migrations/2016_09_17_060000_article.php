<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Article extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->text('title');
            $table->string('keyword')->nullable();
            $table->mediumText('content');
            $table->mediumText('description')->nullable();
            $table->mediumText('strong')->nullable();
            $table->mediumText('remain')->nullable();
            $table->mediumText('action_plan')->nullable();
            $table->boolean('rate')->nullable();
            $table->integer('id_parent')->nullable()->unsigned();
            $table->foreign('id_parent')->references('id')->on('article');
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
        Schema::drop('article');
    }
}

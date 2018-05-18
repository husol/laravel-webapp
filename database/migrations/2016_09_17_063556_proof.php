<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Proof extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proof', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->text('name');
            $table->string('issue');
            $table->text('source')->nullable();
            $table->text('file');
            $table->string('id_article');
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
        Schema::drop('proof');
    }
}

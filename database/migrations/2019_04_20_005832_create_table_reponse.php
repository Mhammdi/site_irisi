<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReponse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reponses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reponse');
            $table->unsignedBigInteger('sujet_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('sujet_id')->references('id')->on('sujets');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('reponses');
        $table->dropForeign(['sujet_id']);
        $table->dropForeign(['user_id']);
    }
}

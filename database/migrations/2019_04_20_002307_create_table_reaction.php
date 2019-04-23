<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sujet_id');
            $table->unsignedBigInteger('user_id');
            $table->Integer('react')->default(0);

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
        Schema::dropIfExists('reactions');
        $table->dropForeign(['sujet_id']);
        $table->dropForeign(['user_id']);
    }
}

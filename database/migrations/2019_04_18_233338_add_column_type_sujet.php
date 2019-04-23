<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTypeSujet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sujets', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('type_sujet_id');

            $table->foreign('type_sujet_id')->references('id')->on('type_sujets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sujets', function (Blueprint $table) {
            //
            $table->dropForeign(['type_sujet_id']);
            $table->dropColumn('type_sujet_id');
        });
    }
}

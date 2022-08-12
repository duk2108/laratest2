<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nickname')->nullable();
            $table->string('surname')->nullable();
            $table->binary('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->tinyInteger('sex')->default(0)->unsigned()->comment('0 - male, 1 - female');
            $table->tinyInteger('showphone')->default(0)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nickname');
            $table->dropColumn('surname');
            $table->dropColumn('avatar');
            $table->dropColumn('phone');
            $table->dropColumn('sex');
            $table->dropColumn('showphone');
        });
    }
};

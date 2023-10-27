<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToNsiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nsias', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id')->nullable()->after('direction_id');;
            $table->foreign('user_id')->references('id')->on('users')->ondelete('cascade');

            $table->dropForeign(['direction_id']);    
            $table->dropColumn('direction_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_id']);    
            $table->dropColumn('user_id'); 
        });
    }
}

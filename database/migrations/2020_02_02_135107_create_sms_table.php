<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('from');
            $table->foreign('from')->references('id')->on('users')->ondelete('cascade');

            $table->unsignedBigInteger('to');
            $table->foreign('to')->references('id')->on('users')->ondelete('cascade');

            $table->text('message');
            
            $table->boolean('sent')->default(true);
            $table->text('response');
            
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
        Schema::dropIfExists('sms');
    }
}

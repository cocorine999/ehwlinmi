<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('primes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('souscription_id');
            $table->foreign('souscription_id')->references('id')->on('souscriptions')->ondelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->ondelete('cascade');

            $table->integer('montant');

            $table->string('c_marchand');
            $table->string('c_first_marchand')->default(0);
            $table->string('c_smarchand');
            $table->string('c_first_smarchand')->default(0);
            $table->string('c_nsia');
            $table->string('c_mms');

            $table->date('date_prime')->default(date("Y-m-d"));

            $table->unsignedBigInteger('statut_commission')->nullable();
            
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
        Schema::dropIfExists('primes');
    }
}

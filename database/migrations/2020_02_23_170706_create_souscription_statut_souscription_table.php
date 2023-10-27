<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSouscriptionStatutSouscriptionTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('souscription_statut_souscription', function (Blueprint $table) {
      $table->bigIncrements('id');

      $table->unsignedBigInteger('souscription_id');
      $table->foreign('souscription_id')->references('id')->on('souscriptions')->ondelete('cascade');

      $table->unsignedBigInteger('statut_souscription_id');
      $table->foreign('statut_souscription_id')->references('id')->on('statut_souscriptions')->ondelete('cascade');

      $table->unsignedBigInteger('user_id');
      $table->foreign('user_id')->references('id')->on('users')->ondelete('cascade');

      $table->string('motif');

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
    Schema::dropIfExists('souscription_statut_souscription');
  }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SoucriptionForeignCorrection extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('souscription_statut_souscription', function (Blueprint $table) {
      //$table->unsignedInteger('created_by_user_fk_2267230')->nullable();
      $table->dropForeign('souscription_statut_souscription_souscription_id_foreign');

      $table->foreign('souscription_id')->references('id')->on('souscriptions')->ondelete('cascade');
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
  }
}

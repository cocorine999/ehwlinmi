<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSouscriptionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('souscriptions', function (Blueprint $table) {
      $table->bigIncrements('id');

      $table->unsignedBigInteger('contrat_id');
      $table->foreign('contrat_id')->references('id')->on('contrats')->ondelete('cascade');

      $table->unsignedBigInteger('user_id');
      $table->foreign('user_id')->references('id')->on('users')->ondelete('cascade');

      #$table->enum('statut', ['Attente de paiement', 'Attente de traitement', 'Valide', 'Rejeté', 'Sinistre', 'Terminé'])->default('Attente de paiement');

      $table->string('statut')->default('Attente de paiement');

      $table->date('date_effet')->default(date("Y-m-d"));

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
    Schema::dropIfExists('souscriptions');
  }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratBeneficiaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrat_beneficiaire', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('beneficiaire_id');
            $table->foreign('beneficiaire_id')->references('id')->on('beneficiaires')->ondelete('cascade');

            $table->unsignedBigInteger('contrat_id');
            $table->foreign('contrat_id')->references('id')->on('contrats')->ondelete('cascade');

            $table->boolean('active')->default(true);

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
        Schema::dropIfExists('contrat_beneficiaire');
    }
}

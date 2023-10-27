<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratMarchandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrat_marchand', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->unsignedBigInteger('marchand_id');
            $table->foreign('marchand_id')->references('id')->on('marchands')->ondelete('cascade');

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
        Schema::dropIfExists('contrat_marchand');
    }
}

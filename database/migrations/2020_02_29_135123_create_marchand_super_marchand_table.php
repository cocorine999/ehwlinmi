<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarchandSuperMarchandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marchand_super_marchand', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('marchand_id');
            $table->foreign('marchand_id')->references('id')->on('marchands')->ondelete('cascade');

            $table->unsignedBigInteger('super_marchand_id');
            $table->foreign('super_marchand_id')->references('id')->on('super_marchands')->ondelete('cascade');

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
        Schema::dropIfExists('marchand_super_marchand');
    }
}

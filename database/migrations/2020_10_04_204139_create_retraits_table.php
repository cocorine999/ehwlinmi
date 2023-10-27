<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetraitsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('retraits', function (Blueprint $table) {
      $table->bigIncrements('id');

      $table->integer('montant');
      $table->string('motif')->nullable();

      $table->unsignedBigInteger('created_by_user_id');
      $table->foreign('created_by_user_id')->references('id')->on('users')->ondelete('cascade');

      $table->unsignedBigInteger('handled_by_user_id')->nullable();
      $table->foreign('handled_by_user_id')->references('id')->on('users')->ondelete('cascade');

      $table->datetime('handle_at')->nullable();

      $table->string('status')->nullable();

      $table->string('observation')->nullable();

      $table->boolean('active')->default(true);

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
    Schema::dropIfExists('retraits');
  }
}

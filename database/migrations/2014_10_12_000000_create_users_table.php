<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('adresse');
            $table->string('telephone')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('sexe')->nullable();
            $table->string('ifu')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('situation_matrimoniale')->nullable();
            $table->string('last_sessid')->nullable();
            $table->string('profession')->nullable();
            $table->string('employeur')->nullable();
            $table->string('picture')->nullable();
            $table->boolean('actif')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_seen_at')->nullable();
            $table->dateTime('banned_until')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

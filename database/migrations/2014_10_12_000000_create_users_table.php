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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer("user_id");
            $table->string("genero")->nullable();
            $table->date("nascimento")->nullable();
            $table->string("estado")->nullable();
            $table->string("cidade")->nullable();
            $table->string("tags")->nullable();
            $table->string("insta")->nullable();
            $table->integer("follows")->nullable();
            $table->string("nome_marca")->nullable();
            $table->string("telefone_marca")->nullable();
            $table->string("logo_marca")->nullable();
            $table->rememberToken();
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

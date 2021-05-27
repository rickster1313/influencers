<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propostas', function (Blueprint $table) {
            $table->id();
            $table->string("titulo");
            $table->string("descricao");
            $table->string("trabalho");
            $table->string("premiacao");
            $table->string("tags")->nullable();
            $table->string("num_follows")->nullable();
            $table->string("estado")->nullable();
            $table->string("cidade")->nullable();
            $table->string("sexo")->nullable();;
            $table->string("idade")->nullable();;
            $table->integer("status");
            $table->integer("marca_id");
            $table->string("candidatos")->nullable();
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
        Schema::dropIfExists('propostas');
    }
}

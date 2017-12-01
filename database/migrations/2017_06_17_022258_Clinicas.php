<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class clinicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',30);
            $table->string('fantasia',50)->nullable();
            $table->string('razao_social',50)->nullable();
            $table->string('cnpj',20)->nullable();
            $table->string('cep',15)->nullable();
            $table->string('endereco',50)->nullable();
            $table->string('numero',5)->nullable();
            $table->string('bairro',20)->nullable();
            $table->string('cidade',20)->nullable();
            $table->string('estado',20)->nullable();
            $table->string('especialidade',200)->nullable();
            $table->tinyInteger('transporte')->nullable();
            $table->string('tratamento',200)->nullable();
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
        Schema::drop('clinicas');
    }
}

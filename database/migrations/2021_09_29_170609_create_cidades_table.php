<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidadesTable extends Migration
{
    public function up()
    {
        Schema::create('cidades', function (Blueprint $table) {
            $table->id();

            $table->integer('codigo_ibge');
            $table->string('cidade');
            $table->char('estado', 2);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cidades');
    }
}

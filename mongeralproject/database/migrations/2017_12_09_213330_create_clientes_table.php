<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cpf', 20);
            $table->string('senha', 150);
            $table->string('nome', 100);
            $table->string('telefone', 20);
            $table->string('email', 100);
            $table->date('datanascimento');
            $table->string('rg');
            $table->date('dataexpedicao');
            $table->string('orgao');
            $table->string('estadocivil');
            $table->string('categoria');
            $table->string('empresa');
            $table->string('profissao');
            $table->double('rendabruta', 10,2);
            
            $table->unique("cpf");
            $table->unique("email");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}

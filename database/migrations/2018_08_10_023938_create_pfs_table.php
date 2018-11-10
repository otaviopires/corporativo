<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pfs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
			$table->string('protocolo')->nullable();
			$table->string('circuito')->nullable();
			$table->string('status')->nullable();
			$table->string('entrada_fila')->nullable();
			$table->string('vencimento_anatel')->nullable();
			$table->string('data_abertura')->nullable();
			$table->string('produto')->nullable();
			$table->string('servico')->nullable();
			$table->string('regional')->nullable();
			$table->string('localidade')->nullable();
			$table->string('tecnico')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pfs');
    }
}

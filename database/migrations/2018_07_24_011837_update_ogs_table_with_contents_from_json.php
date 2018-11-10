<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOgsTableWithContentsFromJson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ogs', function($table){
			$table->string('protocolo')->nullable();
			$table->string('fila')->nullable();
			$table->string('status')->nullable();
			$table->string('data_abertura')->nullable();
			$table->string('servico')->nullable();
			$table->string('regional')->nullable();
			$table->string('localidade')->nullable();
			$table->string('descricao')->nullable();
			$table->string('interrompeu')->nullable();
			$table->string('qtd_clientes')->nullable();
			$table->mediumText('obs')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

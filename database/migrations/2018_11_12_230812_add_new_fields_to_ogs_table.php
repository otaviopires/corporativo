<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsToOgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ogs', function (Blueprint $table) {
			$table->string('circuito')->nullable();
			$table->string('entrada_fila')->nullable();
			$table->string('vencimento_anatel')->nullable();
			$table->string('tecnico')->nullable();
			$table->string('produto')->nullable();
			$table->string('desc_eqto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ogs', function (Blueprint $table) {
            //
        });
    }
}

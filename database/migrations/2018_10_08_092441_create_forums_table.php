<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('pergunta');
            $table->timestamps();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        });
		
		
		 Schema::create('forum_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('forum_id')->unsigned();
            $table->string('tag',10);
            $table->timestamps();

            $table->foreign('forum_id')
                    ->references('id')
                    ->on('forums')
                    ->onDelete('cascade');
            
        });
		
		
		
		Schema::create('forum_respostas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('forum_id')->unsigned();
            $table->longText('resposta');
            $table->timestamps();

            $table->foreign('forum_id')
                    ->references('id')
                    ->on('forums')
                    ->onDelete('cascade');
            
        });
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forums');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();            
            $table->string('apaterno',20);
            $table->string('amaterno',20);
            $table->string('nombre',50);
            $table->string('email',150);
            $table->string('telefono',20);
            $table->string('direccion',200);
            $table->string('ciudad',20);
            $table->string('estado',50);
            $table->string('status',15);            
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
        Schema::dropIfExists('clientes');
    }
}

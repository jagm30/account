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
            $table->string('nombre',150);
            $table->string('email',100);
            $table->string('telefono',30);
            $table->string('razonsocial',80);
            $table->string('rfc',30);
            $table->string('domicilio',50);
            $table->string('codigopostal',10);
            $table->string('emailfactura',,100);            
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

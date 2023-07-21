<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_contrato');
            $table->string('descripcion',200);
            $table->string('modalidad',50);
            $table->integer('id_cliente');
            $table->string('contrato_doc',100)->nullable();
            $table->string('status',30);
            $table->date('fecha_finaliza')->nullable();
            $table->date('fecha_recurrente')->nullable();
            $table->date('fechaf_recurrente')->nullable();
            $table->float('precio',8,2)->nullable();
            $table->integer('id_usuario')->nullable();
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
        Schema::dropIfExists('servicios');
    }
}

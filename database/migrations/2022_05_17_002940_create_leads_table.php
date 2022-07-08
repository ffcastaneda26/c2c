<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_name')->nullable()->comment('Campaña');
            $table->string('name')->nullable()->comment('nombre');
            $table->string('last_name')->nullable()->comment('Apellido');
            $table->string('email')->nullable()->comment('Correo Electrónico');
            $table->string('phone',20)->nullable()->comment('Teléfono');
            $table->string('financing')->nullable()->default(null)->comment('Financiamiento: In-House o Bank');
            $table->float('downpayment',8,2)->nullable()->default('0.00')->comment('Enganche');
            $table->float('income',8,2)->nullable()->default('0.00')->comment('Ingresos');
            $table->unsignedInteger('zipcode')->nullable()->comment('Zona postal');
            $table->boolean('sent_to_neo')->default(0)->comment('¿Ya fue enviado a Neo?');
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
        Schema::dropIfExists('leads');
    }
}

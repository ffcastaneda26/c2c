<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('dealer_id',15)->comment('Id distribuidor');
            $table->string('vin',253)->comment('VIN');
            $table->string('stock',20)->comment('Id Stock');
            $table->year('year')->comment('Axo');
            $table->string('make',20)->comment('Marca');
            $table->string('exterior_color',25)->nullable()->default(null)->comment('Color Exterior');
            $table->string('interior_color',25)->nullable()->default(null)->comment('Color Interior');
            $table->integer('mileage')->nullable()->default(0)->comment('millas');
            $table->string('transmission',40)->nullable()->default(null)->comment('Transmision');
            $table->string('engine',50)->nullable()->default(null)->comment('Motor');
            $table->integer('retail_price')->nullable()->default(0)->comment('Precio Oferta');
            $table->integer('sales_price')->nullable()->default(0)->comment('Precio Venta');
            $table->string('options',2)->nullable()->default(null)->comment('OPciones');
            $table->mediumText('images')->nullable()->default(null)->comment('URL para la imagen principal');
            $table->string('body',50)->nullable()->default(null)->comment('Body');
            $table->string('trim',50)->nullable()->default(null)->comment('Trim');
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
        Schema::dropIfExists('inventories');
    }
}

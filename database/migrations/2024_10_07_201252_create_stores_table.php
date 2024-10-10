<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('stores', function (Blueprint $table) {
        $table->id();
        $table->string('asset_identification_code');
        $table->string('asset_type');
        $table->text('asset_description');
        $table->string('location');
        $table->integer('number_of_units');
        $table->string('model_number');
        $table->year('year_of_manufacture');
        $table->string('serial_number')->nullable();
        $table->date('date_of_purchase');
        $table->decimal('initial_cost', 15, 2);
        $table->string('measure_improvement')->nullable();
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
        Schema::dropIfExists('stores');
    }
};

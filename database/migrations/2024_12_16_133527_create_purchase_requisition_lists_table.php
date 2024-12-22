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
        Schema::create('purchase_requisition_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_requisitions_id');
            $table->string('item_name');
            $table->text('description')->nullable();
            $table->integer('quantity_requested');
            $table->integer('quantity_available')->default(0);
            $table->boolean('acknowledged')->default(false);
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
        Schema::dropIfExists('purchase_requisition_lists');
    }
};

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
        Schema::create('item_requisition_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_requisition_request_id');
            $table->string('item_name');
            $table->text('description')->nullable();
            $table->integer('quantity_requested');
            $table->integer('quantity_available')->default(0);
            $table->enum('status', ['pending', 'available', 'not_available'])->default('pending');
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
        Schema::dropIfExists('item_requisition_lists');
    }
};

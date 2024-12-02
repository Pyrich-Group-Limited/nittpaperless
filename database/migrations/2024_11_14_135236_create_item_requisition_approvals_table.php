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
        Schema::create('item_requisition_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_requisition_request_id');
            $table->unsignedBigInteger('approved_by');
            $table->string('role');
            $table->text('comments')->nullable();
            $table->enum('status', ['approved', 'rejected']);
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
        Schema::dropIfExists('item_requisition_approvals');
    }
};

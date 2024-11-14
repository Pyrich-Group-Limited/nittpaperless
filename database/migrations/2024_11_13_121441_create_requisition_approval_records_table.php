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
        Schema::create('requisition_approval_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisition_id')->nullable();
            $table->foreign('requisition_id')->references('id')->on('staff_requisitions')->onDelete('cascade');
            $table->unsignedBigInteger('approver_id')->nullable();
            $table->foreign('approver_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('role')->nullable();
            $table->string('status')->default('pending');
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('requisition_approval_records');
    }
};

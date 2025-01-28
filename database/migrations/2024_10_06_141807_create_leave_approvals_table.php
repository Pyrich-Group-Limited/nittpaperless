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
        Schema::create('leave_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leave_id');
            // $table->foreign('leave_id')->references('id')->on('leaves')->onDelete('cascade');
            $table->unsignedBigInteger('approver_id');
            // $table->foreign('approver_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('approval_stage')->nullable(); // 'supervisor', 'unit_head', 'director'
            $table->string('type')->nullable(); // 'supervisor', 'unit_head', 'director'
            $table->string('status')->default('pending');  // 'pending', 'approved', 'rejected'
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
        Schema::dropIfExists('leave_approvals');
    }
};

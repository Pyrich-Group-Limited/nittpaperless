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
        Schema::create('purchase_requisitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('comment')->nullable();
            $table->string('status')->nullable();
            $table->datetime('last_date')->nullable();
            $table->enum('approval_status', ['hod_approved', 'bursar_approved','waiting_dg_approval','dg_approved',
            'pv_approved','audit_approved','cash_office_approved','pending','liaison_head_approval',
            'liaison_head_approved'])->default('pending');
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
        Schema::dropIfExists('purchase_requisitions');
    }
};

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
        Schema::create('staff_requisitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('requisition_type')->nullable();

            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');

            $table->string('location')->nullable();

            $table->unsignedBigInteger('account_id')->nullable();
            $table->foreign('account_id')->references('id')->on('chart_of_accounts')->onDelete('cascade');

            $table->string('purpose')->nullable();
            $table->text('description')->nullable();
            $table->decimal('amount', 15, 2); 
            $table->string('supporting_document')->nullable();
            $table->string('payment_evidence')->nullable();
            $table->enum('status', ['hod_approved', 'bursar_approved','waiting_dg_approval','dg_approved',
            'pv_approved','audit_approved','cash_office_approved','pending','liaison_head_approval',
            'liaison_head_approved','special_duty_head_approved'])->default('pending');
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
        Schema::dropIfExists('staff_requisitions');
    }
};

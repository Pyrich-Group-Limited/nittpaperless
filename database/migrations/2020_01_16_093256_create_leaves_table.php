<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id');
            $table->integer('department_id');
            $table->integer('unit_id')->nullable();
            $table->integer('leave_type_id');
            $table->date('applied_on');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('total_leave_days'); 
            $table->string('leave_reason');

            $table->unsignedBigInteger('relieving_staff_id')->nullable();
            $table->foreign('relieving_staff_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('remark')->nullable();
            $table->string('status')->default('pending');
            $table->string('current_approver')->nullable(); // supervisor, unit_head, hod, accountant
            $table->integer('created_by');
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
        Schema::dropIfExists('leaves');
    }
}

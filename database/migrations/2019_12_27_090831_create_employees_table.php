<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'employees', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();

            $table->string('employee_id')->default('0');
            $table->integer('branch_id')->default('0');
            $table->integer('department_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('sub_unit_id')->nullable();
            $table->string('designation')->nullable();
            $table->string('location')->nullable();
            $table->string('location_type')->nullable();
            $table->string('company_doj')->nullable();
            $table->string('documents')->nullable();
            $table->string('ippis')->nullable();
            $table->string('level')->nullable();

            $table->string('account_holder_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_identifier_code')->nullable();
            $table->string('branch_location')->nullable();
            $table->string('tax_payer_id')->nullable();
            $table->integer('salary_type')->nullable();
            $table->integer('salary')->nullable();
            $table->integer('is_active')->default('1');
            $table->integer('created_by');
            $table->timestamps();
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}

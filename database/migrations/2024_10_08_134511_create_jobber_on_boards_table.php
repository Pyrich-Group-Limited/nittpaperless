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
        Schema::create('jobber_on_boards', function (Blueprint $table) {
            $table->id();
            $table->integer('application');
            $table->date('joining_date')->nullable();
            $table->string('status')->nullable();
            $table->integer('convert_to_employee')->default(0);
            $table->string('job_type')->nullable();
            $table->integer('days_of_week')->nullable();
            $table->integer('salary')->nullable();
            $table->string('salary_type')->nullable();
            $table->string('salary_duration')->nullable();
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
        Schema::dropIfExists('jobber_on_boards');
    }
};

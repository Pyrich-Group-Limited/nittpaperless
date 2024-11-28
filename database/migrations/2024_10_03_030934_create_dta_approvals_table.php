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
        Schema::create('dta_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dta_id');
            $table->foreign('dta_id')->references('id')->on('dtas')->onDelete('cascade');

            $table->unsignedBigInteger('approver_id')->nullable(); 
            $table->foreign('approver_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->string('role')->nullable();
            $table->string('status')->default('pending');
            $table->text('comments')->nullable();

            $table->boolean('approved_by_supervisor')->default(false)->nullable();
            $table->boolean('approved_by_unit_head')->default(false);
            $table->boolean('approved_by_hod')->default(false);
            $table->boolean('approved_by_accountant')->default(false);
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
        Schema::dropIfExists('dta_approvals');
    }
};

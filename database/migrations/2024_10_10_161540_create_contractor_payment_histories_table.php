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
        Schema::create('contractor_payment_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_request_id')->nullable();
            $table->foreign('payment_request_id')->references('id')->on('payment_requests')->onDelete('cascade');
            $table->unsignedBigInteger('contract_id')->nullable();
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
            $table->unsignedBigInteger('contractor_id')->nullable();
            $table->foreign('contractor_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id')->references('id')->on('project_creations')->onDelete('cascade');
            $table->decimal('amount_paid', 15, 2);
            $table->date('payment_date')->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('processed_by')->nullable();
            $table->foreign('processed_by')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('remaining_balance', 15, 2);
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
        Schema::dropIfExists('contractor_payment_histories');
    }
};

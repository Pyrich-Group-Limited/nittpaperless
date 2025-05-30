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
        Schema::create('payment_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained()->onDelete('cascade');
            $table->decimal('recommended_amount', 15, 2);
            $table->decimal('recommended_percentage', 5, 2);
            $table->foreignId('recommended_by')->constrained('users')->onDelete('cascade'); // Head of Physical Planning
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('cascade'); // DG
            $table->foreignId('signed_by')->nullable()->constrained('users')->onDelete('cascade'); // Bursar
            $table->foreignId('voucher_raised_by')->nullable()->constrained('users')->onDelete('cascade'); // Voucher Unit Head
            $table->foreignId('audited_by')->nullable()->constrained('users')->onDelete('cascade'); // Auditor
            $table->foreignId('paid_by')->nullable()->constrained('users')->onDelete('cascade'); // payer
            $table->enum('status', ['pending', 'recommended', 'approved', 'signed', 'voucher_raised','audited', 'paid'])->default('pending');
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->foreign('account_id')->references('id')->on('chart_of_accounts')->onDelete('cascade');
            $table->string('payment_evidence')->nullable();
            $table->boolean('isCompleted')->nullable();
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
        Schema::dropIfExists('payment_requests');
    }
};

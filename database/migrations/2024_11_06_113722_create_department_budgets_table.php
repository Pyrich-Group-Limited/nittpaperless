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
        Schema::create('department_budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('budget_category_id')->constrained();
            $table->foreignId('department_id')->constrained();
            $table->decimal('total_requested', 15, 2)->default(0);
            $table->foreignId('user_id')->constrained();
            $table->enum('status', ['pending', 'approved', 'rejected','pending_dg_approval'])->default('pending');
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('department_budgets');
    }
};

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
        Schema::create('budget_items', function (Blueprint $table) {
            $table->id(); 
            // $table->foreignId('department_budget_id')->constrained();
            $table->unsignedBigInteger('department_budget_id')->nullable();
            $table->foreign('department_budget_id')->references('id')->on('department_budgets')->onDelete('cascade');
            $table->string('description');
            $table->string('quantity');
            $table->decimal('amount', 15, 2);
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
        Schema::dropIfExists('budget_items');
    }
};

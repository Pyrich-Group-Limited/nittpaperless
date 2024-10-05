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
        Schema::create('dtas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('destination');
            $table->mediumText('purpose');
            $table->date('travel_date');
            $table->date('arrival_date');
            $table->decimal('estimated_expense', 10, 2);
            $table->string('status')->default('pending');
            $table->string('current_approver')->nullable(); // supervisor, unit_head, hod, accountant
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
        Schema::dropIfExists('dtas');
    }
};

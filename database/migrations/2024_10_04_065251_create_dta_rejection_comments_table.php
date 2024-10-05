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
        Schema::create('dta_rejection_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dta_id');
            $table->foreign('dta_id')->references('id')->on('dtas')->onDelete('cascade');
            $table->unsignedBigInteger('rejected_by'); // Reference to employee (supervisor, unit head, etc.)
            $table->foreign('rejected_by')->references('id')->on('users')->onDelete('cascade');
            $table->text('comment');
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
        Schema::dropIfExists('dta_rejection_comments');
    }
};

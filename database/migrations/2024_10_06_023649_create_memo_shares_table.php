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
        Schema::create('memo_shares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('memo_id');   // The memo being shared
            $table->unsignedBigInteger('shared_with');  // The employee it was shared with
            $table->unsignedBigInteger('shared_by');  // The employee who shared the memo
            $table->text('comment')->nullable();      // Comment added while sharing

            $table->foreign('memo_id')->references('id')->on('memos')->onDelete('cascade');
            $table->foreign('shared_with')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('shared_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('memo_shares');
    }
};

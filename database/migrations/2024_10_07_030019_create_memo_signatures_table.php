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
        Schema::create('memo_signatures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('memo_id');  // Memo being signed
            $table->unsignedBigInteger('user_id');  // User who signed the memo

            $table->foreign('memo_id')->references('id')->on('memos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('memo_signatures');
    }
};

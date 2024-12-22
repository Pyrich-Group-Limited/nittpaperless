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
        Schema::table('file_user', function (Blueprint $table) {
            $table->unsignedBigInteger('sharer_id')->nullable()->after('user_id');
            $table->foreign('sharer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('file_user', function (Blueprint $table) {
            $table->dropForeign(['sharer_id']);
            $table->dropColumn('sharer_id');
        });
    }
};

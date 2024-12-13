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
        Schema::create('hrmdocuments', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('path');

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('hrmfolders_id')->unsigned()->nullable();
            $table->foreign('hrmfolders_id')->references('id')->on('hrmfolders')->onDelete('cascade');

            $table->boolean('is_archived')->default(0);  // 0 for active, 1 for archived
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
        Schema::dropIfExists('hrmdocuments');
    }
};

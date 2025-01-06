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
        Schema::table('files', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable()->after('folder_id');
            $table->unsignedBigInteger('unit_id')->nullable()->after('department_id');
            $table->string('location_type')->nullable()->after('unit_id');

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['unit_id']);
            $table->dropColumn(['department_id', 'unit_id', 'location_type']);
        });
    }
};

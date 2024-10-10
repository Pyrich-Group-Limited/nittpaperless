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
        Schema::table('employees', function (Blueprint $table) {
            // Check and add columns only if they don't already exist
            if (!Schema::hasColumn('employees', 'name')) {
                $table->string('name');
            }
            if (!Schema::hasColumn('employees', 'location')) {
                $table->string('location');
            }
            if (!Schema::hasColumn('employees', 'location_type')) {
                $table->string('location_type')->nullable();
            }
            if (!Schema::hasColumn('employees', 'department_id')) {
                $table->unsignedBigInteger('department_id');
            }
            if (!Schema::hasColumn('employees', 'directorate_id')) {
                $table->unsignedBigInteger('directorate_id');
            }
            if (!Schema::hasColumn('employees', 'unit_id')) {
                $table->unsignedBigInteger('unit_id');
            }
            if (!Schema::hasColumn('employees', 'sub_unit_id')) {
                $table->unsignedBigInteger('sub_unit_id')->nullable();
            }
    
            // Ensure the user_id column is present
            if (!Schema::hasColumn('employees', 'user_id')) {
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
            if (Schema::hasColumn('employees', 'user_id')) {
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('employees', 'name')) {
                $table->dropColumn('name');
            }
        });
    }
};

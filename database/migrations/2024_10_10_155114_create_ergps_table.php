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
        Schema::create('ergps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_category_id')->nullable();
            $table->foreign('project_category_id')->references('id')->on('project_categories')->onDelete('cascade');
            $table->year('year'); // Year of the project
            $table->decimal('project_sum', 15, 2); // Total project sum for the category
            $table->decimal('amount_paid', 15, 2)->default(0); // Amount paid out from the project sum
            $table->decimal('balance', 15, 2)->virtualAs('project_sum - amount_paid'); // Remaining balance (calculated as a virtual column)
            $table->decimal('deficit', 15, 2)->default(0); // Any deficit related to the project
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
        Schema::dropIfExists('ergps');
    }
};

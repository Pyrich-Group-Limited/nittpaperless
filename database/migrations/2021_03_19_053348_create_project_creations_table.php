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
        Schema::create('project_creations', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('projectId')->unique()->nullable();
            $table->text('description');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->unsignedBigInteger('project_category_id')->nullable();
            $table->foreign('project_category_id')->references('id')->on('project_categories')->onDelete('cascade');

            $table->string('project_boq')->nullable();

            $table->unsignedBigInteger('supervising_staff_id')->nullable();
            $table->foreign('supervising_staff_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('status')->default('pending');
            $table->integer('budget')->nullable();

            $table->decimal('profit_margin')->nullable();
            $table->decimal('consultation_fee')->nullable();
            $table->decimal('vat')->nullable();

            $table->boolean('advert_approval_status')->default(false);

            $table->boolean('withAdvert')->default(true);

            $table->boolean('isApproved')->default(false);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('project_creations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'contracts', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('client_name');
            $table->string('subject')->nullable();
            $table->decimal('value', 15, 2)->nullable();
            $table->decimal('amount_paid_to_date', 15, 2)->default(0);

            $table->unsignedBigInteger('type')->nullable();
            $table->foreign('type')->references('id')->on('project_categories')->onDelete('cascade');

            // $table->integer('type')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('description')->nullable();
            $table->string('project_id')->nullable();
            $table->text('contract_description')->nullable();
            $table->string('status')->default('pending');;
            $table->longText('client_signature')->nullable();
            $table->longText('company_signature')->nullable();
            $table->boolean('is_complete')->nullable();
            $table->integer('created_by');
            $table->timestamps();
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}

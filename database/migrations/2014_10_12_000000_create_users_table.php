<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'users', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('location_type');
            $table->string('location');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->integer('plan')->nullable();
            $table->date('plan_expire_date')->nullable();
            $table->string('type')->nullable();
            $table->string('avatar')->default('');
            $table->string('messenger_color')->default('#2180f3');
            $table->string('lang', 100)->nullable();
            $table->integer('created_by')->default(0);
            $table->integer('default_pipeline')->nullable();
            $table->boolean('active_status')->default(0);
            $table->integer('delete_status')->default(1);
            $table->string('mode', 10)->default('light');
            $table->boolean('dark_mode')->default(0);
            $table->integer('is_active')->default(1);
            $table->datetime('last_login_at')->nullable();
            $table->string('designation');
            $table->string('ippis')->nullable();
            $table->string('level');
            $table->integer('department_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('sub_unit_id')->nullable();
            $table->string('secret_code')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

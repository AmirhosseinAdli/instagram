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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique()->nullable();
            $table->string('mobile')->nullable();
            $table->string('full_name');
            $table->string('username')->unique();
            $table->date('birthdate')->nullable();
            $table->string('bio')->nullable();
            $table->string('website')->nullable();
            $table->enum('gender',['male','female'])->nullable();
            $table->boolean('is_activate')->default(1);
            $table->boolean('is_private')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

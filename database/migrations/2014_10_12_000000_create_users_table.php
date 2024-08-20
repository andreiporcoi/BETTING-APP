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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('country')->nullable();
            $table->unsignedInteger('dateCreated')->nullable();
            $table->unsignedInteger('blocked')->default(0);
            $table->unsignedInteger('admin')->default(0);
            $table->rememberToken();
            $table->string('avatar')->nullable();
            $table->string('refCode')->nullable();
            $table->string('referredBy')->default("app")->nullable();
            $table->string('balance')->default("0");
            $table->unsignedInteger('coins')->default(0);
            $table->unsignedInteger('verified')->default(0);
            $table->unsignedInteger('refConfirmCount')->default(0);
            $table->unsignedInteger('refUnConfirmCount')->default(0);
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
};
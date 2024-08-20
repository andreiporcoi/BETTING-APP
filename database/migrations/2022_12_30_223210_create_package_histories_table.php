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
        Schema::create('package_histories', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('reference');
            $table->string('title');
            $table->string('amount');
            $table->unsignedInteger('quantity')->nullable();
            $table->unsignedInteger('duration')->nullable();
            $table->string('roi')->nullable();
            $table->string('startDate')->nullable();
            $table->string('endDate')->nullable();
            $table->unsignedInteger('type');
            $table->unsignedInteger('status')->default(2);
            $table->string('payMethod')->nullable();
            $table->string('hash')->nullable();

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
        Schema::dropIfExists('package_histories');
    }
};

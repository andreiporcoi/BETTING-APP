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
        Schema::create('investments_histories', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('email');
            $table->string('interest');
            $table->string('amount');
            $table->string('roi');
            $table->string('startDate');
            $table->string('nextDate')->default('0');
            $table->string('endDate');
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
        Schema::dropIfExists('investments_histories');
    }
};

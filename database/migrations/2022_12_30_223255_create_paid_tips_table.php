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
        Schema::create('paid_tips', function (Blueprint $table) {
            $table->id();
            $table->string('sportId');
            $table->string('sportType');
            $table->string('league');
            $table->string('teamOne');
            $table->string('teamOneLogo')->nullable();
            $table->string('teamTwo');
            $table->string('teamTwoLogo')->nullable();
            $table->string('statsUrl')->nullable();
            $table->string('tips');
            $table->string('odds');
            $table->unsignedInteger('amount')->default(0);
            $table->string('sportDate');
            $table->string('sportTime');
            $table->string('probability');
            $table->unsignedInteger('status');
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
        Schema::dropIfExists('paid_tips');
    }
};
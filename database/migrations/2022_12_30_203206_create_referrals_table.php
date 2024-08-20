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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->string('refereeCode');
            $table->string('refereeUid');
            $table->string('refereeEmail');
            $table->string('refereeName');
            $table->string('referredUid');
            $table->string('referredEmail');
            $table->string('referredName');
            $table->string('joinedDate');
            $table->string('confirmed')->default(0);
            $table->string('confirmDate')->default(0);
            $table->string('amount')->default('0.0');
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
        Schema::dropIfExists('referrals');
    }
};
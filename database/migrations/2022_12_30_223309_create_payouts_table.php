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
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('email');
            $table->string('fullName');
            $table->string('amount');
            $table->unsignedInteger('status')->default(1);
            $table->unsignedInteger('payType')->default(1);
            $table->string('currency');
            $table->unsignedInteger('paymentMethod')->nullable();
            $table->string('walletAddress')->nullable();
            $table->string('bankName')->nullable();
            $table->string('accName')->nullable();
            $table->string('accNum')->nullable();
            $table->string('bankCountry')->nullable();
            $table->string('swiftCode')->nullable();

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
        Schema::dropIfExists('payouts');
    }
};

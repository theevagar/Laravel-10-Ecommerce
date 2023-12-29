<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('discount_coupons', function (Blueprint $table) {
            $table->id();


            //The discount coupons code
            $table->string('code');


            //The Human readable discount coupons code name
            $table->string('name')->nullable();



            //The description of the  coupons - not necessary
            $table->text('description');

            //The max uses this discount  coupons has
            $table->integer('max_uses')->nullable();


            //How many times a user use this  coupons
            $table->integer('max_uses_user');


            //Whether or not  the  coupons is a percentage or a fixable price
            $table->enum('type',['percent','fixed'])->default('fixed');

            //The amount of discount based on type
            $table->double('discount_amount',10,2);

             //The amount of discount based on type
             $table->double('min_amount',10,2)->nullable();


            $table->integer('status')->default(1);

            //When the  coupons begins
            $table->timestamp('starts_at')->nullable();

            //When the  coupons ends
            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_coupons');
    }
};

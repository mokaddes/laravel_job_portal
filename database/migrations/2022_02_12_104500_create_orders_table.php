<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('company');
            $table->string('street')->nullable();
            $table->string('house_no')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('country');
            $table->string('tax_id')->nullable();
            $table->string('salutation')->nullable();
            $table->string('contact_persion');
            $table->string('email');
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
        Schema::dropIfExists('orders');
    }
}

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
        if (!Schema::hasTable('order_food_sub'))
        {
            Schema::create('order_food_sub', function (Blueprint $table) {
                $table->bigIncrements('order_food_sub_id');
                $table->string('order_food_id')->nullable(); //
                $table->string('menukitchen_id')->nullable(); //รายการอาหาร
                $table->string('order_food_sub_qty')->nullable(); 
                $table->double('menukitchen_pricesale', 10, 2)->nullable();
                $table->double('order_sumprice', 10, 2)->nullable();  
                $table->enum('menukitchen_active', ['ORDER', 'CANCEL','OFF'])->default('OFF');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_food_sub_sub');
    }
};

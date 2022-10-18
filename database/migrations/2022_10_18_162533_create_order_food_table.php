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
        if (!Schema::hasTable('order_food'))
        {
            Schema::create('order_food', function (Blueprint $table) {
                $table->bigIncrements('order_food_id');
                $table->date('order_food_date')->nullable(); // 
                $table->double('order_food_sumprice', 10, 2)->nullable();
                $table->double('order_food_discount', 10, 2)->nullable();
                $table->double('order_food_total', 10, 2)->nullable();
                $table->string('table_group_1_id')->nullable(); //โต๊ะ 
                $table->string('user_order')->nullable(); //ผู้สั่ง
                $table->string('user_orderrep')->nullable(); //ผู้รับ
                $table->enum('order_food_active', ['ORDER', 'PAY','STALE','FINISH','CANCEL','OFF'])->default('OFF');
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
        Schema::dropIfExists('order_food');
    }
};

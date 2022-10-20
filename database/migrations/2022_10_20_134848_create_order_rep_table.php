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
        if (!Schema::hasTable('order_rep'))
        {
            Schema::create('order_rep', function (Blueprint $table) {
                $table->bigIncrements('order_rep_id');
                $table->string('table_group_1_id')->nullable();       //โต๊ะ 
                $table->string('table_group_1_name')->nullable();      //โต๊ะ 
                $table->date('order_rep_date')->nullable();            // วันที่
                $table->string('order_rep_menukitchen_id')->nullable();  // รายการอาหาร
                $table->string('order_rep_qty')->nullable();             //จำนวน
                $table->double('order_rep_price', 10, 2)->nullable();   //ราคา
                $table->double('order_rep_discount', 10, 2)->nullable(); //ส่วนลด
                $table->double('order_rep_total', 10, 2)->nullable();   //  รวม         
                $table->string('order_reqe_user')->nullable();           //ผู้สั่ง
                $table->string('order_reci_user')->nullable();            //ผู้รับ
                $table->enum('order_rep_active', ['ORDER','PREORDER', 'PAY','STALE','FINISH','CANCEL','OFF'])->default('OFF');
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
        Schema::dropIfExists('order_rep');
    }
};

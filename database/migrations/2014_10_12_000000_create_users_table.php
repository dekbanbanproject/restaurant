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
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('password');
        //     $table->rememberToken();
        //     $table->timestamps();
        // });
            if (!Schema::hasTable('users'))
        {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('pname')->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('cid')->nullable();
            $table->string('fingle')->nullable();
            $table->string('tel')->nullable();
            $table->string('username');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('type', ['ADMIN', 'STAFF', 'CUSTOMER', 'MANAGE','USER','NOTUSER'])->default('USER');
            $table->string('line_token')->nullable();
            $table->string('status')->nullable();
            $table->string('permiss_customer')->nullable();
            $table->string('permiss_sale')->nullable();
            $table->string('permiss_order')->nullable();
            $table->string('permiss_recieve')->nullable();
            $table->string('permiss_pay')->nullable();
            $table->string('permiss_store')->nullable();
            $table->string('permiss_fontend')->nullable();
            $table->string('permiss_bar')->nullable();
            $table->string('permiss_kitchen')->nullable();
            $table->string('permiss_cashier')->nullable();
            $table->string('permiss_car')->nullable();
            $table->string('permiss_bathroom')->nullable();
            $table->string('permiss_room')->nullable();
            $table->string('permiss_karaoke')->nullable();
            $table->string('store_id')->nullable();
            $table->string('member_id')->nullable();
            $table->string('img')->nullable();
            $table->string('img_name')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

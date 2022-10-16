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
        if (!Schema::hasTable('menukitchen'))
        {
            Schema::create('menukitchen', function (Blueprint $table) {
                $table->bigIncrements('menukitchen_id');
                $table->string('menukitchen_name')->nullable();
                $table->string('menukitchen_code')->nullable();
                $table->double('menukitchen_pricecost', 10, 2)->nullable();
                $table->double('menukitchen_pricesale', 10, 2)->nullable();
                $table->binary('img')->nullable();
                $table->string('img_name')->nullable();
                $table->enum('menukitchen_active', ['TRUE', 'FALSE'])->default('TRUE');
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
        Schema::dropIfExists('menukitchen');
    }
};

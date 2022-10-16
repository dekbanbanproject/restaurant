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
        if (!Schema::hasTable('menukitchen_category'))
        {
            Schema::create('menukitchen_category', function (Blueprint $table) {
                $table->bigIncrements('menukitchen_category_id');
                $table->string('menukitchen_category_name')->nullable(); 
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
        Schema::dropIfExists('menukitchen_category');
    }
};

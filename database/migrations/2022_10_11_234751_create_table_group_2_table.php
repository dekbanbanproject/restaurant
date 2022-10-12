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
        if (!Schema::hasTable('table_group_2'))
        {
            Schema::create('table_group_2', function (Blueprint $table) {
                $table->bigInteger('table_group_2_id');
                $table->string('table_group_2_name')->nullable();
                $table->string('table_group_2_zone')->nullable();
                $table->string('user_id')->nullable();
                $table->enum('table_group_2_active', ['TRUE', 'FALSE'])->default('TRUE');
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
        Schema::dropIfExists('table_group_2');
    }
};

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
        Schema::create('db_product_sale', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('product_id');
            $table->float('price_sale');
            $table->dateTime('data_begin');
            $table->dateTime('data_end');
            $table->unsignedTinyInteger('created_by');
            $table->unsignedTinyInteger('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ttt_product_sale');
    }
};

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
        Schema::create('db_post', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('topic_id');
            $table->string('title', 1000);
            $table->string('slug', 1000);
            $table->longText('detail');
            $table->string('images', 1000);
            $table->string('type', 1000);
            $table->string('metakey', 1000);
            $table->string('metadesc', 1000);
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
            $table->unsignedInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ttt_post');
    }
};

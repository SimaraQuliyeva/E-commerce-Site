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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name');
            $table->text('content');

            $table->string('text1_icon');
            $table->string('text1_header');
            $table->text('text1_content');

            $table->string('text2_icon');
            $table->string('text2_header');
            $table->text('text2_content');

            $table->string('text3_icon');
            $table->string('text3_header');
            $table->text('text3_content');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};

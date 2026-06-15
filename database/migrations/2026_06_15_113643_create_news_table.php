<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
{
    Schema::create('news', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique(); // Untuk URL berita
        $table->text('content');
        $table->string('image')->nullable(); // Untuk path foto
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('statistics', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('listing_id')->constrained()->onDelete('cascade');
            $table->integer('views')->default(0);
            $table->integer('comments_count')->default(0);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }

};

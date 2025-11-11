<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('subject_id');
            $table->enum('subject_type', ['movie', 'tv', 'anime']);
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');
            $table->text('body');
            $table->timestamps();
            
            $table->index(['subject_id', 'subject_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
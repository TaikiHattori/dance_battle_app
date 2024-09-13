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
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            // 🔽 2カラム追加
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title')->default('Untitled');
            $table->string('mp3_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};


//ミス2:ミスしたのでロールバックして削除
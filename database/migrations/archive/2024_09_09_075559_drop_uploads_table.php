<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUploadsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('uploads');
    }

    public function down()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            // 🔽 2カラム追加
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('mp3_url');
            $table->timestamps();
        });
    }
}


//このファイルでミス1を削除
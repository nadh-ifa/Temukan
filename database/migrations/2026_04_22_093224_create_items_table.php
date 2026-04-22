<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title', 150);
            $table->text('description');
            $table->enum('type', ['hilang', 'ditemukan']);
            $table->string('location', 150);
            $table->date('date_event');
            $table->string('image')->nullable();
            $table->enum('status', [
                'dilaporkan',
                'ada_di_resepsionis',
                'sudah_diambil',
                'ditutup'
            ])->default('dilaporkan');
            $table->foreignId('validated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('validated_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
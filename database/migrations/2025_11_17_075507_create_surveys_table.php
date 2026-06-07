<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('surveys', function (Blueprint $table) {
        $table->id();

        $table->foreignId('room_id')->constrained()->cascadeOnDelete();
        $table->foreignId('unit_id')->constrained()->cascadeOnDelete();

        $table->date('scheduled_date');
        $table->enum('method', ['admin', 'user']);
        $table->enum('status', ['dijadwalkan','menunggu_validasi','selesai','ditolak'])
              ->default('dijadwalkan');

        $table->foreignId('performed_by')->nullable()->constrained('users')->nullOnDelete();

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('submissions', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('asset_id')->nullable()->constrained()->nullOnDelete();

        $table->enum('type', ['penambahan', 'penghapusan', 'perubahan_kondisi']);
        $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');

        $table->text('description')->nullable();
        $table->string('new_condition')->nullable();  // for perubahan kondisi
        $table->integer('new_quantity')->nullable();  // for penambahan

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};

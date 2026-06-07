<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('assets', function (Blueprint $table) {
        $table->id();
        $table->foreignId('unit_id')->constrained()->cascadeOnDelete();
        $table->foreignId('room_id')->constrained()->cascadeOnDelete();

        $table->string('code')->unique(); // format: UNIT-0001
        $table->string('name');
        $table->integer('quantity')->default(1);
        $table->string('unit'); // pcs, set, box, dll
        $table->enum('condition', ['baik','rusak_ringan','rusak_berat'])->default('baik');
        $table->year('acquired_year');

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};

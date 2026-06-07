<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('survey_items', function (Blueprint $table) {
        $table->id();

        $table->foreignId('survey_id')->constrained()->cascadeOnDelete();
        $table->foreignId('asset_id')->constrained()->cascadeOnDelete();

        $table->enum('condition', ['baik', 'rusak_ringan', 'rusak_berat']);
        $table->enum('existence', ['ada', 'tidak_ada'])->default('ada');
        $table->text('notes')->nullable();
        $table->string('photo')->nullable(); // disimpan di storage/app/public

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('survey_items');
    }
};

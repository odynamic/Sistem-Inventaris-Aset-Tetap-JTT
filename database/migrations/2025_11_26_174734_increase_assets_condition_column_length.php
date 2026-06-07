<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            // Ubah tipe kolom 'condition' menjadi VARCHAR dengan panjang 15
            // Defaultnya mungkin hanya 5 atau 10, jadi kita perpanjang.
            $table->string('condition', 15)->change();
        });
    }

    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            // Jika Anda ingin mengembalikan perubahan, kembalikan ke panjang aslinya (misalnya 5)
            $table->string('condition', 5)->change(); 
        });
    }
};
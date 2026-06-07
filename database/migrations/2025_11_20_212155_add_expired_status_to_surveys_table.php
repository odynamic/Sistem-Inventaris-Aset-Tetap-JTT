<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // safe way: alter enum to include 'expired'
        // This uses raw SQL — adjust table/column names if different.
        DB::statement("ALTER TABLE surveys MODIFY COLUMN `status` ENUM('dijadwalkan','menunggu_validasi','selesai','ditolak','expired') NOT NULL DEFAULT 'dijadwalkan'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE surveys MODIFY COLUMN `status` ENUM('dijadwalkan','menunggu_validasi','selesai','ditolak') NOT NULL DEFAULT 'dijadwalkan'");
    }
};

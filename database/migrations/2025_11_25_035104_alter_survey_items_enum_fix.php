<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// ⬇️ INI YANG KURANG
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE survey_items MODIFY `condition`
            ENUM('baik', 'rusak_ringan', 'rusak_berat', 'hilang') NULL
        ");

        DB::statement("
            ALTER TABLE survey_items MODIFY `existence`
            ENUM('ada', 'tidak_ada') NULL
        ");
    }

    public function down(): void
    {
        //
    }
};

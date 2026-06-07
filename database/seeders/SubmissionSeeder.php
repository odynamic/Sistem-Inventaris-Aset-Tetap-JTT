<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubmissionSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        DB::table('submissions')->insert([
            // --- ADD ---
            [
                'user_id' => 2,
                'asset_id' => null,
                'type' => 'add',
                'status' => 'menunggu',
                'description' => 'Mohon penambahan meja kerja baru untuk staf operasi.',
                'meta' => null,
                'new_condition' => null,
                'new_quantity' => null,

                'add_unit_id' => 1,
                'add_room_id' => 1,
                'add_name' => 'Meja Kerja Baru',
                'add_quantity' => 5,
                'add_unit' => 'pcs',
                'add_condition' => 'baik',
                'add_acquired_year' => 2025,
                'add_photo' => null,

                'created_at' => $now,
                'updated_at' => $now,
            ],

            // --- UPDATE ---
            [
                'user_id' => 2,
                'asset_id' => 1,
                'type' => 'update',
                'status' => 'menunggu',
                'description' => 'Perubahan kondisi setelah perbaikan.',
                'meta' => null,
                'new_condition' => 'rusak_ringan',
                'new_quantity' => 2,

                // kolom ADD wajib NULL
                'add_unit_id' => null,
                'add_room_id' => null,
                'add_name' => null,
                'add_quantity' => null,
                'add_unit' => null,
                'add_condition' => null,
                'add_acquired_year' => null,
                'add_photo' => null,

                'created_at' => $now,
                'updated_at' => $now,
            ],

            // --- DELETE ---
            [
                'user_id' => 2,
                'asset_id' => 1,
                'type' => 'delete',
                'status' => 'menunggu',
                'description' => 'Aset tidak layak pakai lagi, mohon dihapus.',
                'meta' => null,
                'new_condition' => null,
                'new_quantity' => null,

                // kolom ADD wajib NULL
                'add_unit_id' => null,
                'add_room_id' => null,
                'add_name' => null,
                'add_quantity' => null,
                'add_unit' => null,
                'add_condition' => null,
                'add_acquired_year' => null,
                'add_photo' => null,

                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}

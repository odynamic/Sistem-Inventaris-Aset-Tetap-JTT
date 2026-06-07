<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class NewAssetsJMRBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startId = 121;
        
        // PARAMETER SESUAI PERMINTAAN TERAKHIR:
        $roomId = 25;   
        $unitId = 2;    

        $now = Carbon::now();

        // [PENCEGAHAN DUPLIKASI]
        // Hapus data aset di room 25 yang memiliki ID mulai dari 121 ke atas.
        DB::table('assets')
            ->where('room_id', $roomId)
            ->where('id', '>=', $startId)
            ->delete();

        $newAssetsData = [
            // Data aset dari gambar (12 baris)
            ['name' => 'Meja 1/2 Biro', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['name' => 'Filling Cabinet', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['name' => 'Meja Komputer', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['name' => 'Kursi Putar Manager', 'quantity' => 4, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['name' => 'Kursi Hadap Informa Hitam', 'quantity' => 6, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['name' => 'Rak Arsip', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['name' => 'Bupet Dapur', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['name' => 'AC Panasonic', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik'],
            ['name' => 'iPhone', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik'],
            ['name' => 'Tong Sampah', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['name' => 'Vertical Blend', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['name' => 'Jam Dinding', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik'],
        ];

        $finalData = [];

        foreach ($newAssetsData as $index => $data) {
            $currentId = $startId + $index;
            // Membuat kode aset: ASET-121-25, ASET-122-25, dst.
            $assetCode = 'ASET-' . str_pad($currentId, 3, '0', STR_PAD_LEFT) . '-25';

            $finalData[] = [
                'id' => $currentId,
                'unit_id' => $unitId, 
                'room_id' => $roomId, 
                'code' => $assetCode, 
                'name' => $data['name'],
                'quantity' => $data['quantity'],
                'unit' => $data['unit'],
                'condition' => $data['condition'],
                'acquired_year' => 2025,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ];
        }

        DB::table('assets')->insert($finalData);
        
        $this->command->info('New Assets JMRB (ID ' . $startId . ' sampai ' . $currentId . ') added successfully to room ' . $roomId . ' (unit ' . $unitId . ').');
    }
}
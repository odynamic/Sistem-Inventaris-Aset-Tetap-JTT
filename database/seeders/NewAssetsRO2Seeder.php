<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class NewAssetsRO2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unitId = 1;
        $now = Carbon::now();

        // 1. Definisikan Room ID Mapping
        $roomMapping = [
            'Ruang Staf BS' => 1,
            'Ruang TCM Specialist' => 2,
            'BS Dept Head' => 3,
            'TCM Dept Head' => 4,
            'BS Specialist' => 5,
            'Musholla BS' => 6,
            'Ruang Asset Specialist' => 7,
            'Ruang Lobby Asset' => 8,
            'Ruang OM Specilaist' => 9,
            'Ruang SKJM' => 10,
            'Lobby Kantor Bawah' => 11,
            'Aula' => 12,
            'Ruang Arsip' => 13,
            'Dapur' => 14,
            'Ruang Rapat Utama' => 15,
            'Ruang Senior Manager' => 16,
            'Ruang Sekretaris SM' => 17,
            'Server' => 18,
            'R Istirahat Lt2' => 19,
            'Lorong LT 2' => 20,
            'Lorong LT 1' => 21,
            'Gudang Dapur' => 22,
            'Gudang Logistic' => 23,
            'Pos Security' => 24,
            'Ruang Staf OM' => 1, // Menggunakan ID Ruang Staf BS (1)
        ];

        // 2. Hapus data lama & Reset auto-increment
        DB::table('assets')->where('unit_id', $unitId)->delete();
        DB::statement('ALTER TABLE assets AUTO_INCREMENT = 1;');


        // 3. Data Aset Lengkap (DARI INPUT ANDA)
        $allAssetsData = [
            ['room' => 'Ruang TCM Specialist', 'name' => 'Meja Komputer', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang TCM Specialist', 'name' => 'Printer L120', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang TCM Specialist', 'name' => 'Vertical Blind', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Dept Head', 'name' => 'Meja 1 biro', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Hilang', 'acquired_year' => 2024],
            ['room' => 'BS Dept Head', 'name' => 'White board', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Hilang', 'acquired_year' => 2024],
            ['room' => 'BS Dept Head', 'name' => 'Meja arsip', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Dept Head', 'name' => 'Kursi putar merk Bifma', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Dept Head', 'name' => 'Kursi Hadap', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Dept Head', 'name' => 'TV Akari', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Dept Head', 'name' => 'Sofa', 'quantity' => 1, 'unit' => 'Set', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Dept Head', 'name' => 'Jam Dinding', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Dept Head', 'name' => 'AC Panasonic', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Dept Head', 'name' => 'Rak Arsip', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Dept Head', 'name' => 'Tempat sampah Lion star', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Dept Head', 'name' => 'Vertical Blind', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'TCM Dept Head', 'name' => 'Meja Manager', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'TCM Dept Head', 'name' => 'Meja Komputer', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'TCM Dept Head', 'name' => 'Kursi putar Manager', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'TCM Dept Head', 'name' => 'Filling Kabinet', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'TCM Dept Head', 'name' => 'TV Samsung', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'TCM Dept Head', 'name' => 'Vertical Blind', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'TCM Dept Head', 'name' => 'Sofa', 'quantity' => 1, 'unit' => 'Set', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'TCM Dept Head', 'name' => 'Tong Sampah Lion Star', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'TCM Dept Head', 'name' => 'Kursi Hadap', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'TCM Dept Head', 'name' => 'Komputer', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'TCM Dept Head', 'name' => 'Cermin', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Specialist', 'name' => 'AC Daikin', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'BS Specialist', 'name' => 'Kursi hadap', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'BS Specialist', 'name' => 'Filling Kabianet', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'BS Specialist', 'name' => 'Lemari arsip kayu', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Specialist', 'name' => 'Meja Komputer', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Hilang', 'acquired_year' => 2024],
            ['room' => 'BS Specialist', 'name' => 'Meja Manager', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Hilang', 'acquired_year' => 2024],
            ['room' => 'BS Specialist', 'name' => 'Printer Samsung', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Specialist', 'name' => 'Komputer', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Specialist', 'name' => 'Jam dinding', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Specialist', 'name' => 'Tempat sampah Lion star', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Specialist', 'name' => 'Kursi putar merk Bifma', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'BS Specialist', 'name' => 'Vertical Blind', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Musholla BS', 'name' => 'Lemari arsip kayu', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Musholla BS', 'name' => 'Brankas', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Musholla BS', 'name' => 'AC Daikin', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Musholla BS', 'name' => 'Jam dinding', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'Rak Kertas', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'Tempat Sampah', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'Filling Kabinet', 'quantity' => 14, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'Meja Komputer', 'quantity' => 8, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'Printer DCP-T220 Brother', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'Printer Ink Tank 310', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'Meja 1/2 Biro', 'quantity' => 8, 'unit' => 'Buah', 'condition' => 'Hilang', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'Meja Arsip', 'quantity' => 6, 'unit' => 'Buah', 'condition' => 'Hilang', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'Kursi Putar Manager', 'quantity' => 9, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'Kursi Hadap', 'quantity' => 12, 'unit' => 'Buah', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'White Board', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'Meja Komputer Kayu', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'Filling Kabinet 2 Laci', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'Lemari Es', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'AC', 'quantity' => 4, 'unit' => 'Unit', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'Jam Dinding', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'Lemari Arsip Besi', 'quantity' => 7, 'unit' => 'Buah', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf BS', 'name' => 'Vertical Blind', 'quantity' => 5, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf OM', 'name' => 'Meja 1/2 Biro', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Hilang', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf OM', 'name' => 'Meja Arsip', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Hilang', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf OM', 'name' => 'Meja Komputer', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Hilang', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf OM', 'name' => 'Kursi Hadap', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf OM', 'name' => 'Tempat Sampah', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf OM', 'name' => 'Kursi Putar Manager', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf OM', 'name' => 'AC', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf OM', 'name' => 'Printer HP Ink Tank 315', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf OM', 'name' => 'Rak Kertas', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf OM', 'name' => 'Printer Epson L3110', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf OM', 'name' => 'Jam Dinding', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Staf OM', 'name' => 'Komputer', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang TCM Specialist', 'name' => 'Rak Arsip', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang TCM Specialist', 'name' => 'Kursi Hadap', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang TCM Specialist', 'name' => 'Meja Manager', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang TCM Specialist', 'name' => 'Kursi Putar Manager', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang TCM Specialist', 'name' => 'AC', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Musholla BS', 'name' => 'Vertical Blind', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Musholla BS', 'name' => 'Kursi Hadap', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Asset Specialist', 'name' => 'Meja komputer', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang Asset Specialist', 'name' => 'Tempat sampah Lion star', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Asset Specialist', 'name' => 'AC Panasonic', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Asset Specialist', 'name' => 'Meja 1/2 Biro', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Hilang', 'acquired_year' => 2024],
            ['room' => 'Ruang Asset Specialist', 'name' => 'Kursi Hadap', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Asset Specialist', 'name' => 'Printer 310 Ink Tank', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Asset Specialist', 'name' => 'Filling Cabinet', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Asset Specialist', 'name' => 'Vertical Blind', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Lobby Asset', 'name' => 'Meja 1/2 Biro', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Lobby Asset', 'name' => 'Kursi Manager', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Lobby Asset', 'name' => 'AC Panasonic', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Lobby Asset', 'name' => 'Kursi Hadap', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang OM Specilaist', 'name' => 'Meja Manager', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Hilang', 'acquired_year' => 2024],
            ['room' => 'Ruang OM Specilaist', 'name' => 'Kursi hadap', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Hilang', 'acquired_year' => 2024],
            ['room' => 'Ruang OM Specilaist', 'name' => 'Meja Komputer', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Hilang', 'acquired_year' => 2024],
            ['room' => 'Ruang OM Specilaist', 'name' => 'Kursi Putar Manager', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang OM Specilaist', 'name' => 'AC Panasonic', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang OM Specilaist', 'name' => 'Tempat sampah Lion star', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang OM Specilaist', 'name' => 'Rak Arsip', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang OM Specilaist', 'name' => 'Soft Board', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang OM Specilaist', 'name' => 'Vertical Blind', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Meja Rapat Besar Oval Kayu', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Kursi Rapat Kayu', 'quantity' => 7, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Ranjang Periksa', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Lemari Buku', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Lemari Perpustakaan Kayu', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'AC Panasonic', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Kursi Hadap Futura', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Komputer', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Printer', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Lemari Medis', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Tabung Oksigen', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Meja Kerja', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Papan White Board', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Lemari Arsip', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Rak Koran', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'TP Link', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'PABX', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Power Ton Pabx', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Meja Saran', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang SKJM', 'name' => 'Vertical Blind', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Lobby Kantor Bawah', 'name' => 'Sofa', 'quantity' => 1, 'unit' => 'Set', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Lobby Kantor Bawah', 'name' => 'Emergency Lamp', 'quantity' => 1, 'unit' => 'Set', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Lobby Kantor Bawah', 'name' => 'Meja Recepsemis', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Lobby Kantor Bawah', 'name' => 'Kursi Putar', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Lobby Kantor Bawah', 'name' => 'Iphone', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Lobby Kantor Bawah', 'name' => 'Appar 20 Kg', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Lobby Kantor Bawah', 'name' => 'Lemari Perpustakaan Kayu', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Lobby Kantor Bawah', 'name' => 'AC Kaset', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Aula', 'name' => 'AC Split', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Aula', 'name' => 'Mic Wireless', 'quantity' => 4, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Aula', 'name' => 'Spiker JTB', 'quantity' => 4, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Aula', 'name' => 'Meja L', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Aula', 'name' => 'Jam Dinding', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Aula', 'name' => 'Kursi Training Lipat', 'quantity' => 13, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Aula', 'name' => 'Infocus', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Aula', 'name' => 'Layar Proyektor', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Aula', 'name' => 'Meja Rapat', 'quantity' => 10, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Aula', 'name' => 'Meja Podium', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Aula', 'name' => 'Meja Kerja', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Aula', 'name' => 'White Board', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Aula', 'name' => 'Kursi Hadap Futura', 'quantity' => 15, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Aula', 'name' => 'Kursi Hadap Informa', 'quantity' => 15, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Aula', 'name' => 'AC Standing Panasonic', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Aula', 'name' => 'Alat Zoom', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Arsip', 'name' => 'Vertical Blind', 'quantity' => 8, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Arsip', 'name' => 'Rak Ordner', 'quantity' => 5, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Arsip', 'name' => 'Filling Kabinet', 'quantity' => 13, 'unit' => 'Buah', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang Arsip', 'name' => 'Kursi Savello', 'quantity' => 4, 'unit' => 'Buah', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang Arsip', 'name' => 'Lemari Arsip Kayu', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Arsip', 'name' => 'Brankas', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Arsip', 'name' => 'Meja Komputer', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Arsip', 'name' => 'Rak Arsip', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Arsip', 'name' => 'Meja Arsip Kayu', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang Arsip', 'name' => 'Hight Box', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang Arsip', 'name' => 'AC Panasonic', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang Arsip', 'name' => 'Lemari Arsip Besi', 'quantity' => 5, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Arsip', 'name' => 'Lemari Arsip Besi Besar', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Dapur', 'name' => 'Tabung Gas', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Dapur', 'name' => 'Kompor Gas', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Dapur', 'name' => 'Filling Kabinet', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Dapur', 'name' => 'Meja Kayu', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Rapat Utama', 'name' => 'TV LG', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Rapat Utama', 'name' => 'Alat Zoom', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Rapat Utama', 'name' => 'Meja Rak', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Rapat Utama', 'name' => 'Jam Dinding Seiko', 'quantity' => 7, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Rapat Utama', 'name' => 'White Board', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Rapat Utama', 'name' => 'AC Split 3PK08 Panasonic', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang Rapat Utama', 'name' => 'Infocus Benqu', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Rapat Utama', 'name' => 'Kursi Tamu Hadap Informa', 'quantity' => 13, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Rapat Utama', 'name' => 'Kursi Manager', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Rapat Utama', 'name' => 'Meja Pertemuan', 'quantity' => 6, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Rapat Utama', 'name' => 'Rak Kertas', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Rapat Utama', 'name' => 'Speaker', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Rapat Utama', 'name' => 'Vertical Blind', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Rapat Utama', 'name' => 'Lemari Arsip Kayu', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Rapat Utama', 'name' => 'Microphone', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Senior Manager', 'name' => 'TV Polytron', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Senior Manager', 'name' => 'Jam Dinding Seiko', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Senior Manager', 'name' => 'Emergency Lamp', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Senior Manager', 'name' => 'Iphone', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Senior Manager', 'name' => 'Sova', 'quantity' => 1, 'unit' => 'Set', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Senior Manager', 'name' => 'Meja Manager Jati', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Senior Manager', 'name' => 'White Board', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Senior Manager', 'name' => 'Kursi Putar', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang Senior Manager', 'name' => 'Kursi Tamu Hadap Manager', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Senior Manager', 'name' => 'Komputer Lenovo', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Senior Manager', 'name' => 'AC Sharp', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Senior Manager', 'name' => 'Tempat Sampah Krisbow', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Senior Manager', 'name' => 'Kulkas Sharp', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Senior Manager', 'name' => 'Rak Arsip', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Senior Manager', 'name' => 'Vertical Blind', 'quantity' => 4, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Sekretaris SM', 'name' => 'Rak Kertas Kayu', 'quantity' => 4, 'unit' => 'Buah', 'condition' => 'Hilang', 'acquired_year' => 2024],
            ['room' => 'Ruang Sekretaris SM', 'name' => 'Scan Laser HP', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Sekretaris SM', 'name' => 'Komputer Dell', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'acquired_year' => 2024],
            ['room' => 'Ruang Sekretaris SM', 'name' => 'Meja Resepsionis', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'acquired_year' => 2024],
            ['room' => 'Ruang Sekretaris SM', 'name' => 'Komputer Lenovo', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'acquired_year' => 2024],
        ];




        // 4. Proses Insert dan Generate Code
        foreach ($allAssetsData as $asset) {
            $roomName = $asset['room'];
            $roomId = $roomMapping[$roomName] ?? null;

            if ($roomId !== null) {
                // Gunakan nilai sementara untuk field 'code' yang NOT NULL
                $tempCode = 'TEMP-' . $roomId;

                try {
                    // --- Insert data aset DENGAN kolom 'code' sementara ---
                    $currentId = DB::table('assets')->insertGetId([
                        'unit_id' => $unitId,
                        'room_id' => $roomId,
                        'code' => $tempCode, // <<<--- Kunci untuk mengatasi error 1364
                        'name' => $asset['name'],
                        'quantity' => $asset['quantity'],
                        'unit' => $asset['unit'],
                        'condition' => $asset['condition'],
                        'acquired_year' => $asset['acquired_year'],
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);

                    // --- Generate asset_code FINAL dan Update ---
                    $assetCode = 'ASET-' . str_pad($currentId, 3, '0', STR_PAD_LEFT) . '-' . $roomId;

                    // Update baris yang sama dengan kode FINAL
                    DB::table('assets')->where('id', $currentId)->update([
                        'code' => $assetCode,
                        'updated_at' => $now,
                    ]);
                } catch (\Exception $e) {
                    echo "Error inserting asset: '{$asset['name']}' in room '{$roomName}'. Message: " . $e->getMessage() . "\n";
                    // Jika Anda ingin seeder berhenti saat gagal, ganti 'continue' dengan 'throw $e;'
                    continue; 
                }

            } else {
                echo "Warning: Room '{$roomName}' not found in mapping.\n";
            }
        }
    }
}
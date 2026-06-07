<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class NewAssetsJMTOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startId = 134;
        $startRoomId = 32;

        // PARAMETER SESUAI PERMINTAAN TERAKHIR:
        // unit_id selalu 4 (sesuai permintaan sebelumnya)
        $unitId = 4;

        $now = Carbon::now();
        $currentId = $startId;

        // --- DATA ASET LENGKAP DARI GAMBAR YANG SUDAH DIOLAH ---
        // room_id akan di-set secara dinamis berdasarkan pemetaan yang sudah disepakati.
        $allAssetsData = [
            // room_id 32: Ruang TMM (Original: Ruang Manager TCM)
            ['name' => 'AC Split Panasonic', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 32],
            ['name' => 'Kursi Hadap Informa Hitam', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 32],
            ['name' => 'Kursi Manager 2015', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 32],
            ['name' => 'Lemari Arsip Manager', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 32],
            ['name' => 'Telpon', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 32],
            ['name' => 'Vertical Blind', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 32],
            ['name' => 'Tong Sampah', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 32],
            ['name' => 'Komputer', 'quantity' => 3, 'unit' => 'Unit', 'condition' => 'Tidak', 'room_id' => 32],
            ['name' => 'Meja Komputer', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 32],
            ['name' => 'Jam Dinding', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 32],
            
            // room_id 34: Ruang Staf TM (Original: Ruang Staff TCM)
            ['name' => 'Meja 1/2 Biro', 'quantity' => 5, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 34],
            ['name' => 'Meja Komputer', 'quantity' => 5, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 34],
            ['name' => 'Meja Arsip', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 34],
            ['name' => 'Lemari Arsip', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 34],
            ['name' => 'Filing Cabinet 2 Laci', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 34],
            ['name' => 'Lemari Kayu', 'quantity' => 8, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 34],
            ['name' => 'Soft Board Gantung', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 34],
            ['name' => 'Lemari Kayu KTM', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 34],
            ['name' => 'Printer Fuji Xerox', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 34],
            ['name' => 'Speaker / 271108', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 34],
            ['name' => 'AC Panasonic', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 34],
            ['name' => 'Printer Canon G3010', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 34],
            ['name' => 'Computer HP All In One', 'quantity' => 4, 'unit' => 'Set', 'condition' => 'Kurang', 'room_id' => 34],
            ['name' => 'Hp All In One PC Touch', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 34],
            ['name' => 'PC+Monitor+Mouse+Keyboard', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 34],
            ['name' => 'Kotak P3K', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 34],
            ['name' => 'Telpon', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 34],
            ['name' => 'Vertical Blind', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 34],

            // room_id 33: Gudang TM (Original: Gudang ATK TCM)
            ['name' => 'Lemari Arsip Besi 2 Pintu', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'Filing Cabinet 4 Laci', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'Rak Besi Susun TTM', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'Rak Kayu TTM', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 33],
            ['name' => 'AC Panasonic', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'Kursi Manager', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'Meja Komputer', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 33],
            ['name' => 'Lemari Arsip Kayu', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 33],

            // room_id 39: Gudang TM (Original: Gudang TCM di Palimanan-Kanci)
            ['name' => 'Lemari Arsip Besi 2 Pintu', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 39],
            ['name' => 'Filing Cabinet 4 Laci', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'Lemari Pakaian Kayu', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'Lemari Arsip Kayu Kaca', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'Rak Tiket Besi', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'Meja Komputer', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 39],

            // room_id 49: Ruang Staf TCM (Original: GT. Cip-Tim (CR))
            ['name' => 'AC Split', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 49],
            ['name' => 'Operator Interface', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 49],
            ['name' => 'Komputer CCTV Lajur', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 49],
            ['name' => 'Kursi Kerja', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 49],
            ['name' => 'Camera CCTV', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 49],
            ['name' => 'Rak EDC', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 49],
            ['name' => 'EDC BCA', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 49],
            ['name' => 'EDC BNI', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 49],
            ['name' => 'Ampli', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 49],

            // room_id 50: Gudang ATK TCM (Original: GT. Cip-Tim (G. 01))
            ['name' => 'GTO Entrance', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 50],
            ['name' => 'CCTV Lajur', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 50],
            ['name' => 'Vms', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 50],
            ['name' => 'Apar', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 50],
            ['name' => 'LLA', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 50],
            ['name' => 'ALB', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 50],
            ['name' => 'OBS', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 50],
            ['name' => 'CDP', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 50],
            ['name' => 'LND', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 50],
            ['name' => 'LVD', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 50],
            ['name' => 'LXP', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 50],

            // room_id 51: Ruang CR TCM (Original: GT. Cip-Tim (G. 03))
            ['name' => 'GTO Entrance', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 51],
            ['name' => 'CCTV Lajur', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 51],
            ['name' => 'Vms', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 51],
            ['name' => 'Apar', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 51],
            ['name' => 'LLA', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 51],
            ['name' => 'ALB', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 51],
            ['name' => 'OBS', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 51],
            ['name' => 'CDP', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 51],
            ['name' => 'LND', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 51],
            ['name' => 'LVD', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 51],
            ['name' => 'LXP', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 51],

            // room_id 52: Ruang G. 01 TCM (Original: GT. Cip-Tim (G. 02))
            ['name' => 'Operator Interface', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 52],
            ['name' => 'VCD', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 52],
            ['name' => 'IOL', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 52],
            ['name' => 'LTS', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 52],
            ['name' => 'LPR', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 52],
            ['name' => 'ALB', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 52],
            ['name' => 'CDP', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 52],
            ['name' => 'Rider', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 52],
            ['name' => 'CCTV Lajur', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 52],
            ['name' => 'CCTV Dalam Gardu', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 52],
            ['name' => 'AC Split', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 52],
            ['name' => 'Ampli', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 52],
            ['name' => 'Radio', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 52],
            ['name' => 'Alat Pendeteksi Uang Palsu', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 52],
            ['name' => 'Spaker', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 52],

            // room_id 53: Ruang G. 02 TCM (Original: GT. Cip-Tim (G. 04))
            ['name' => 'Operator Interface', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'VCD', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'IOL', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'LTS', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'LPR', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'ALB', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'CDP', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'Rider', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'CCTV Lajur', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'CCTV Dalam Gardu', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'AC Split', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'Ampli', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'Radio', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'Spaker', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'Kursi Futura', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'EDC Mandiri', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'Alat Pendeteksi Uang Palsu', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'EDC BCA', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],
            ['name' => 'EDC BRI', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 53],

            // room_id 54: Ruang G. 03 TCM (Original: Kantor GT. Cip-Tim (R. Laktasi))
            ['name' => 'Ac Split', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 54],
            ['name' => 'Shofa', 'quantity' => 1, 'unit' => 'Set', 'condition' => 'Rusak', 'room_id' => 54],
            ['name' => 'Dispenser', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 54],
            ['name' => 'Kulkas 2 Pintu', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 54],
            ['name' => 'Plaza Computer Data Server', 'quantity' => 1, 'unit' => 'Set', 'condition' => 'Baik', 'room_id' => 54],
            ['name' => 'Panel TBB', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 54],
            ['name' => 'UPS Latoll', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 54],
            ['name' => 'PC+Monitor+Mouse+Keyboard', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 54],
            ['name' => 'Panel FO', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 54],
            ['name' => 'Kursi Futura', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 54],
            ['name' => 'Rak Server Kecil', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 54],

            // room_id 55: Ruang G. 04 TCM (Original: Kantor GT. Cip-Tim (R. Server))
            ['name' => 'Ac Split', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 55],
            ['name' => 'Rak Besi Arsip', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 55],
            ['name' => 'Lemari Besi', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 55],
            ['name' => 'Dispenser', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 55],

            // room_id 57: Ruang Server (Original: Kantor GT. Cip-Tim (Lorong))
            ['name' => 'Cermin', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 57],
            ['name' => 'Lemari Besi', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 57],

            // room_id 58: Gudang TCM (Original: Kantor GT. Cip-Tim (R. Spvc))
            ['name' => 'Mading', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 58],
            ['name' => 'Brangkas Kecil', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 58],
            ['name' => 'Ac Split', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 58],
            ['name' => 'Jam Dinding', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 58],
            ['name' => 'Meja Komputer', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 58],
            ['name' => 'Camera CCTV', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 58],
            ['name' => 'PC+Monitor+Mouse+Keyboard', 'quantity' => 5, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 58],

            // room_id 59: Lorong TCM (Original: Kantor GT. Cip-Tim (R. Tu))
            ['name' => 'Leman Kayu', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 59],
            ['name' => 'Ac Split', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 59],
            ['name' => 'Cermin', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 59],
            ['name' => 'Meja Staf', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 59],
            ['name' => 'Kursi Shofa', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 59],
            ['name' => 'Jam Dinding', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 59],
            ['name' => 'Meja Kaca', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 59],

            // room_id 60: Ruang SPVC (Original: Kantor GT. Cip-Tim (R. Dapur))
            ['name' => 'Kitchen set 6 pintu', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 60],
            ['name' => 'Kompor Gas', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 60],
            ['name' => 'Gas 12 Kg', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 60],

            // room_id 61: Ruang TU (Original: Kantor GT. Cip-Tim (Lobby))
            ['name' => 'Sofa', 'quantity' => 1, 'unit' => 'Set', 'condition' => 'Baik', 'room_id' => 61],
            ['name' => 'Meja Laci Komputer', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 61],
            ['name' => 'Komputer Full Set', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 61],
            ['name' => 'Kotak P3K', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 61],
            ['name' => 'Apar', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 61],
            ['name' => 'Figura', 'quantity' => 5, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 61],
            ['name' => 'Telpon Interkom', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 61],
            ['name' => 'Finger Print', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 61],
            ['name' => 'Radio Komunikasi', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 61],
            ['name' => 'Speker', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 61],
            ['name' => 'Absen Finger Print', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 61],

            // room_id 62: Dapur TCM (Original: Kantor GT. Cip-Tim (R. Pelaporan))
            ['name' => 'Mading', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 62],
            ['name' => 'Meja Panjang Pelaporan', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 62],
            ['name' => 'Kursi Panjang Pelaporan', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 62],
            ['name' => 'Kursi Futura', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 62],
            ['name' => 'Meja Komputer', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 62],
            ['name' => 'Jam Dinding', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 62],
            ['name' => 'Printer Terminal Pelaporan CS', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 62],
        
        // GT. Cip-Bar (G. 02) - room_id 63
            ['name' => 'Rider', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 63],
            ['name' => 'CCTV Lajur', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 63],
            ['name' => 'CCTV Dalam Gardu', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 63],
            ['name' => 'AC Split', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 63],
            ['name' => 'Radio', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 63],
            ['name' => 'Ampli', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 63],
            ['name' => 'Alat Pendeteksi Uang Palsu', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 63],
            ['name' => 'Spot Wifi', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 63],
            ['name' => 'Spaker', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 63],
            
            // GT. Cip-Bar (G. 04) - room_id 64
            ['name' => 'Operator Interface', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'VCD', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'IOL', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'LTS', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'LPR', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'ALB', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'CDP', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'Rider', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'CCTV Dalam Gardu', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'AC Split', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'Radio', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'Ampli', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'Spaker', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'Kursi Futura', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'EDC Mandiri', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'Alat Pendeteksi Uang Palsu', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'EDC BNI', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'Spot Wifi', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            
            // GT. Cip-Bar (Tandem) - room_id 64 (Digabung ke G. 04 karena batasan ID)
            ['name' => 'Alat Pendeteksi Uang Palsu (Tandem)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'Operator Interface (Tandem)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'LPR (Tandem)', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            
            // GT. Cip-Bar (CR) - room_id 65
            ['name' => 'AC Split', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 65],
            ['name' => 'Operator Interface', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 65],
            ['name' => 'Komputer CCTV Lajur', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 65],
            ['name' => 'Kursi Kerja', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 65],
            ['name' => 'Speker', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 65],
            ['name' => 'Camera CCTV', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 65],
            ['name' => 'Ampli', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 65],
            
            // Kantor GT. Cip-Bar (Lobby Depan) - room_id 66
            ['name' => 'Meja Satpam', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 66],
            ['name' => 'Kursi', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 66],
            ['name' => 'Radio Komunikasi', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'TV', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 66],
            ['name' => 'Kipas Angin', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Apar', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            
            // Kantor GT. Cip-Bar (Lobby) - room_id 66 (Digabung ke Lobby Depan karena batasan ID)
            ['name' => 'Sofa', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 66],
            ['name' => 'White Board', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Jam Dinding', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 66],
            ['name' => 'Dispenser', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Kotak P3K', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Cermin', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            
            // Kantor GT. Cip-Bar (R. Spvc) - room_id 66 (Digabung ke Lobby Depan karena batasan ID)
            ['name' => 'Kursi Kerja (R. Spvc)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Meja Kerja (R. Spvc)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Meja Komputer (R. Spvc)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'PC+Monitor+Mouse+Keyboard (R. Spvc)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Ac Split (R. Spvc)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'CCTV (R. Spvc)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Rak EDC (R. Spvc)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'EDC BNI (R. Spvc)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'EDC BCA (R. Spvc)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 66],

            // Kantor GT. Cip-Bar (R. Dapur) - room_id 66 (Digabung ke Lobby Depan karena batasan ID)
            ['name' => 'Kitchen Shel 4 Pintu (Dapur)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Gas 12 Kg (Dapur)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Tong Sampah (Dapur)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Rak Piring (Dapur)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],

            // Kantor GT. Cip-Bar (R. Istirahat) - room_id 66 (Digabung ke Lobby Depan karena batasan ID)
            ['name' => 'Kasur (R. Istirahat)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Ac Split (R. Istirahat)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 66],
        
// GT. Cip-Bar (G. 02) - room_id 63
            ['name' => 'Rider', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 63],
            ['name' => 'CCTV Lajur', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 63],
            ['name' => 'CCTV Dalam Gardu', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 63],
            ['name' => 'AC Split', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 63],
            ['name' => 'Radio', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 63],
            ['name' => 'Ampli', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 63],
            ['name' => 'Alat Pendeteksi Uang Palsu', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 63],
            ['name' => 'Spot Wifi', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 63],
            ['name' => 'Spaker', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 63],
            
            // GT. Cip-Bar (G. 04) - room_id 64
            ['name' => 'Operator Interface', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'VCD', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'IOL', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'LTS', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'LPR', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'ALB', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'CDP', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'Rider', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'CCTV Dalam Gardu', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'AC Split', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'Radio', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'Ampli', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'Spaker', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'Kursi Futura', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'EDC Mandiri', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'Alat Pendeteksi Uang Palsu', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'EDC BNI', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'Spot Wifi', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            // GT. Cip-Bar (Tandem) digabungkan ke G. 04 (64)
            ['name' => 'Alat Pendeteksi Uang Palsu (Tandem)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'Operator Interface (Tandem)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],
            ['name' => 'LPR (Tandem)', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 64],

            // GT. Cip-Bar (CR) - room_id 65
            ['name' => 'AC Split (CR Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 65],
            ['name' => 'Operator Interface (CR Cip-Bar)', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 65],
            ['name' => 'Komputer CCTV Lajur (CR Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 65],
            ['name' => 'Kursi Kerja (CR Cip-Bar)', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 65],
            ['name' => 'Speker (CR Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 65],
            ['name' => 'Camera CCTV (CR Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 65],
            ['name' => 'Ampli (CR Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 65],

            // Kantor GT. Cip-Bar (Lobby Depan, Lobby, R. Spvc, R. Dapur, R. Istirahat) - room_id 66
            ['name' => 'Meja Satpam', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 66],
            ['name' => 'Kursi', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Rusak', 'room_id' => 66],
            ['name' => 'Radio Komunikasi', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'TV', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 66],
            ['name' => 'Kipas Angin', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Apar', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Sofa (Lobby Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 66],
            ['name' => 'White Board', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Jam Dinding (Lobby Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 66],
            ['name' => 'Dispenser (Lobby Cip-Bar)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Kotak P3K (Lobby Cip-Bar)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Cermin (Lobby Cip-Bar)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Kursi Kerja (R. Spvc Cip-Bar)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Meja Kerja (R. Spvc Cip-Bar)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'PC+Monitor+Mouse+Keyboard (R. Spvc Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Ac Split (R. Spvc Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'CCTV (R. Spvc Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Rak EDC (R. Spvc Cip-Bar)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Kitchen Shel 4 Pintu (Dapur Cip-Bar)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Kasur (R. Istirahat Cip-Bar)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 66],
            ['name' => 'Ac Split (R. Istirahat Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 66],


            // --- DISTRIBUTED ROOM IDs (33: Gudang ATK TCM, 39: Gudang TCM Palimanan-Kanci) ---
            
            // GT. Cip-Bar (G. 01) - DIALIHKAN KE GUDANG ATK TCM (33)
            ['name' => 'GTO Entrance (G. 01 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'CCTV Lajur (G. 01 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'Vms (G. 01 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'Apar (G. 01 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'LLA (G. 01 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'ALB (G. 01 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'OBS (G. 01 Cip-Bar)', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'LND (G. 01 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'LVD (G. 01 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'LXD (G. 01 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],

            // GT. Cip-Bar (G. 03) - DIALIHKAN KE GUDANG TCM (39)
            ['name' => 'GTO Entrance (G. 03 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'CCTV Lajur (G. 03 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'Vms (G. 03 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'Apar (G. 03 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'ALB (G. 03 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'OBS (G. 03 Cip-Bar)', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'CDP (G. 03 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'LVD (G. 03 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'LXD (G. 03 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'LND (G. 03 Cip-Bar)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],

            // GT. Kanci (CR) - DIALIHKAN KE GUDANG ATK TCM (33)
            ['name' => 'AC Split (CR Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'Operator Interface (CR Kanci)', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'Komputer CCTV Lajur (CR Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'Kursi Kerja (CR Kanci)', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'Speker (CR Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'Camera CCTV (CR Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'Ampli (CR Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],
            ['name' => 'Meja Komputer (CR Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 33],

            // GT. Kanci (G. 01, G. 02, G. 04, G. 06, G. 08, G. 10) - DIALIHKAN KE GUDANG TCM (39)
            // G. 01
            ['name' => 'GTO Entrance Multi (G. 01 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'CCTV Lajur (G. 01 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'Vms (G. 01 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            // G. 02
            ['name' => 'LTS (G. 02 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'LPR (G. 02 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'ALB (G. 02 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'CDP (G. 02 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'Rider (G. 02 Kanci)', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'Radio (G. 02 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 39],
            ['name' => 'Ampli (G. 02 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'Spaker (G. 02 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            // G. 04
            ['name' => 'Operator Interface (G. 04 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'VCD (G. 04 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'IOL (G. 04 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'LTS (G. 04 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'LPR (G. 04 Kanci)', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'ALB (G. 04 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'Radio (G. 04 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'Ampli (G. 04 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            // G. 06
            ['name' => 'Operator Interface (G. 06 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'VCD (G. 06 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'IOL (G. 06 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'LTS (G. 06 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'LPR (G. 06 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'ALB (G. 06 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'CDP (G. 06 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'CCTV Lajur (G. 06 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            // G. 08
            ['name' => 'VCD (G. 08 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'IOL (G. 08 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'LTS (G. 08 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'Rider (G. 08 Kanci)', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'CCTV Dalam Gardu (G. 08 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'Radio (G. 08 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 39],
            ['name' => 'Ampli (G. 08 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 39],
            ['name' => 'Alat Pendeteksi Uang Palsu (G. 08 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'Kursi Futura (G. 08 Kanci)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 39],
            // G. 10
            ['name' => 'Operator Interface (G. 10 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'VCD (G. 10 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'IOL (G. 10 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'LTS (G. 10 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'Radio (G. 10 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Rusak', 'room_id' => 39],
            ['name' => 'Kursi Berputar (G. 10 Kanci)', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'EDC Mandiri (G. 10 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'EDC BCA (G. 10 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],
            ['name' => 'EDC BRI (G. 10 Kanci)', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik', 'room_id' => 39],

        ];


        // [PENCEGAHAN DUPLIKASI]
        // Hapus semua data aset baru yang mungkin sudah pernah di-seed sebelumnya.
        DB::table('assets')
            ->where('unit_id', $unitId) // Hapus hanya di unit 4
            ->where('id', '>=', $startId)
            ->whereIn('room_id', array_unique(array_column($allAssetsData, 'room_id'))) // Hapus di room_id yang digunakan (32, 33, 34, 39, 49, dst)
            ->delete();

        $finalData = [];

        foreach ($allAssetsData as $data) {
            $assetCode = 'ASET-' . str_pad($currentId, 3, '0', STR_PAD_LEFT) . '-' . $data['room_id'];

            $finalData[] = [
                'id' => $currentId,
                'unit_id' => $unitId,
                'room_id' => $data['room_id'],
                'code' => $assetCode,
                'name' => $data['name'],
                'quantity' => $data['quantity'],
                'unit' => $data['unit'],
                'condition' => $data['condition'],
                'acquired_year' => 2025, // Tahun perolehan saya set 2025, bisa diubah jika ada data
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ];
            $currentId++;
        }

        DB::table('assets')->insert($finalData);

        $this->command->info('New Assets JMTO (ID ' . $startId . ' sampai ' . ($currentId - 1) . ') - Total ' . count($finalData) . ' aset berhasil ditambahkan ke database.');
    }
}
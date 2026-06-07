<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Units\Unit;
use App\Domains\Rooms\Room;


class RoomsSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [

            // ==================== RO2 ====================
            'RO2' => [
                'Ruang Staf BS',
                'Ruang Staf TCMS',
                'Ruang BS Dept Head',
                'Ruang TCMS Dept Head',
                'Ruang BSS',
                'Mushola BS',
                'Ruang Asset Specialist',
                'Lobby Asset',
                'Ruang OMS',
                'Ruang SKJM',
                'Lobby Kantor Bawah',
                'Aula',
                'Ruang Arsip',
                'Dapur',
                'Ruang Rapat Utama',
                'Ruang Senior Manager',
                'Ruang Sekretaris SM',
                'Ruang Server',
                'Ruang Istirahat Lantai 2',
                'Lorong Lantai 2',
                'Lorong Lantai 1',
                'Gudang Dapur',
                'Gudang Logistik',
                'Pos Security',
            ],

            // ==================== JMRB ====================
            'JMRB' => [
                'Ruang JMRB',
            ],

            // ==================== JMTM ====================
            'JMTM' => [
                'Ruang Lainnya',
                'Ruang DCA',
                'Ruang Staf Administrasi',
                'Ruang CA',
                'Ruang Staf Execution',
                'Ruang Rapat JMTM',
            ],

            // ==================== JMTO ====================
            'JMTO' => [
                'Ruang TMM',
                'Gudang TM',
                'Ruang Staf TM',
                'Senkom',
                'Ruang 210',
                'Ruang Tamu Mako',
                'Lorong Bawah Utama',
                'Gudang TM',
                'Ruang Pelaporan LJT',
                'Ruang Atas',
                'Mushola TM',
                'Dapur TM',
                'Ruang Medis',
                'Ruang Depan',
                'Ruang Rapat',
                'Ruang Area Manager',
                'Ruang TCMM',
                'Ruang Staf TCM',
                'Gudang ATK TCM',
                'Ruang CR TCM',
                'Ruang G. 01 TCM',
                'Ruang G. 02 TCM',
                'Ruang G. 03 TCM',
                'Ruang G. 04 TCM',
                'Ruang Laktasi',
                'Ruang Server',
                'Gudang TCM',
                'Lorong TCM',
                'Ruang SPVC',
                'Ruang TU',
                'Dapur TCM',
                'Lobby TCM',
                'Ruang Pelaporan',
                'Ruang Loker',
                'Ruang CR',
            ],
        ];

        foreach ($rooms as $unitName => $roomList) {
            $unit = Unit::where('name', $unitName)->first();

            foreach ($roomList as $roomName) {
                Room::create([
                    'unit_id' => $unit->id,
                    'name'    => $roomName,
                ]);
            }
        }
    }
}

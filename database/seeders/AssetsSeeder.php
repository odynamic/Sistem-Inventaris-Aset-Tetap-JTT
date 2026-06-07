<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AssetsSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Data aset Anda disederhanakan menjadi array utama
        $assetsData = [
            ['id'=>1,'room_id'=>27,'name'=>'Proyektor LG','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>2,'room_id'=>27,'name'=>'Paper Shredder (Penghancur Kertas) Krisbow','quantity'=>1,'unit'=>'Buah','condition'=>'Rusak'],
            ['id'=>3,'room_id'=>27,'name'=>'Proyektor Epson','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>4,'room_id'=>27,'name'=>'HDD My Passport WD','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>5,'room_id'=>27,'name'=>'Scanner Brother','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>6,'room_id'=>27,'name'=>'Lemari Arsip Brother','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>7,'room_id'=>27,'name'=>'Strobo Rotator LED','quantity'=>5,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>8,'room_id'=>27,'name'=>'Rak Arsip Besi','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>9,'room_id'=>27,'name'=>'Rak Arsip Besi','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>10,'room_id'=>27,'name'=>'Connect Conference Cam Video Logitech','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>11,'room_id'=>27,'name'=>'Strobo Patwal LED 450D Quadrilateral Strobe Light / Rotator','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>12,'room_id'=>27,'name'=>'Dash Cam 1S 70mai dash as1080P1"30 night vision','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>13,'room_id'=>27,'name'=>'Lampu Strobo LED Cob 12 "8" untuk atap mobil/truk','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>14,'room_id'=>27,'name'=>'Lampu Crystal dan Kabel','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>15,'room_id'=>27,'name'=>'Drone DJI Air 2s fly combo (EU)','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>16,'room_id'=>27,'name'=>'HP Real Mi','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>17,'room_id'=>27,'name'=>'Brankas','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            
            ['id'=>18,'room_id'=>28,'name'=>'AC Split Panasonic','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>19,'room_id'=>28,'name'=>'Kursi Hada Multi Purpose','quantity'=>2,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>20,'room_id'=>28,'name'=>'Kursi Direksi LC-H Ichiko','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>21,'room_id'=>28,'name'=>'White Board Kecil','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>22,'room_id'=>28,'name'=>'Soft Board','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>23,'room_id'=>28,'name'=>'Tempat Sampah Komet Star','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>24,'room_id'=>28,'name'=>'Lemari Arsip Besar','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>25,'room_id'=>28,'name'=>'Meja Kerja L (Manager)','quantity'=>1,'unit'=>'Set','condition'=>'Baik'],
            ['id'=>26,'room_id'=>28,'name'=>'Vertical Blend','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>27,'room_id'=>28,'name'=>'Speaker','quantity'=>1,'unit'=>'Pasang','condition'=>'Baik'],
            ['id'=>28,'room_id'=>28,'name'=>'Laptop Asus','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            
            ['id'=>29,'room_id'=>29,'name'=>'AC Split Panasonic','quantity'=>2,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>30,'room_id'=>29,'name'=>'Jam Dinding Seiko','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>31,'room_id'=>29,'name'=>'Speaker','quantity'=>2,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>32,'room_id'=>29,'name'=>'Filing Kabinet','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>33,'room_id'=>29,'name'=>'Kursi Manager (lengan berputar) Savello','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>34,'room_id'=>29,'name'=>'Kursi Manager (lengan berputar) Savello','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>35,'room_id'=>29,'name'=>'Meja Kerja L','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>36,'room_id'=>29,'name'=>'Meja kerja kayu Aztec','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>37,'room_id'=>29,'name'=>'Cabinet / Meja Printer','quantity'=>3,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>38,'room_id'=>29,'name'=>'Meja Kerja Staff (kaca)','quantity'=>2,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>39,'room_id'=>29,'name'=>'Lemari Arsip Kaca','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>40,'room_id'=>29,'name'=>'Gradenza (Lemari Bersusun)','quantity'=>1,'unit'=>'Set','condition'=>'Baik'],

            ['id'=>41,'room_id'=>29,'name'=>'Tempat sampah (biru)','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>42,'room_id'=>29,'name'=>'Tempat sampah (abu-abu)','quantity'=>2,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>43,'room_id'=>29,'name'=>'Laptop Asus','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>44,'room_id'=>29,'name'=>'Laptop Asus','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>45,'room_id'=>29,'name'=>'Laptop Asus','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>46,'room_id'=>29,'name'=>'Laptop Asus','quantity'=>1,'unit'=>'Unit','condition'=>'Rusak'],
            ['id'=>47,'room_id'=>29,'name'=>'Laptop Asus','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>48,'room_id'=>29,'name'=>'Laptop Asus','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>49,'room_id'=>29,'name'=>'Printer Epson','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>50,'room_id'=>29,'name'=>'Printer Epson','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>51,'room_id'=>29,'name'=>'PC HP','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>52,'room_id'=>29,'name'=>'PC HP','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>53,'room_id'=>29,'name'=>'PC HP','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>54,'room_id'=>29,'name'=>'Laptop','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>55,'room_id'=>29,'name'=>'AC Panasonic','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>56,'room_id'=>29,'name'=>'AC Panasonic','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            
            ['id'=>57,'room_id'=>30,'name'=>'Meja panjang rapat kayu','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>58,'room_id'=>30,'name'=>'Meja panjang rapat kaca','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>59,'room_id'=>30,'name'=>'Meja 1/2 Biro rekondisi','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>60,'room_id'=>30,'name'=>'Kursi hadap (hitam)','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>61,'room_id'=>30,'name'=>'Vertical blend','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>62,'room_id'=>30,'name'=>'Tempat sampah Lion Star','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>63,'room_id'=>30,'name'=>'Wastafel','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>64,'room_id'=>30,'name'=>'Kursi Rapat Chitose','quantity'=>8,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>65,'room_id'=>30,'name'=>'AC Panasonic','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>66,'room_id'=>30,'name'=>'Stop Kontak Meja','quantity'=>3,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>67,'room_id'=>30,'name'=>'Kabel HDMI Rapat','quantity'=>2,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>68,'room_id'=>30,'name'=>'Speaker Meeting Wall Mounted','quantity'=>2,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>69,'room_id'=>30,'name'=>'TV Meeting Display Samsung 55 inch','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>70,'room_id'=>30,'name'=>'Remote TV Samsung','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            
            ['id'=>71,'room_id'=>29,'name'=>'UPS APC 650VA','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>72,'room_id'=>29,'name'=>'UPS ICA 1200VA','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>73,'room_id'=>29,'name'=>'Mouse Logitech','quantity'=>5,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>74,'room_id'=>29,'name'=>'Keyboard Logitech','quantity'=>4,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>75,'room_id'=>29,'name'=>'Monitor Samsung 24 inch','quantity'=>3,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>76,'room_id'=>29,'name'=>'Kursi Staff Chitose','quantity'=>6,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>77,'room_id'=>29,'name'=>'Meja Staff Minimalis','quantity'=>6,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>78,'room_id'=>29,'name'=>'Filing Cabinet Steel','quantity'=>2,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>79,'room_id'=>29,'name'=>'Lemari Besi 2 Pintu','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>80,'room_id'=>29,'name'=>'Tempat Arsip Plastik','quantity'=>5,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>81,'room_id'=>29,'name'=>'MiFi Telkomsel Orbit','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>82,'room_id'=>29,'name'=>'Router TP-Link','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>83,'room_id'=>29,'name'=>'Kipas Angin Sekai','quantity'=>2,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>84,'room_id'=>29,'name'=>'Dispenser Miyako','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>85,'room_id'=>29,'name'=>'Gelas Pantry','quantity'=>12,'unit'=>'Buah','condition'=>'Baik'],
            
            ['id'=>86,'room_id'=>30,'name'=>'Pointer Presenter Logitech','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>87,'room_id'=>30,'name'=>'Mic Wireless Meeting','quantity'=>2,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>88,'room_id'=>30,'name'=>'Meja Assesoris Samping','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>89,'room_id'=>30,'name'=>'Tempat Tisu Meja','quantity'=>2,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>90,'room_id'=>30,'name'=>'Rak Display Rapat','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>91,'room_id'=>30,'name'=>'Bunga Meja Dekorasi','quantity'=>2,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>92,'room_id'=>30,'name'=>'Jam Dinding Quartz','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>93,'room_id'=>30,'name'=>'Papan Agenda Meeting','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>94,'room_id'=>30,'name'=>'AC Panasonic','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>95,'room_id'=>30,'name'=>'Kabel LAN 10 Meter','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            
            ['id'=>96,'room_id'=>29,'name'=>'Extention Cord 4 Slot','quantity'=>4,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>97,'room_id'=>29,'name'=>'Kabel Power PC','quantity'=>6,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>98,'room_id'=>29,'name'=>'Adaptor Laptop Universal','quantity'=>2,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>99,'room_id'=>29,'name'=>'CCTV Indoor Hikvision','quantity'=>3,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>100,'room_id'=>29,'name'=>'CCTV Outdoor Hikvision','quantity'=>2,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>101,'room_id'=>29,'name'=>'Harddisk Eksternal Seagate 1TB','quantity'=>1,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>102,'room_id'=>29,'name'=>'Flashdisk Sandisk 32GB','quantity'=>10,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>103,'room_id'=>29,'name'=>'Kabel USB Printer','quantity'=>2,'unit'=>'Buah','condition'=>'Baik'],
            ['id'=>104,'room_id'=>29,'name'=>'Webcam Logitech C270','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            ['id'=>105,'room_id'=>29,'name'=>'Tripod Kamera','quantity'=>1,'unit'=>'Unit','condition'=>'Baik'],
            
            ['id'=>106,'room_id'=>30,'name'=>'Kursi Rapat Kulit Tambahan', 'quantity' => 4, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['id'=>107,'room_id'=>30,'name'=>'Lampu Sorot Rapat', 'quantity' => 2, 'unit' => 'Unit', 'condition' => 'Baik'],
            ['id'=>108,'room_id'=>30,'name'=>'Mini Vacuum Cleaner', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['id'=>109,'room_id'=>30,'name'=>'Stop Kontak Dinding', 'quantity' => 3, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['id'=>110,'room_id'=>30,'name'=>'Air Purifier Sharp', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik'],
            ['id'=>111,'room_id'=>29,'name'=>'Tempat Kabel Roll', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['id'=>112,'room_id'=>29,'name'=>'Gunting Besar', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['id'=>113,'room_id'=>29,'name'=>'Staples Besar MAX', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['id'=>114,'room_id'=>29,'name'=>'Penggaris Besi 60cm', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['id'=>115,'room_id'=>29,'name'=>'Mesin Laminating', 'quantity' => 1, 'unit' => 'Unit', 'condition' => 'Baik'],
            ['id'=>116,'room_id'=>30,'name'=>'Remote AC Panasonic', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['id'=>117,'room_id'=>30,'name'=>'Penghapus Whiteboard', 'quantity' => 2, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['id'=>118,'room_id'=>30,'name'=>'Spidol Boardmarker Snowman', 'quantity' => 6, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['id'=>119,'room_id'=>30,'name'=>'Kabel Power TV', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik'],
            ['id'=>120,'room_id'=>30,'name'=>'Kotak P3K', 'quantity' => 1, 'unit' => 'Buah', 'condition' => 'Baik'],
        ];
        
        $finalData = [];
        
        foreach ($assetsData as $data) {
            // PENTING: Menambahkan kolom 'code' di sini
            $assetCode = 'ASET-' . str_pad($data['id'], 3, '0', STR_PAD_LEFT) . '-25';
            
            $finalData[] = [
                'id' => $data['id'],
                'unit_id' => 3, // Menggunakan unit_id 3 yang konsisten
                'room_id' => $data['room_id'],
                'code' => $assetCode, // Kolom yang hilang ditambahkan
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
    }
}
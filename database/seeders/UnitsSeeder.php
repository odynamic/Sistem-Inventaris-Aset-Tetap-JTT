<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Units\Unit;

class UnitsSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            [
                'name' => 'RO2',
                'full_name' => 'Representative Office 2',
            ],
            [
                'name' => 'JMRB',
                'full_name' => 'Jasamarga Related Business',
            ],
            [
                'name' => 'JMTM',
                'full_name' => 'Jasamarga Tollroad Maintenance',
            ],
            [
                'name' => 'JMTO',
                'full_name' => 'Jasamarga Tollroad Operator',
            ],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}

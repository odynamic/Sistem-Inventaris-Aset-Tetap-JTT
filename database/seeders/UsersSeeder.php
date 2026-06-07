<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Units\Unit;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // ------------------------
        // Admin
        // ------------------------
        User::create([
            'name' => 'PJ Aset Palikanci',
            'email' => 'asetpalikanci@jasamarga.co.id',
            'password' => Hash::make('palikanci'),
            'role' => 'admin',
            'unit_id' => null,
        ]);

        // ------------------------
        // Users per Unit
        // ------------------------
        $users = [
            [
                'name' => 'Representative Office 2',
                'email' => 'ro2palikanci@jasamarga.co.id',
                'unit' => 'RO2',
            ],
            [
                'name' => 'Jasamarga Related Business',
                'email' => 'jmrbpalikanci@jasamarga.co.id',
                'unit' => 'JMRB',
            ],
            [
                'name' => 'Jasamarga Tollroad Maintenance',
                'email' => 'jmtmpalikanci@jasamarga.co.id',
                'unit' => 'JMTM',
            ],
            [
                'name' => 'Jasamarga Tollroad Operator',
                'email' => 'jmtopalikanci@jasamarga.co.id',
                'unit' => 'JMTO',
            ],
        ];

        foreach ($users as $u) {
            User::create([
                'name' => $u['name'],
                'email' => $u['email'],
                'password' => Hash::make('palikanci'),
                'role' => 'user',
                'unit_id' => Unit::where('name', $u['unit'])->first()->id,
            ]);
        }
    }
}

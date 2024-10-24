<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Pusat',
                'ktp' => 12345678912345,
                'password' => Hash::make('aaaaa'),
                'phone_number' => 123456789,
                'is_admin' => 1
            ],

            [
                'name' => 'Admin Provinsi',
                'ktp' => 12345678954321,
                'password' => Hash::make('aaaaa'),
                'phone_number' => 123456789,
                'is_admin' => 2
            ],

            [
                'name' => 'Admin Kabupaten',
                'ktp' => 1234567896789,
                'password' => Hash::make('aaaaa'),
                'phone_number' => 123456789,
                'is_admin' => 3
            ]
        ]);
        
        DB::table('dummy')->insert([
            [
                'name' => 'Dummy 1',
            ],

            [
                'name' => 'Dummy 2',
            ],

            [
                'name' => 'Dummy 3',
            ],

            [
                'name' => 'Dummy 4',
            ],

            [
                'name' => 'Dummy 5',
            ],
        ]);

        DB::table('provinsi')->insert([
            [
                'name' => 'Provinsi A',
            ],

            [
                'name' => 'Provinsi B',
            ],

            [
                'name' => 'Provinsi C',
            ],

        ]);
        
        DB::table('kabupaten')->insert([
            [
                'name' => 'Kabupaten A',
                'provinsi_id' => 1,
            ],
            [
                'name' => 'Kabupaten B',
                'provinsi_id' => 2,
            ],
            [
                'name' => 'Kabupaten C',
                'provinsi_id' => 3,
            ],
        ]);
        
        DB::table('kecamatan')->insert([
            [
                'name' => 'Kecamatan A',
                'kabupaten_id' => 1,
            ],
            [
                'name' => 'Kecamatan B',
                'kabupaten_id' => 2,
            ],
            [
                'name' => 'Kecamatan C',
                'kabupaten_id' => 3,
            ],
        ]);
        
        DB::table('kelurahan')->insert([
            [
                'name' => 'Kelurahan A',
                'kecamatan_id' => 1,
            ],
            [
                'name' => 'Kelurahan B',
                'kecamatan_id' => 2,
            ],
            [
                'name' => 'Kelurahan C',
                'kecamatan_id' => 3,
            ],
        ]);
    }
}

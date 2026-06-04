<?php

namespace Database\Seeders;

use App\Models\StudentLocation;
use Illuminate\Database\Seeder;

class StudentLocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Daruba',
                'latitude' => 1.9234,
                'longitude' => 128.3512,
                'description' => 'Kelurahan Daruba - 68 siswa',
            ],
            [
                'name' => 'Somber',
                'latitude' => 1.8765,
                'longitude' => 128.3892,
                'description' => 'Kelurahan Somber - 52 siswa',
            ],
            [
                'name' => 'Morotai',
                'latitude' => 1.8845,
                'longitude' => 128.3649,
                'description' => 'Kelurahan Morotai - 145 siswa (Lokasi Sekolah)',
            ],
            [
                'name' => 'Jailolo',
                'latitude' => 1.8234,
                'longitude' => 128.2987,
                'description' => 'Kelurahan Jailolo - 89 siswa',
            ],
            [
                'name' => 'Tarakan',
                'latitude' => 3.2957,
                'longitude' => 117.5619,
                'description' => 'Tarakan - 23 siswa (Lintas Provinsi)',
            ],
            [
                'name' => 'Tidore',
                'latitude' => 0.6755,
                'longitude' => 127.4050,
                'description' => 'Tidore - 15 siswa (Lintas Provinsi)',
            ],
        ];

        foreach ($locations as $location) {
            StudentLocation::create($location);
        }
    }
}

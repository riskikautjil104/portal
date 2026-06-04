<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        Announcement::create([
            'user_id' => 1,
            'title' => 'Selamat Datang di Portal SMA Negeri 5 Morotai',
            'content' => 'Portal sekolah telah resmi diluncurkan untuk memudahkan akses informasi bagi siswa, orang tua, dan masyarakat.',
            'category' => 'umum',
            'status' => 'published',
            'published_at' => now(),
            'image' => null,
        ]);

        Announcement::create([
            'user_id' => 1,
            'title' => 'Update Peta Sebaran Siswa',
            'content' => 'Data peta sebaran siswa terbaru berhasil ditambahkan ke sistem, menampilkan lokasi siswa berdasarkan kecamatan.',
            'category' => 'kegiatan',
            'status' => 'published',
            'published_at' => now(),
            'image' => null,
        ]);
    }
}

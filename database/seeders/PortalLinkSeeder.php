<?php

namespace Database\Seeders;

use App\Models\PortalLink;
use Illuminate\Database\Seeder;

class PortalLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            [
                'name' => 'SIMORO',
                'url' => 'https://simoro.sman5morotai.sch.id',
                'description' => 'Sistem Informasi Manajemen Sekolah',
                'icon' => '📚',
                'order' => 1,
                'active' => true,
            ],
            [
                'name' => 'LMS',
                'url' => 'https://lms.sman5morotai.sch.id',
                'description' => 'Learning Management System',
                'icon' => '🎓',
                'order' => 2,
                'active' => true,
            ],
            [
                'name' => 'Absensi',
                'url' => 'https://absensi.sman5morotai.sch.id',
                'description' => 'Sistem Absensi Online',
                'icon' => '✓',
                'order' => 3,
                'active' => true,
            ],
            [
                'name' => 'Website OSIS',
                'url' => 'https://osis.sman5morotai.sch.id',
                'description' => 'Website Organisasi Siswa Intra Sekolah',
                'icon' => '🎪',
                'order' => 4,
                'active' => true,
            ],
        ];

        foreach ($links as $link) {
            PortalLink::create($link);
        }
    }
}

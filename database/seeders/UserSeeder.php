<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin SMA',
            'email' => 'admin@sman5morotai.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Humas SMA',
            'email' => 'humas@sman5morotai.sch.id',
            'password' => bcrypt('password'),
            'role' => 'humas',
        ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\jawaban;
use App\Models\materi;
use App\Models\modul;
use App\Models\Prodi;
use App\Models\question;
use App\Models\quiz;
use App\Models\User;
use DateTime;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Prodi::create([
            'name' => 'Teknik Informatika',
        ]);

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => 'admin',
            'prodiId' => 1,
            'role' => 2
        ]);

        User::create([
            'name' => 'Alvin',
            'username' => 'alvin',
            'password' => 'alvin',
            'prodiId' => 1,
            'role' => 2
        ]);




    }
}

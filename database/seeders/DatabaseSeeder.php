<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\materi;
use App\Models\modul;
use App\Models\User;
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

        User::create([
            'name' => 'Alvin Syahri',
            'username' => 'alvin_21',
            'password' => 'alvin111',
            'role' => 2
        ]);

        Category::create([
            'name' => 'Teknik Informatika',
        ]);

        modul::create([
            'name' => 'GIS',
            'image' => 'image-modul/alvinsyahri.jpg',
            'deskripsi' => 'aspasodnasodnisandkanskdnaksdknaksndkasda',
            'categoryId' => 1,
            'userId' => 1
        ]);

        materi::create([
            'title' => 'apa aja',
            'content' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
            <p>asdasdasdasdawdadsawdsadwdsawdawdsadw</p>
            ',
            'modulId' => 1
        ]);
    }
}

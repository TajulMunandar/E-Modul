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


        modul::create([
            'name' => 'GIS',
            'image' => 'image-modul/alvinsyahri.jpg',
            'deskripsi' => 'aspasodnasodnisandkanskdnaksdknaksndkasda',
            'prodiId' => 1,
            'userId' => 1
        ]);

        materi::create([
            'title' => 'apa aja',
            'content' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
            <p>asdasdasdasdawdadsawdsadwdsawdawdsadw</p>
            ',
            'modulId' => 1
        ]);

        quiz::create([
            'title' => 'Apa',
            'firstTime' => new DateTime(),
            'lastTime' => new DateTime(),
            'isChoice' => true,
            'modulId' => 1
        ]);

        quiz::create([
            'title' => 'Siapa',
            'firstTime' => new DateTime(),
            'lastTime' => new DateTime(),
            'isChoice' => false,
            'modulId' => 1
        ]);

        question::create([
            'title' => "a1",
            'quizId' => 1
        ]);

        question::create([
            'title' => "1a",
            'quizId' => 1
        ]);

        question::create([
            'title' => "b",
            'quizId' => 2
        ]);
        question::create([
            'title' => "1",
            'quizId' => 2
        ]);
        question::create([
            'title' => "G",
            'quizId' => 2
        ]);

        jawaban::create([
            'name'=> '1',
            'status' => 0,
            'questionId' => 1
        ]);

        jawaban::create([
            'name'=> '2',
            'status' => 0,
            'questionId' => 1
        ]);

        jawaban::create([
            'name'=> 'a1',
            'status' => 1,
            'questionId' => 1
        ]);

        jawaban::create([
            'name'=> '3',
            'status' => 0,
            'questionId' => 1
        ]);

        jawaban::create([
            'name'=> 'b',
            'status' => 0,
            'questionId' => 2
        ]);

        jawaban::create([
            'name'=> 'c',
            'status' => 0,
            'questionId' => 2
        ]);

        jawaban::create([
            'name'=> 'a',
            'status' => 0,
            'questionId' => 2
        ]);

        jawaban::create([
            'name'=> '1a',
            'status' => 1,
            'questionId' => 2
        ]);

    }
}

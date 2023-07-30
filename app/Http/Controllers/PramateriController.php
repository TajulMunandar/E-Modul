<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\quiz;
use App\Models\modul;
use App\Models\materi;
use App\Models\question;
use Illuminate\Http\Request;

class PramateriController extends Controller
{
    public function showPramateri(modul $modul)
    {
        $moduls = $modul->user;
        $pramateris = $modul->materi;

        return view('main.page.pramateri')->with(compact('modul', 'pramateris', 'moduls'));
    }

    public function showQuiz(modul $modul)
    {
        $quizzes = $modul->quizz;
        $firstQuiz = $quizzes->first();
        $firstTime =  Carbon::parse($firstQuiz->firstTime)->format('H:i');
        $lastTime =  Carbon::parse($firstQuiz->lastTime)->format('H:i');
        $date =  Carbon::parse($firstQuiz->created_at)->format('d F Y');

        return view('main.page.praquiz')->with(compact('modul', 'quizzes', 'firstTime', 'lastTime', 'date'));
    }

    public function showmateri(materi $materi)
    {
        $materis = $materi->modul->user;
        $navmateris = materi::with('modul')->where('modulId', $materi->modulId)->get();
        $footmateris = materi::with('modul')->where('modulId', $materi->modulId)->get();

        // Mengurutkan $footmateris berdasarkan id (misalnya dari yang terkecil)
        $footermateris = $footmateris->sortBy('id')->values();

        // Mengambil indeks dari $materi dalam $footmateris
        $currentMateriIndex = $footermateris->search(function ($item) use ($materi) {
            return $item->id === $materi->id;
        });

        // Mengambil data materi sebelumnya (jika ada)
        $previousMateri = null;
        if ($currentMateriIndex > 0) {
            $previousMateri = $footermateris[$currentMateriIndex - 1];
        }

        // Mengambil data materi sesudahnya (jika ada)
        $nextMateri = null;
        if ($currentMateriIndex < $footermateris->count() - 1) {
            $nextMateri = $footermateris[$currentMateriIndex + 1];
        }
        $tanggal = Carbon::parse($materi->created_at)->format('d F Y');

        return view('main.page.materi')->with(compact('materi', 'materis', 'tanggal', 'navmateris', 'previousMateri', 'nextMateri'));
    }

    public function showquizez(string $id)
    {
        $questions = question::where('quizId', $id)->with('jawabans')->latest()->get();
        $quiz = quiz::find($id);
        $tanggal = Carbon::parse($quiz->created_at)->format('d F Y');

        return view('main.page.quiz')->with(compact('questions', 'quiz', 'tanggal'));
    }
}

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
        $pramateris = $modul->materi;

        return view('main.page.pramateri')->with(compact('modul', 'pramateris'));
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
        $tanggal = Carbon::parse($materi->created_at)->format('d F Y');

        return view('main.page.materi')->with(compact('materi', 'materis', 'tanggal'));
    }

    public function showquizez(quiz $quiz)
    {
        $quizzId = request('quiz:id'); // Ambil nilai 'quizzId' dari query string
        $questions = question::where('quizId', $quizzId)->with('jawabans')->latest()->get();
        $tanggal = Carbon::parse($quiz->created_at)->format('d F Y');

        return view('main.page.quiz')->with(compact('quiz', 'quizzId', 'questions', 'tanggal'));
    }
}

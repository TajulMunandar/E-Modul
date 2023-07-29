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

        $moduls = $modul->users;
        $pramateris = $modul->materis;

        return view('main.page.pramateri')->with(compact('modul', 'pramateris', 'moduls'));
    }

    public function showQuiz(modul $modul)
    {
        $quizzes = $modul->quizzes;
        $firstQuiz = $quizzes->first();
        $firstTime =  Carbon::parse($firstQuiz->firstTime)->format('H:i');
        $lastTime =  Carbon::parse($firstQuiz->lastTime)->format('H:i');
        $date =  Carbon::parse($firstQuiz->created_at)->format('d F Y');

        return view('main.page.praquiz')->with(compact('modul', 'quizzes', 'firstTime', 'lastTime', 'date'));
    }

    public function showmateri(materi $materi)
    {
        $materis = $materi->moduls->users;
        $tanggal = Carbon::parse($materi->created_at)->format('d F Y');

        return view('main.page.materi')->with(compact('materi', 'materis', 'tanggal'));
    }

    public function showquizez(string $id)
    {
        $questions = question::where('quizId', $id)->with('jawabans')->latest()->get();
        $quiz = quiz::find($id);
        $tanggal = Carbon::parse($quiz->created_at)->format('d F Y');

        return view('main.page.quiz')->with(compact('questions', 'quiz', 'tanggal'));
    }
}

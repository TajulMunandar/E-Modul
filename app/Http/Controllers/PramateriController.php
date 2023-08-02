<?php

namespace App\Http\Controllers;

use App\Models\choiceUser;
use App\Models\essayUser;
use Carbon\Carbon;
use App\Models\quiz;
use App\Models\modul;
use App\Models\materi;
use App\Models\MateriStatus;
use App\Models\question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

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

        $isChoiceQuiz = [];
        foreach ($quizzes as $quiz) {
            // Ambil data Question dari relasi "questions" pada model Quiz
            $questions = $quiz->questions;

            // Loop melalui setiap Question untuk mengakses data Jawaban
            foreach ($questions as $question) {
                // Ambil data Jawaban dari relasi "jawabans" pada model Question
                $jawabans = $question->jawabans;

                foreach ($jawabans as $jawaban) {
                    // Periksa apakah pengguna sudah mengerjakan pilihan jawaban ini
                    $choice = ChoiceUser::where('userId', auth()->user()->id)
                        ->where('jawabanId', $jawaban->id)
                        ->first();

                    // Simpan informasi apakah pengguna telah mengerjakan kuis ini ke dalam array asosiatif
                    $isChoiceQuiz[$quiz->id] = $choice !== null;

                    // Jika pengguna telah mengerjakan kuis ini, lanjutkan ke kuis berikutnya
                    if ($choice !== null) {
                        break;
                    }
                }
            }
        }

        // Ambil data EssayUser berdasarkan user yang sedang terotentikasi dan memiliki nilai pada atribut "questionId"
        $essay = EssayUser::where('userId', auth()->user()->id)
            ->whereNotNull('questionId')
            ->get();


        // Periksa apakah ada data EssayUser yang ditemukan
        $isEssayQuizAttempted = $essay->isNotEmpty();

        return view('main.page.praquiz')->with(compact('modul', 'quizzes', 'firstTime', 'lastTime', 'date', 'isChoiceQuiz', 'isEssayQuizAttempted'));
    }

    public function showmateri(materi $materi)
    {
        $status = MateriStatus::where('userId', auth()->user()->id)->where('materiId', $materi->id)->first();
        if (!isset($status)) {
            MateriStatus::create([
                'userId' => auth()->user()->id,
                'status' => true,
                'materiId' => $materi->id
            ]);
        }
        $materis = $materi->moduls->user;
        $navmateris = materi::with('moduls')->where('modulId', $materi->modulId)->get();
        $footmateris = materi::with('moduls')->where('modulId', $materi->modulId)->get();
        $status = MateriStatus::where('materiId', $materi->id)->where('userId', auth()->user()->id)->with('materi')->latest()->first();

        $modul = $materi->moduls;

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

        return view('main.page.materi')->with(compact('materi', 'materis', 'tanggal', 'navmateris', 'previousMateri', 'nextMateri', 'status', 'modul'));
    }

    public function showquizez(string $id)
    {
        $questions = question::where('quizId', $id)->with('jawabans')->latest()->get();
        $quiz = quiz::find($id);
        $tanggal = Carbon::parse($quiz->created_at)->format('d F Y');

        return view('main.page.quiz')->with(compact('questions', 'quiz', 'tanggal'));
    }

    public function storeMateri(Request $request)
    {
        $materiData = json_decode($request->materi);

        $validatedData['status'] = 1;
        $validatedData['userId'] = auth()->user()->id;
        $validatedData['materiId'] = $materiData->id;

        MateriStatus::create($validatedData);

        // Cari data materi setelahnya (jika ada)
        $footmateris = materi::with('moduls')->where('modulId', $materiData->modulId)->get();
        $footermateris = $footmateris->sortBy('id')->values();
        $currentMateriIndex = $footermateris->search(function ($item) use ($materiData) {
            return $item->id === $materiData->id;
        });
        $nextMateri = null;
        if ($currentMateriIndex < $footermateris->count() - 1) {
            $nextMateri = $footermateris[$currentMateriIndex + 1];
        }
        return Redirect::route('materi-main.show', ['materi' => $nextMateri->slug])->with('success', 'User baru berhasil dibuat!');
    }
}

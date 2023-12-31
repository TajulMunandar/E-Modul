<?php

namespace App\Http\Controllers;

use App\Models\choiceUser;
use App\Models\jawaban;
use App\Models\modul;
use Carbon\Carbon;
use App\Models\quiz;
use App\Models\question;
use App\Models\score;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function showquiz(string $id)
    {
        $questions = question::where('quizId', $id)->with('jawabans')->latest()->get();
        $quiz = quiz::find($id);;
        $quizId = $id;
        $tanggal = Carbon::parse($quiz->created_at)->format('d F Y');

        return view('main.page.quiz')->with(compact('questions', 'quiz', 'tanggal', 'quizId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $modul = modul::whereId($request->id)->first();
        $benar = 0;
        foreach($request->jawabanId as $value) {
            $jawaban = jawaban::whereId($value)->first();
            choiceUser::create([
                'userId' => auth()->user()->id,
                'nilai' => $jawaban->status,
                'jawabanId' => $value
            ]);

            $jawaban = jawaban::whereId($value)->first();
            if($jawaban->status === 1){
                $benar += 1;
            }
        }
        $this->triggernilai($request->quizId, $benar);

        return redirect("/pramateri/{$modul->slug}/quiz")->with('success', 'Quizz Questtion Choice baru berhasil dibuat!');
    }

    public function triggernilai($quizId, $benar){
        $totalSoal = Question::where('quizId', $quizId)->count();
        $totalBenar = $benar;

        $total = ($totalBenar / $totalSoal) * 100;
        score::create([
            'userId' => auth()->user()->id,
            'status' => true,
            'quizId' => $quizId,
            'nilai' => $total,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\essayUser;
use App\Models\modul;
use App\Models\jawaban;
use App\Models\score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EssayController extends Controller
{
    public function store(Request $request)
    {
        $modul = modul::whereId($request->id)->first();
        foreach ($request->jawaban as $key => $value) {
            essayUser::create([
                'userId' => auth()->user()->id,
                'jawaban' => $value,
                'questionId' => $request->questionId[$key],
            ]);
        }

        score::create([
            'userId' => auth()->user()->id,
            'quizId' => $request->quizId,
            'status' => false,
            'nilai' => 0
        ]);

        return redirect("/pramateri/{$modul->slug}/quiz")->with('success', 'Quizz Questtion Choice baru berhasil dibuat!');
    }

    public function score($userId, $quizId){
        $score = score::where('userId', $userId)->where('quizId', $quizId)->first();
        if(!$score){

        }
    }
}

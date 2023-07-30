<?php

namespace App\Http\Controllers;

use App\Models\essayUser;
use App\Models\modul;
use App\Models\jawaban;
use Illuminate\Http\Request;

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
        return redirect("/pramateri/{$modul->slug}/quiz")->with('success', 'Quizz Questtion Choice baru berhasil dibuat!');
    }
}

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
        dd($request);
        $modul = modul::whereId($request->id)->first();
        foreach ($request->jawabanId as $value) {
            $jawaban = jawaban::whereId($value)->first();
            essayUser::create([
                'userId' => auth()->user()->id,
                'nilai' => $jawaban->status,
                'jawabanId' => $value
            ]);
        }
        return redirect("/pramateri/{$modul->slug}/quiz")->with('success', 'Quizz Questtion Choice baru berhasil dibuat!');
    }
}

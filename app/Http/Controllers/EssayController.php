<?php

namespace App\Http\Controllers;

use App\Models\essayUser;
use App\Models\modul;
use App\Models\score;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class EssayController extends Controller
{
    public function store(Request $request)
    {

        $modul = modul::whereId($request->id)->first();
        $file = $request->file('file');
        foreach ($request->jawaban as $key => $value) {
            $pdf = null;
            if (isset($file[$key])) {
                // Simpan file PDF ke direktori yang ditentukan
                $pdfName = time() . '-' . Str::random(10) . '.' . $file[$key]->getClientOriginalExtension();
                $file[$key]->storeAs('file-quiz', $pdfName);
            
                $pdf = 'file-quiz/' . $pdfName;
            }
            
            essayUser::create([
                'userId' => auth()->user()->id,
                'jawaban' => $value,
                'file' => $pdf,
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

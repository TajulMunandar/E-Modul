<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\choiceUser;
use App\Models\score;
use Illuminate\Http\Request;

class DashboardPenilaianController extends Controller
{
    public function index(){
        $score = Score::with(['quizzes' => function ($query) {
            // Mengakses relasi quizzes dan kondisi isChoice = true
            $query->whereHas('moduls', function ($subquery) {
                $subquery->where('isChoice', filter_var(request('isChoice'), FILTER_VALIDATE_BOOLEAN));
            });
        }, 'users'])
            ->latest()
            ->get();

        if(request('isChoice') == "true"){
            return view('dashboard.page.penilaian.choice.index',[
                'scores' => $score
            ]);
        }else{
            return view('dashboard.page.penilaian.essay.index',[
                'scores' => $score
            ]);
        }

    }

    public function show(){
        return view('dashboard.page.penilaian.choice.detailchoice',[
            'choiceusers' => choiceUser::with('jawabans', 'users')->where('userId', request('userId'))->latest()->get()
        ]);
    }
}

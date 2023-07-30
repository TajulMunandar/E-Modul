<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\choiceUser;
use App\Models\score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardPenilaianController extends Controller
{
    public function index(){
        $score = Score::with('quizzes', 'users')
                ->whereHas('quizzes', function ($query) {
                    $query->where('isChoice', filter_var(request('isChoice'), FILTER_VALIDATE_BOOLEAN));
                })
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

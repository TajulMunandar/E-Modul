<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\choiceUser;
use App\Models\essayUser;
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
            dd($score);
            return view('dashboard.page.penilaian.choice.index',[
                'scores' => $score
            ]);
        }else{
            dd($score);
            return view('dashboard.page.penilaian.essay.index',[
                'scores' => $score
            ]);
        }

    }

    public function show(){
        if(request('isChoice') == "1"){
            return view('dashboard.page.penilaian.choice.detailchoice',[
                'choiceusers' => choiceUser::with('jawabans', 'users')->where('userId', request('userId'))->latest()->get()
            ]);
        }else{
            return view('dashboard.page.penilaian.essay.detailchoice',[
                'essayusers' => essayUser::with('questions', 'users')->where('userId', request('userId'))->latest()->get(),
                'quizId' => request('quizId') 
            ]);
        }
    }

    public function update(string $id, Request $request){
        $rules = [
            'nilai' => 'required',
        ];

        $validatedData = $request->validate($rules);

        score::where('id', $id)->update($validatedData);
        return redirect('/dashboard/penilaian/essay?isChoice=false')->with('success', 'Nilai berhasil diubah');
    }

    public function updateitem(string $id, Request $request){
        $rules = [
            'nilai' => 'required',
            'status' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['status'] = filter_var(request('status'), FILTER_VALIDATE_BOOLEAN);

        essayUser::where('id', $id)->update($validatedData);
        return redirect("/dashboard/penilaian/essay/{$request->quizId}?userId={$request->userId}&isChoice=0&quizId={$request->quizId}")->with('success', 'Nilai berhasil diubah');
    }
}

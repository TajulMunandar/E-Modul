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
                ->latest()->get();

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

    public function show(string $id){
        if(request('isChoice') == "true"){
            $quizId = intval(request('quizId'));

            $choiceUser = ChoiceUser::whereHas('jawabans.questions.quizzes', function ($query) use ($quizId) {
                $query->where('id', $quizId);
            })->with(['jawabans' => function ($query) use ($quizId) {
                $query->whereHas('questions.quizzes', function ($query) use ($quizId) {
                    $query->where('id', $quizId);
                });
            }, 'users'])->where('userId', request('userId'))->latest()->get();

            return view('dashboard.page.penilaian.choice.detailchoice',[
                'choiceusers' => $choiceUser
            ]);
        }else{
            $quizId = intval(request('quizId'));

            $essayUsers = EssayUser::whereHas('questions.quizzes', function ($query) use($quizId){
                $query->where('id', $quizId);
            })->with(['questions' => function ($query) use ($quizId) {
                $query->whereHas('quizzes', function ($query) use ($quizId) {
                    $query->where('id', $quizId);
                });
            }, 'users'])->where('userId', request('userId'))->latest()->get();

            return view('dashboard.page.penilaian.essay.detailessay',[
                'essayusers' => $essayUsers,
                'scoreId' => $id,
                'total' => intval(request('nilai')) ,
                'quizId' =>$quizId
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
        $total = request('total');
        return redirect("/dashboard/penilaian/essay/{$request->scoreId}?userId={$request->userId}&isChoice=false&quizId={$request->quizId}&nilai={$total}")->with('success', 'Nilai berhasil diubah');
    }
}

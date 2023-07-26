<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\jawaban;
use App\Models\question;
use Illuminate\Http\Request;

class DashboardQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request('isChoice') == "true"){
            return view('dashboard.page.quizz.choice.question.index',[
                'quizzId' => request('quizzId'),
                'isChoice' => request('isChoice'),
                'questions' => question::with('jawabans')->latest()->get()
            ]);
        }else{
            return view('dashboard.page.quizz.essay.question.index', [
                'quizzId' => request('quizzId'),
                'isChoice' => request('isChoice'),
                'questions' => question::with('jawabans')->latest()->get()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(request('isChoice') == "true"){
            return view('dashboard.page.quizz.choice.question.create',[
                'quizzId' => request('quizzId'),
                'isChoice' => request('isChoice'),
            ]);
        }else{
            return view('dashboard.page.quizz.essay.question.create', [
                'quizzId' => request('quizzId'),
                'isChoice' => request('isChoice'),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedDataQuiz = $request->validate([
            'title' => 'required|max:255',
            'quizId' => 'required'
        ]);

        $question = question::create($validatedDataQuiz);
        foreach($request->answer as $key => $value) {
            $status = false;

            if($key == $request->jawaban){
                $status = true;
            }

            jawaban::create([
                'name' => $value,
                'status' => $status,
                'questionId' => $question->id
            ]);
        }

        if($request->isChoice == "true"){
            return redirect("/dashboard/quizz/question?isChoice=true&quizzId={$request->quizId}")->with('success', 'Quizz Questtion Choice baru berhasil dibuat!');
        }else{
            return redirect("/dashboard/quizz/question?isChoice=true&quizzId={$request->quizId}")->with('success', 'Quizz Question Essay baru berhasil dibuat!');
        }
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

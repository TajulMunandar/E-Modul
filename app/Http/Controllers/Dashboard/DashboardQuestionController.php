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
                'questions' => question::where('quizId', request('quizzId'))->with('jawabans')->latest()->get()
            ]);
        }else{
            return view('dashboard.page.quizz.essay.question', [
                'quizzId' => request('quizzId'),
                'isChoice' => request('isChoice'),
                'questions' => question::where('quizId', request('quizzId'))->with('jawabans')->latest()->get()
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
        if($request->isChoice == "true"){
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

            jawaban::create([
                'name' => 'Tidak Menjawab',
                'status' => false,
                'questionId' => $question->id
            ]);
        }

        if($request->isChoice == "true"){
            return redirect("/dashboard/quizz/question?isChoice=true&quizzId={$request->quizId}")->with('success', 'Quizz Questtion Choice baru berhasil dibuat!');
        }else{
            return redirect("/dashboard/quizz/question?isChoice=false&quizzId={$request->quizId}")->with('success', 'Quizz Question Essay baru berhasil dibuat!');
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
        if(request('isChoice') == "true"){
            return view('dashboard.page.quizz.choice.question.edit',[
                'quizzId' => request('quizzId'),
                'isChoice' => request('isChoice'),
                'question' => Question::where('id', $id)->first(),
                'jawabans' => jawaban::where('questionId',$id)->get()


            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedDataQuiz = $request->validate([
            'title' => 'required|max:255',
            'quizId' => 'required'
        ]);

        if($request->isChoice == "true"){
            foreach($request->answer as $key => $value) {
                $status = false;

                if($key == $request->jawaban){
                    $status = true;
                }

                jawaban::where('questionId', $id)->where('id', $request->idQuestion[$key])->update([
                    'name' => $value,
                    'status' => $status,
                ]);
            }
        }
        question::where('id', $id)->update($validatedDataQuiz);

        if($request->isChoice == "true"){
            return redirect("/dashboard/quizz/question?isChoice=true&quizzId={$request->quizId}")->with('success', 'Quizz Questtion Choice baru berhasil diperbarui!');
        }else{
            return redirect("/dashboard/quizz/question?isChoice=false&quizzId={$request->quizId}")->with('success', 'Quizz Question Essay baru berhasil diperbarui!');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $question = question::whereId($id)->first();
        if ($question->essayusers()->exists()) {
            if($request->isChoice == "true"){
                return redirect("/dashboard/quizz/question?isChoice=true&quizzId={$request->quizId}")->with('failed', "Question $question->title tidak bisa dihapus karena sedang digunakan!");
            }else{
                return redirect("/dashboard/quizz/question?isChoice=false&quizzId={$request->quizId}")->with('failed', "Question $question->title tidak bisa dihapus karena sedang digunakan!");
            }
        }
        $jawabans = jawaban::where('questionId', $id)->get();
        foreach($jawabans as $jawaban){
            jawaban::destroy($jawaban->id);
        }
        question::destroy($id);
        if($request->isChoice == "true"){
            return redirect("/dashboard/quizz/question?isChoice=true&quizzId={$request->quizId}")->with('success', "Question $question->name berhasil dihapus!");
        }else{
            return redirect("/dashboard/quizz/question?isChoice=false&quizzId={$request->quizId}")->with('success', "Question $question->name berhasil dihapus!");
        }
    }
}

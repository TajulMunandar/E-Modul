<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\jawaban;
use App\Models\modul;
use App\Models\question;
use App\Models\quiz;
use Illuminate\Http\Request;

class DashboardQuizzController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request('isChoice') == "true"){
            return view('dashboard.page.quizz.choice.index', [
                'moduls' => modul::latest()->get(),
                'quizzs' => quiz::where('isChoice', true)->latest()->get()
            ]);
        }else{
            return view('dashboard.page.quizz.essay.index', [
                'moduls' => modul::latest()->get(),
                'quizzs' => quiz::where('isChoice', false)->latest()->get()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'firstTime' => 'required',
            'lastTime' => 'required',
            'modulId' => 'required'
        ]);

        if($request->isChoice == "true"){
            $validatedData['isChoice'] = true;
        }else{
            $validatedData['isChoice'] = false;
        }

        quiz::create($validatedData);

        if($request->isChoice == "true"){
            return redirect('/dashboard/quizz/choicee?isChoice=true')->with('success', 'Quizz Choice baru berhasil dibuat!');
        }else{
            return redirect('/dashboard/quizz/essayy?isChoice=false')->with('success', 'Quizz Essay baru berhasil dibuat!');
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
        $rules = [
            'title' => 'required|max:255',
            'firstTime' => 'required',
            'lastTime' => 'required',
            'modulId' => 'required'
        ];

        $validatedData = $request->validate($rules);

        quiz::where('id', $id)->update($validatedData);

        if($request->isChoice == "true"){
            return redirect('/dashboard/quizz/choicee?isChoice=true')->with('success', 'Quizz Choice baru berhasil diperbarui!');
        }else{
            return redirect('/dashboard/quizz/essayy?isChoice=false')->with('success', 'Quizz Essay baru berhasil diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $quiz = quiz::whereId($id)->first();
        if ($quiz->questions()->exists()) {
            if($request->isChoice == "true"){
                return redirect('/dashboard/quizz/choicee?isChoice=true')->with('failed', "Quiz $quiz->title tidak bisa dihapus karena sedang digunakan!");
            }else{
                return redirect('/dashboard/quizz/essayy?isChoice=false')->with('failed', "Quiz $quiz->title tidak bisa dihapus karena sedang digunakan!");
            }
        }
        $questions = question::where('quizId', $id)->get();
        foreach($questions as $question){
            $jawabans = jawaban::where('questionId', $question->id)->get();
            foreach($jawabans as $jawaban){
                jawaban::destroy($jawaban->id);
            }
            question::destroy($question->id);
        }
        quiz::destroy($id);

        if($request->isChoice == "true"){
            return redirect('/dashboard/quizz/choicee?isChoice=true')->with('success', "Quizz Choice $quiz->title baru berhasil dihapus!");
        }else{
            return redirect('/dashboard/quizz/essayy?isChoice=false')->with('success', "Quizz Essay $quiz->title baru berhasil dihapus!");
        }
    }
}

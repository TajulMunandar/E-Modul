<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\choiceUser;
use App\Models\essayUser;
use App\Models\jawaban;
use App\Models\materi;
use App\Models\MateriStatus;
use App\Models\modul;
use App\Models\Prodi;
use App\Models\question;
use App\Models\quiz;
use App\Models\score;
use App\Models\User;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.page.user.index', [
            'users' => User::with('prodis')->latest()->get(),
            'prodis' => Prodi::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'max:16', 'unique:users'],
            'password' => 'required|max:255',
            'prodiId' => 'required',
            'role' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = intval($validatedData['role']);

        User::create($validatedData);

        return redirect('/dashboard/user')->with('success', 'User baru berhasil dibuat!');
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
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            'role' => 'required',
            'prodiId' => 'required'
        ];

        if ($request->username != $user->username) {
            $rules['username'] = ['required', 'max:16', 'unique:users'];
        }

        $validatedData = $request->validate($rules);

        User::where('id', $request->id)->update($validatedData);

        return redirect('/dashboard/user')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $user = User::whereId($id)->first();
            if($user->role == 1 || $user->role == 2){
                $user->moduls->each(function ($modul) {
                    $modul->materis->each(function ($materi) {
                        $materi->materiStatus->each->delete();
                        $materi->komentars->each->delete();
                        $materi->delete();
                    });

                    $modul->quizzes->each(function ($quiz) {
                        $quiz->questions->each(function ($question) {
                            $question->jawabans->each(function ($jawaban){
                                $jawaban->choiceUser->each->delete();
                                $jawaban->delete();
                            });
                            $question->jawabans->each->delete();
                            $question->essayusers->each->delete();
                            $question->delete();
                        });
                        $quiz->scores->each->delete();
                        $quiz->delete();
                    });
                    $modul->delete();
                });
            }
            $user->scores->each(function ($score){
                $score->delete();
            });
            $user->materiStatus->each(function ($materistatus){
                $materistatus->delete();
            });
            $user->komentars->each(function ($komentar){
                $komentar->delete();
            });
            $user->essayusers->each(function ($essay){
                $essay->delete();
            });
            $user->choiceusers->each(function ($choice){
                $choice->delete();
            });

            User::destroy($id);
            return redirect('/dashboard/user')->with('success', "User $user->name berhasil dihapus!");
    }

    public function resetPasswordAdmin(Request $request)
    {
        $rules = [
            'password' => 'required|max:255',
        ];

        if ($request->password == $request->password2) {
            $validatedData = $request->validate($rules);
            $validatedData['password'] = Hash::make($validatedData['password']);

            User::where('id', $request->id)->update($validatedData);
        } else {
            return back()->with('failed', 'Konfirmasi password tidak sesuai');
        }

        return redirect('/dashboard/user')->with('success', 'Password berhasil direset!');
    }
}

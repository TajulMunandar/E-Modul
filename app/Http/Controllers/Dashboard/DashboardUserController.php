<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
            'users' => User::latest()->get()
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
            'username' => ['required', 'min:6', 'max:16', 'unique:users'],
            'password' => 'required|min:5|max:255',
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
            'role' => 'required'
        ];

        if ($request->username != $user->username) {
            $rules['username'] = ['required', 'min:6', 'max:16', 'unique:users'];
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
        User::destroy($id);
        return redirect('/dashboard/user')->with('success', "User $user->name berhasil dihapus!");
    }

    public function resetPasswordAdmin(Request $request)
    {
        $rules = [
            'password' => 'required|min:5|max:255',
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

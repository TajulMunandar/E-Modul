<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\modul;
use App\Models\User;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class DashboardModulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.page.modul.index', [
            'users' => User::all(),
            'moduls' => modul::latest()->get()
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
            'image' => 'required|image|file',
            'deskripsi' => 'required',
            'userId' => 'required'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('image-modul');
        }

        $validatedData['slug'] = $this->getSlug($request->name);

        modul::create($validatedData);

        return redirect('/dashboard/modul')->with('success', 'Modul berhasil dibuat');
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
            'name' => 'required|max:255',
            'deskripsi' => 'required',
            'userId' => 'required'
        ];

        $validatedData = $request->validate($rules);

        if ($request->name != $request->oldName) {
            $validatedData['slug'] = $this->getSlug($request->name);
        }

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('image-modul');
        }

        modul::where('id', $id)->update($validatedData);
        return redirect('/dashboard/modul')->with('success', 'Modul berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $modul = modul::whereId($id)->first();
        if($modul->image){
            Storage::delete($modul->image);
        }
        modul::destroy($id);
        return redirect('/dashboard/modul')->with('success', "Modul $modul->name berhasil dihapus!");
    }

    public function getSlug($name)
    {
        $slug = SlugService::createSlug(modul::class, 'slug', $name);
        return $slug;
    }
}

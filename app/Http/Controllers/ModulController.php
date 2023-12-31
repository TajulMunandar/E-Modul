<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\modul;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $prodis = Prodi::all()->take(7);
        $prodis2 = Prodi::all();
        $moduls = modul::with('users', 'prodis');

        if ($request->has('prodi')) {
            $moduls->whereHas('prodis', function ($query) use ($request) {
                $query->where('prodis.id', $request->prodi);
            });
        }

        $moduls = $moduls->get();

        return view('main.page.modul')->with(compact('moduls', 'prodis', 'prodis2'));
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
        //
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

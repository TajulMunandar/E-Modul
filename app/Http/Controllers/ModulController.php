<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\modul;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategoris = Category::all()->take(7);
        $kategoris2 = Category::all();
        $moduls = modul::with('users', 'categories');

        if ($request->has('kategori')) {
            $moduls->whereHas('categories', function ($query) use ($request) {
                $query->where('categories.id', $request->kategori);
            });
        }

        $moduls = $moduls->get();

        return view('main.page.modul')->with(compact('moduls', 'kategoris', 'kategoris2'));
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

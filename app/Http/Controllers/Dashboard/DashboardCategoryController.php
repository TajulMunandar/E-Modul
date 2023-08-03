<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.page.category.index', [
            'categorys' => Category::latest()->get()
        ]);
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
            'name' => 'required|max:255'
        ]);

        $validatedData['slug'] = $this->getSlug($request->name);

        Category::create($validatedData);

        return redirect('/dashboard/category')->with('success', 'Category berhasil dibuat');
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
        ];

        $validatedData = $request->validate($rules);

        if ($request->name != $request->oldName) {
            $validatedData['slug'] = $this->getSlug($request->name);
        }


        Category::where('id', $id)->update($validatedData);
        return redirect('/dashboard/category')->with('success', 'Category berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $category = Category::whereId($id)->first();
            Category::destroy($id);
            return redirect('/dashboard/category')->with('success', "Category $category->name berhasil dihapus!");
        }catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/category')->with('failed', "Category $category->name tidak bisa dihapus karena sedang digunakan!");
        }
    }

    public function getSlug($name)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $name);
        return $slug;
    }
}

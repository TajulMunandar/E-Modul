<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\modul;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardModulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = User::whereIn('role', [1, 2])->get();
        if(auth()->user()->role ==  2){
            $moduls = modul::with('prodis')->latest()->get();

        }elseif(auth()->user()->role == 1){
            $moduls = modul::with('prodis')->where('userId', auth()->user()->id)->latest()->get();
        }
        return view('dashboard.page.modul.index', [
            'users' => User::all(),
            'prodis' => Prodi::all(),
            'moduls' => $moduls,
            'dosens' => $dosen
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
            'prodiId' => 'required',
            'deskripsi' => 'required',
            'userId' => 'required'
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');

            // Load the image using Intervention Image
            $image = Image::make($image);

            // Compress and resize the image
            $image->fit(800, 800, function ($constraint) {
                $constraint->upsize();
            })->encode('webp', 80); // Menggunakan format WebP untuk kompresi yang lebih efisien

            // Simpan gambar yang telah dikompres ke direktori image-modul
            $imageName = time() . '-' . Str::random(10) . '.' . 'webp';
            $image->save(storage_path('app/public/image-modul/' . $imageName));

            $validatedData['image'] = 'image-modul/' . $imageName;
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
            'prodiId' => 'required',
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
            $image = $request->file('image');

            // Load the image using Intervention Image
            $image = Image::make($image);

            // Compress and resize the image
            $image->fit(800, 800, function ($constraint) {
                $constraint->upsize();
            })->encode('webp', 80); // Menggunakan format WebP untuk kompresi yang lebih efisien

            // Simpan gambar yang telah dikompres ke direktori image-modul
            $imageName = time() . '-' . Str::random(10) . '.' . 'webp';
            $image->save(storage_path('app/public/image-modul/' . $imageName));

            $validatedData['image'] = 'image-modul/' . $imageName;
        }

        modul::where('id', $id)->update($validatedData);
        return redirect('/dashboard/modul')->with('success', 'Modul berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $modul = modul::whereId($id)->first();
            if ($modul->image) {
                Storage::delete($modul->image);
            }
            modul::destroy($id);
            return redirect('/dashboard/modul')->with('success', "Modul $modul->name berhasil dihapus!");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/modul')->with('failed', "Modul $modul->name tidak bisa dihapus karena sedang digunakan!");
        }
    }

    public function getSlug($name)
    {
        $slug = SlugService::createSlug(modul::class, 'slug', $name);
        return $slug;

    }
}

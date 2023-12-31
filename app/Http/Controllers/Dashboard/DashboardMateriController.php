<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\materi;
use App\Models\modul;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class DashboardMateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 2) {
            $materis = materi::with('moduls')->latest()->get();
        } else {
            $userId = auth()->user()->id;
            $materis = Materi::whereHas('moduls', function ($query) use ($userId) {
                $query->where('userId', $userId);
            })
                ->with('moduls')
                ->latest()
                ->get();
        }
        return view('dashboard.page.materi.index', [
            'materis' => $materis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role == 2) {
            $moduls = modul::latest()->get();
        } elseif (auth()->user()->role == 1) {
            $moduls = modul::where('userId', auth()->user()->id)->latest()->get();
        }
        return view('dashboard.page.materi.create', [
            'moduls' => $moduls
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->content);

        $rules = [
            'title' => 'required',
            'modulId' => 'required',
            'content' => 'required|min:20',
        ];

        $validatedData = $request->validate($rules);

        // Artikel
        $storage = "storage/content-materi";
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                $filePath = ("$storage/$fileNameContentRand.$mimetype");
                $image = Image::make($src)->encode($mimetype, 80)->save(public_path($filePath));
                $new_src = asset($filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        materi::create([
            'title' => $request->title,
            'slug' => $this->getSlug($request->title),
            'content' => $dom->saveHTML(),
            'modulId' => $request->modulId
        ]);

        return redirect('/dashboard/materi')->with('success', 'materi berhasil di dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(materi $materi)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (auth()->user()->role == 2) {
            $moduls = modul::latest()->get();
        } elseif (auth()->user()->role == 1) {
            $moduls = modul::where('userId', auth()->user()->id)->latest()->get();
        }
        return view('dashboard.page.materi.edit', [
            'moduls' => $moduls,
            'materi' => materi::whereId($id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'title' => 'required',
            'modulId' => 'required',
            'content' => 'required|min:20',
        ];

        $validatedData = $request->validate($rules);

        $materi = materi::find($id);

        // Artikel
        $storage = "storage/content-materi";
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $base64Image = substr($src, strpos($src, ',') + 1);
                $mimetype = $groups['mime'];
            } else {
                $imagePath = parse_url($src, PHP_URL_PATH);
                $imagePath = preg_replace('/^\/storage\//', '', $imagePath);
                $imageData = Storage::get($imagePath);
                // Mendapatkan ekstensi file dari path
                $mimetype = pathinfo($imagePath, PATHINFO_EXTENSION);
                $base64Image = base64_encode($imageData);
            }
            
            $fileNameContent = uniqid();
            $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
            $filePath = "$storage/$fileNameContentRand.$mimetype";
            Image::make($base64Image)->save(public_path($filePath));
            $new_src = asset($filePath);
            
            $img->removeAttribute('src');
            $img->setAttribute('src', $new_src);
            $img->setAttribute('class', 'img-responsive');
        }


        if ($request->title != $request->oldTitle) {
            $slug = $this->getSlug($request->title);
        } else {
            $slug = $request->oldSlug;
        }

        $this->deleteImage($materi->content);

        $materi->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $dom->saveHTML(),
            'modulId' => $request->modulId
        ]);

        return redirect('/dashboard/materi')->with('success', 'materi berhasil di diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $materi = materi::whereId($id)->first();

            if ($materi) {

                $this->deleteImage($materi->content);

                materi::destroy($id);

                return redirect('/dashboard/materi')->with('success', "Materi $materi->title berhasil dihapus.");
            }

            return redirect('/dashboard/materi')->with('error', "Materi $materi->title tidak ditemukan.");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/materi')->with('failed', "Materi $materi->title tidak bisa dihapus karena sedang digunakan!");
        }
    }

    public function getSlug($title)
    {
        $slug = SlugService::createSlug(materi::class, 'slug', $title);
        return $slug;
    }

    private function deleteImage($content)
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (strpos($src, 'storage/content-materi') !== false) {
                $filePath = public_path(parse_url($src, PHP_URL_PATH));
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
    }
}

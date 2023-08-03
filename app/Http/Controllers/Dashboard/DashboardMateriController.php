<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\materi;
use App\Models\modul;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class DashboardMateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.page.materi.index', [
            'materis' => materi::with('moduls')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.page.materi.create', [
            'moduls' => modul::latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' =>'required',
            'modulId' =>'required',
            'content' =>'required|min:20',
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
                $fileNameContentRand = substr(md5($fileNameContent),6,6).'_'.time();
                $filePath = ("$storage/$fileNameContentRand.$mimetype");
                $image = Image::make($src)->encode($mimetype, 100)->save(public_path($filePath));
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
            'modulId' =>$request->modulId
        ]);

        return redirect('/dashboard/materi')->with('success', 'materi berhasil di dibuat');
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
        return view('dashboard.page.materi.edit', [
            'moduls' => modul::latest()->get(),
            'materi' => materi::whereId($id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'title' =>'required',
            'modulId' =>'required',
            'content' =>'required|min:20',
        ];

        $validatedData = $request->validate($rules);

        $materi = materi::find($id);

        $this->deleteImage($materi->content);

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
                $fileNameContentRand = substr(md5($fileNameContent),6,6).'_'.time();
                $filePath = ("$storage/$fileNameContentRand.$mimetype");
                $image = Image::make($src)->encode($mimetype, 100)->save(public_path($filePath));
                $new_src = asset($filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }


        if ($request->name != $request->oldName) {
            $slug = $this->getSlug($request->title);
        }

        $materi->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $dom->saveHTML(),
            'modulId' =>$request->modulId
        ]);

        return redirect('/dashboard/materi')->with('success', 'materi berhasil di diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $materi = materi::whereId($id)->first();

            if ($materi) {

                $this->deleteImage($materi->content);

                materi::destroy($id);

                return redirect('/dashboard/materi')->with('success', 'Materi $materi->title berhasil dihapus.');
            }

            return redirect('/dashboard/materi')->with('error', 'Materi $materi->title tidak ditemukan.');
        }catch (\Illuminate\Database\QueryException $e) {
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

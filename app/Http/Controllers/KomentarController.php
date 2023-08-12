<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class KomentarController extends Controller
{

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'userId' => 'required',
            'materiId' => 'required'
        ]);

        Komentar::create($validatedData);

        return Redirect::route('materi-main.show', ['materi' => $request->slug]);
    }

    public function update(Request $request){
        $rules = [
            'name' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Komentar::where('id', $request->id)->update($validatedData);

        return Redirect::route('materi-main.show', ['materi' => $request->slug]);
    }

    public function destroy(Request $request, string $id){
        Komentar::destroy($id);
        return Redirect::route('materi-main.show', ['materi' => $request->slug]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        return view('main.page.profile',[
            'prodis' => Prodi::all()
        ]);
    }

    public function update(Request $request, User $user){
        // dd($request);
        $rules = [
            'no_induk' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
        ];

        $validatedData = $request->validate($rules);

        User::where('id', $request->id)->update($validatedData);

        return redirect('/profile')->with('success', 'User berhasil diperbarui!');
    }

    public function updateImage(Request $request, User $user){
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $rules = [
                'image' => 'required',
            ];
            $validatedData = $request->validate($rules);

            $image = $request->file('image');

            // Load the image using Intervention Image
            $image = Image::make($image);

            // Compress and resize the image
            $image->fit(800, 800, function ($constraint) {
                $constraint->upsize();
            })->encode('webp', 80); // Menggunakan format WebP untuk kompresi yang lebih efisien

            // Simpan gambar yang telah dikompres ke direktori image-user
            $imageName = time() . '-' . Str::random(10) . '.' . 'webp';
            $image->save(storage_path('app/public/image-user/' . $imageName));

            $validatedData['image'] = 'image-user/' . $imageName;


            User::where('id', $request->id)->update($validatedData);

            return redirect('/profile')->with('success', 'User berhasil diperbarui!');
        }
        return redirect('/profile')->with('success', 'User berhasil diperbarui!');
    }

    public function resetPassword(Request $request){
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

        return redirect('/profile')->with('success', 'Password berhasil direset!');
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\modul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\materi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $dosen = User::where('role', 1)->count();
        $mahasiswa = User::where('role', 0)->count();
        $modul = modul::all()->count();
        $highlight = materi::latest()->take(3)->get();

        return view('dashboard.page.index')->with(compact('dosen', 'mahasiswa', 'modul', 'highlight'));
    }
}

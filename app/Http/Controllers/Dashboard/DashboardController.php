<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\modul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $dosen = User::where('role', 1)->count();
        $mahasiswa = User::where('role', 0)->count();
        $modul = modul::all()->count();
        return view('dashboard.page.index')->with(compact('dosen', 'mahasiswa', 'modul'));
    }
}

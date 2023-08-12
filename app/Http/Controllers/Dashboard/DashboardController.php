<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\modul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\materi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request){
        $check = Log::where('visitor_ip', $request->ip())->whereDate('created_at', '=', (new \DateTime())->format('Y-m-d'))->first();

        if(!isset($check)){
            Log::create(['visitor_ip' => $request->ip()]);
        }

        $chartData = [];
        $chartLabels = [];
        $data = $this->grafis();

        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        foreach ($data as $record) {
            $formattedDate = date('d M Y', strtotime($record->visit_date));
            if ($record->visit_date == $today) {
                $chartLabels[] = "Hari Ini";
            } else if($record->visit_date == $yesterday){
                $chartLabels[] = "Kemarin";
            } else {
                $chartLabels[] = $formattedDate;
            }
            $chartData[] = $record->record_count;
        }

        $dosen = User::where('role', 1)->count();
        $mahasiswa = User::where('role', 0)->count();
        $modul = modul::all()->count();
        $highlights = materi::with('moduls')->latest()->take(3)->get();

        return view('dashboard.page.index')->with(compact('dosen', 'mahasiswa', 'modul', 'highlights', 'chartLabels', 'chartData'));
    }

    public function grafis(){
        $startDate = Carbon::now()->subWeek(); // Tanggal mulai satu minggu yang lalu
        $endDate = Carbon::now(); // Tanggal sekarang
        $grafis = DB::table('logs')
                        ->select(DB::raw('DATE(created_at) as visit_date'), DB::raw('COUNT(*) as record_count'))
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->whereTime('created_at', '>=', '00:00:00')
                        ->whereTime('created_at', '<=', '23:59:59')
                        ->groupBy('visit_date')
                        ->orderBy('visit_date', 'asc')
                        ->get();
        return $grafis;
    }
}

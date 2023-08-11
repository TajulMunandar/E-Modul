<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request){

        $check = Log::where('visitor_ip', $request->ip())->whereDate('created_at', '=', (new \DateTime())->format('Y-m-d'))->first();

        if(!isset($check)){
            Log::create(['visitor_ip' => $request->ip()]);
        }
        return view('main.page.index', [
            'user' => (new \DateTime())->format('Y-m-d')
        ]);

    }
}

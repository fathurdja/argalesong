<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $currentDate = Carbon::now()->translatedFormat('l, d M Y');
        return view('home', compact('user', 'currentDate'));
    }
}

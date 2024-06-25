<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $currentYear = Carbon::now()->year;
        $annee_N1 = $currentYear - 1;
        $annee_N2 = $currentYear - 2;
        return view('home',['user' => $user], compact('currentYear','annee_N1','annee_N2'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommuneCommunaute;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
        $user_Id = Auth::id();
        $annee_N1 = $currentYear - 1;
        $annee_N2 = $currentYear - 2;
        $associationsCUBCAR = CommuneCommunaute::where('cubId', $user_Id)->get();
        $totalCommunes = $associationsCUBCAR->count();
        $community = User::findOrFail($user_Id);
        $communeArr = $community->communes;

        return view('home',['user' => $user], compact('currentYear','annee_N1','annee_N2','totalCommunes','communeArr'));
    }
}

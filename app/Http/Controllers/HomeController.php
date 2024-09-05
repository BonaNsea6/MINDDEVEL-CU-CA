<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\CommuneCommunaute;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\FichierComptes;
use App\Models\RecetteCUCAR;
use App\Models\RecetteCar;
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
        $totalCommunesCub = $associationsCUBCAR->count();
        $community = User::findOrFail($user_Id);
        $communeArr = $community->communes;

        //avoir les recettes de la CUB connectée
        // $recetteCommuneCar = [];
        // foreach($associationsCUBCAR as $commune){
        //     $recetteCommuneCar[$commune->carId] = RecetteCar::where('userId', $commune->carId)->get();
        // }

        // $totalRecetteCommuneCar =   $recetteCommuneCar->count();

        $users = User::orderBy('id', 'desc')->paginate(10000);
        $files = FichierComptes::orderBy('userId')->get();
        $communes = CommuneCommunaute::orderBy('cubId')->get();
        $recetteCommunautes = RecetteCUCAR::orderBy('userId')->get();
        $recetteCommune = RecetteCar::orderBy('userId')->get();
        $userAdmin = User::where('roleId', 1)->get();
        $userCommunautes = User::where('roleId', 2)->get();
        $userCommunes = User::where('roleId', 3)
                     ->orderBy('id')
                     ->get();

        $totalCommunes = $communes->count();
        $totalFichiers= $files->count();
        $totalRecetteCommunes = $recetteCommune->count();
        $totalRecetteCommunautes = $recetteCommunautes->count();
        $totalAdmin= $userAdmin->count();
        $totalCommunautes= $userCommunautes->count();
        $totalCommunes= $userCommunes->count();
        $totalUsers = $users->count();

        $results = DB::table('recette_cars')
        ->select('annee')
        ->selectRaw('SUM(pil) as total_pil')
        ->selectRaw('SUM(ptc) as total_ptc')
        ->selectRaw('SUM(peds) as total_peds')
        ->groupBy('annee')
        ->get();

        $resultsCommunaute = DB::table('recette_c_u_c_a_r_s')
        ->select('annee')
        ->selectRaw('SUM(pic) as total_pic')
        ->selectRaw('SUM(ptc) as total_ptc')
        ->selectRaw('SUM(pcac) as total_pcac')
        ->selectRaw('SUM(rdp) as total_rdp')
        ->selectRaw('SUM(rdpc) as total_rdpc')
        ->selectRaw('SUM(rtps) as total_rtps')
        ->selectRaw('SUM(Total) as total_Total')
        ->groupBy('annee')
        ->get();


        $resultsCommunauteCUB = DB::table('recette_c_u_c_a_r_s')
        ->select('annee')
        ->selectRaw('SUM(pic) as total_pic')
        ->selectRaw('SUM(ptc) as total_ptc')
        ->selectRaw('SUM(pcac) as total_pcac')
        ->selectRaw('SUM(rdp) as total_rdp')
        ->selectRaw('SUM(rdpc) as total_rdpc')
        ->selectRaw('SUM(rtps) as total_rtps')
        ->selectRaw('SUM(Total) as total_Total')
        ->groupBy('annee')
        ->where('userId', $user_Id)
        ->get();



        return view('home',['user' => $user], compact('totalAdmin','resultsCommunauteCUB', 'totalCommunesCub','resultsCommunaute','results' ,'totalUsers','userCommunautes','userCommunes','totalCommunes','totalCommunautes','currentYear','annee_N1','annee_N2','totalCommunes','communeArr','totalCommunes','totalFichiers','totalRecetteCommunes','totalRecetteCommunautes'));
    }
}

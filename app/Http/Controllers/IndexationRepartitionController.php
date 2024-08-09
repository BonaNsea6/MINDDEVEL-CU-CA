<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\FichierComptes;
use App\Models\RecetteCUCAR;
use App\Models\RecetteCar;
use App\Models\CubCar;
use App\Models\CommuneCommunaute;
use App\Models\Config;
use App\Models\User;
use App\Models\NetPercevoirCommune;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use PDF;

use DB; 

class IndexationRepartitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = auth()->user();
        $user_Id = Auth::id();
        $currentYear = Carbon::now()->year;
        $anneeN1 = $currentYear - 1;
        $anneeN2 = $currentYear - 2;
        $recettes = RecetteCUCAR::where('userId', $user_Id)->get();
        $documents = FichierComptes::all();
        $community = User::findOrFail($user_Id);
        $communeArr = $community->communes;
        $associationsCUBCAR = CommuneCommunaute::where('cubId', $user_Id)->get();
        $totalCommunes = $associationsCUBCAR->count();

        // // Récupérer les IDs des communes associées à la communauté
        // $communesIds = DB::table('commune_communautes')
        // ->where('cubId', $user_Id)
        // ->pluck('carId'); // Récupère une collection d'IDs de communes

        // // Récupérer les détails des communes en utilisant les IDs
        // $communeArr = CommuneCommunaute::whereIn('id', $communesIds)->get();

        $communesEligibles = DB::table('commune_communautes')// récupérer les communes illigibles associées à une communauté
        ->join('recette_cars', 'commune_communautes.carId', '=', 'recette_cars.userId')
        ->join('users', 'recette_cars.userId', '=', 'users.id')
        ->where('commune_communautes.cubId', $user_Id)
        ->where('recette_cars.annee', $anneeN2)
        ->where('recette_cars.illigibilite', 'oui')
        ->select(
            'recette_cars.*',
            'users.name as user_name' // Sélectionne le nom de l'utilisateur et l'alias comme 'user_name'
        )
        ->get();

        $netPercevoirData = DB::table('net_percevoir_communes')
        ->join('users', 'net_percevoir_communes.userId', '=', 'users.id')
        ->join('commune_communautes', 'net_percevoir_communes.userId', '=', 'commune_communautes.carId')
        ->where('commune_communautes.cubId', $user_Id)
        ->where('net_percevoir_communes.annee', $anneeN2)
        ->select(
            'users.name as commune_name', // Nom de la commune
            'users.id as commune_id',
            'net_percevoir_communes.partFixe',
            'net_percevoir_communes.partVariable',
            'net_percevoir_communes.total',
            'net_percevoir_communes.etat',
            'net_percevoir_communes.annee',
             'net_percevoir_communes.tauxRepartition',
              'net_percevoir_communes.totauxCommunes',
               'net_percevoir_communes.totalTrimestriel',
        )
        ->get();

        return view('Indexation.gestionIndexation',['user' => $user], compact('currentYear','totalCommunes','communeArr','anneeN1','anneeN2','recettes','documents','communesEligibles','netPercevoirData'));
    }

    public function indexCommune()
    {
        //
        $user = auth()->user();
        $user_Id = auth()->id();
        $currentYear = Carbon::now()->year;
        $anneeN1 = $currentYear - 1;
        $anneeN2 = $currentYear - 2;
        $recettes = RecetteCar::all();
        $documents = FichierComptes::all();
        $commune = CommuneCommunaute::where('carId', $user_Id)->first();
        $config = Config::where('annee', $anneeN2)->where('userId', $commune->cubId )->first();
        return view('Indexation.gestionIndexationCommune',['user' => $user], compact('currentYear','anneeN1','anneeN2','recettes','documents','config'));
    }

    public function communes()
    {
        //
        $user = auth()->user();
        $user_Id = auth()->id();
        $currentYear = Carbon::now()->year;
        $anneeN1 = $currentYear - 1;
        $anneeN2 = $currentYear - 2;
        $recettes = RecetteCUCAR::all();
        $documents = FichierComptes::all();
        $communes = CommuneCommunaute::with(['cubUser', 'carUser'])->get();


        $netPercevoirData = DB::table('net_percevoir_communes')
        ->join('users', 'net_percevoir_communes.userId', '=', 'users.id')
        ->join('commune_communautes', 'net_percevoir_communes.userId', '=', 'commune_communautes.carId')
        ->where('commune_communautes.cubId', $user_Id)
        // ->where('net_percevoir_communes.annee', $anneeN2)
        ->select(
            'users.name as commune_name', // Nom de la commune
            'net_percevoir_communes.partFixe',
            'net_percevoir_communes.partVariable',
            'net_percevoir_communes.total',
            'net_percevoir_communes.etat',
            'net_percevoir_communes.annee',
            'net_percevoir_communes.tauxRepartition',
            'net_percevoir_communes.totauxCommunes',
             'net_percevoir_communes.totalTrimestriel',
             'net_percevoir_communes.userId',
        )
        ->get();
        return view('Indexation.communesArrondissements',['user' => $user], compact('currentYear','anneeN1','anneeN2','recettes','documents','communes','netPercevoirData'));
    }


    public function consulterCompteAdministratif()
    {
        //
        $user = auth()->user();
        $user_Id = auth()->id();
        $currentYear = Carbon::now()->year;
        $anneeN1 = $currentYear - 1;
        $anneeN2 = $currentYear - 2;
        $recettes = RecetteCar::all();
        $documents = FichierComptes::all();
        $fichiers = FichierComptes::all();

        $netPercevoirData = DB::table('net_percevoir_communes')
        ->join('users', 'net_percevoir_communes.userId', '=', 'users.id')
        ->join('commune_communautes', 'net_percevoir_communes.userId', '=', 'commune_communautes.carId')
        ->where('commune_communautes.cubId', $user_Id)
        // ->where('net_percevoir_communes.annee', $anneeN2)
        ->select(
            'users.name as commune_name', // Nom de la commune
            'net_percevoir_communes.partFixe',
            'net_percevoir_communes.partVariable',
            'net_percevoir_communes.total',
            'net_percevoir_communes.etat',
            'net_percevoir_communes.annee',
            'net_percevoir_communes.tauxRepartition',
            'net_percevoir_communes.totauxCommunes',
             'net_percevoir_communes.totalTrimestriel',
             'net_percevoir_communes.userId',
        )
        ->get();
        return view('Indexation.consulterCompteAdministratifs',['user' => $user], compact('currentYear','anneeN1','anneeN2','recettes','documents','fichiers','netPercevoirData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storefileCommune(Request $request)
    {
        // Validation des fichiers
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:2048',
            'excel_file' => 'required|mimes:xlsx,xls|max:2048',
        ]);
    
        // Vérifier si l'utilisateur a déjà soumis des fichiers pour l'année en cours
        $user_Id = auth()->id();
        $currentYear = Carbon::now()->year;
        $anneeN1 = $currentYear - 1;
        $anneeN2 = $currentYear - 2;
        $existingFiles = FichierComptes::where('annee', $anneeN2)
            ->where('userId', auth()->id()) // Assurez-vous d'avoir une colonne `user_id` dans votre table `fichier_comptes`
            ->exists();
    
        if ($existingFiles) {
            return back()->with('successError', "Vous avez déjà soumis des fichiers pour l'année $anneeN2 .");
        }
        
        $commune = CommuneCommunaute::where('carId', $user_Id)->first();
        $config = Config::where('annee', $anneeN2)->where('userId', $commune->cubId )->first();
        if ($config && Carbon::now()->gt(Carbon::parse($config->delaie))) {
            return back()->with('successError', 'Le délai de soumission est dépassé. Vous ne pouvez plus soumettre de rapports.');
        }
        // Si ce n'est pas le cas, procéder à l'enregistrement des fichiers
        $pdfFile = $request->file('pdf_file');
        $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
        $pdfFile->storeAs('pdf', $pdfFileName, 'public');
    
        $excelFile = $request->file('excel_file');
        $excelFileName = time() . '_' . $excelFile->getClientOriginalName();
        $excelFile->storeAs('excel', $excelFileName, 'public');
    
        try {
            // Création de l'enregistrement dans la base de données
            $file = FichierComptes::create([
                'annee' => $anneeN2,
                'excel_file' => 'excel/' . $excelFileName,
                'pdf_file' => 'pdf/' . $pdfFileName,
                'userId' => auth()->id(), // Assurez-vous d'avoir une colonne `user_id` dans votre table `fichier_comptes`
            ]);
    
            return back()->with('success', "Documents soumis avec succès!");
        } catch (QueryException $e) {
            // Gestion des erreurs de base de données
            if ($e->getCode() === '23000') {
                return back()->with('successError', "Erreur lors de la soumission des documents.");
            }
    
            // Rethrow l'exception pour le traitement par défaut
            throw $e;
        }
    }
    

    public function storefileCommunaute(Request $request)
    {
        // Validation des fichiers
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:2048',
            'excel_file' => 'required|mimes:xlsx,xls|max:2048',
        ]);
    
        // Vérifier si l'utilisateur a déjà soumis des fichiers pour l'année en cours
        $currentYear = Carbon::now()->year;
        $anneeN1 = $currentYear - 1;
        $anneeN2 = $currentYear - 2;
        $existingFiles = FichierComptes::where('annee', $anneeN2)
            ->where('userId', auth()->id()) // Assurez-vous d'avoir une colonne `user_id` dans votre table `fichier_comptes`
            ->exists();
    
        if ($existingFiles) {
            return back()->with('successError', "Vous avez déjà soumis des fichiers pour l'année $anneeN2 .");
        }
        
    
        // Si ce n'est pas le cas, procéder à l'enregistrement des fichiers
        $pdfFile = $request->file('pdf_file');
        $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
        $pdfFile->storeAs('pdf', $pdfFileName, 'public');
    
        $excelFile = $request->file('excel_file');
        $excelFileName = time() . '_' . $excelFile->getClientOriginalName();
        $excelFile->storeAs('excel', $excelFileName, 'public');
    
        try {
            // Création de l'enregistrement dans la base de données
            $file = FichierComptes::create([
                'annee' => $anneeN2,
                'excel_file' => 'excel/' . $excelFileName,
                'pdf_file' => 'pdf/' . $pdfFileName,
                'userId' => auth()->id(), // Assurez-vous d'avoir une colonne `user_id` dans votre table `fichier_comptes`
            ]);
    
            return back()->with('success', "Documents soumis avec succès!");
        } catch (QueryException $e) {
            // Gestion des erreurs de base de données
            if ($e->getCode() === '23000') {
                return back()->with('successError', "Erreur lors de la soumission des documents.");
            }
    
            // Rethrow l'exception pour le traitement par défaut
            throw $e;
        }
    }
    

    public function ReiseignerRecette(Request $request)
    {
        // Validation des fichiers
        $request->validate([
            'ptc' => 'required|numeric',
            'rdpc' => 'required|numeric',
            'rdp' => 'required|numeric',
            'pic' => 'required|numeric',
            'pcac' => 'required|numeric',
            'rtps' => 'required|numeric',
        ]);
    
        // Vérifier si l'utilisateur a déjà soumis des fichiers pour l'année en cours
        $currentYear = Carbon::now()->year;
        $anneeN2 = $currentYear - 2;
        $recetteExistante = RecetteCUCAR::where('annee', $anneeN2)
            ->where('userId', auth()->id())
            ->exists();
    
        if ($recetteExistante) {
            return back()->with('successError', "Vous ne pouvez plus soumettre pour l'année $anneeN2. S'il y a des modifications à apporter, veuillez les faire depuis la zone de mise à jour.");
        }
    
        // Calculer la somme de tous les éléments entiers
        $total = $request->ptc + $request->rdpc + $request->rdp + $request->pic + $request->pcac + $request->rtps;
    
        $tauxApplique = 0;
        $explication = "";
        
        if ($total > 20000000000) {
            $tauxApplique = ($total * 6) / 100;
            $explication = "Vous avez un montant du produit de recette de $total XAF, qui est supérieur à 20000000000 FCFA et par conséquent le taux à appliquer est de 6% de cette recette";
        } elseif ($total >= 10000000001 && $total <= 20000000000) {
            $tauxApplique = ($total * 7) / 100;
            $explication = "Vous avez un montant du produit de recette de $total XAF, qui est dans l'intervalle 10000000001 FCFA et 20000000000 FCFA et par conséquent le taux à appliquer est de 7% de cette recette";
        } elseif ($total >= 5000000001 && $total <= 10000000000) {
            $tauxApplique = ($total * 8) / 100;
            $explication = "Vous avez un montant du produit de recette de $total XAF, qui est dans l'intervalle 5000000001 FCFA et 10000000000 FCFA et par conséquent le taux à appliquer est de 8% de cette recette";
        } elseif ($total >= 1000000001 && $total <= 5000000000) {
            $tauxApplique = ($total * 9) / 100;
            $explication = "Vous avez un montant du produit de recette de $total XAF, qui est dans l'intervalle 1000000001 FCFA et 5000000000 FCFA et par conséquent le taux à appliquer est de 9% de cette recette";
        } elseif ($total >= 500000001 && $total <= 1000000000) {
            $tauxApplique = ($total * 10) / 100;
            $explication = "Vous avez un montant du produit de recette de $total XAF, qui est dans l'intervalle 500000001 FCFA et 1000000000 FCFA et par conséquent le taux à appliquer est de 10% de cette recette";
        } elseif ($total >= 0 && $total <= 500000000) {
            $tauxApplique = ($total * 11) / 100;
            $explication = "Vous avez un montant du produit de recette de $total XAF, qui est dans l'intervalle 0 FCFA et 500000000 FCFA et par conséquent le taux à appliquer est de 11% de cette recette";
        }
        
        $resteCUB = $total - $tauxApplique;
        $partFixe = ($tauxApplique * 70) / 100;
        $partVariable = $tauxApplique - $partFixe;
    
        DB::beginTransaction();
        
        try {
            // Création de l'enregistrement dans la base de données
            $recette = RecetteCUCAR::create([
                'annee' => $anneeN2,
                'tauxApplique' => $tauxApplique,
                'partFixe' => $partFixe,
                'etat' => "Attente",
                'partVariable' => $partVariable,
                'explication' => $explication,
                'resteCUB' => $resteCUB,
                'pic' => $request->pic,
                'pcac' => $request->pcac,
                'rtps' => $request->rtps,
                'ptc' => $request->ptc,
                'rdp' => $request->rdp,
                'rdpc' => $request->rdpc,
                'userId' => auth()->id(),
                'total' => $total,
            ]);
    
            // Récupérer les communes associées à la communauté urbaine
            $communes = CommuneCommunaute::where('cubId', auth()->id())->get();
    
            if ($communes->isNotEmpty()) {
                // Calculer la part fixe pour chaque commune
                $partCommune = $partFixe / $communes->count();
                    // Trouver la recette existante pour la commune et l'année
                    $recetteCommune = RecetteCUCAR::where('userId', auth()->id())->where('annee', $anneeN2)->first();
                    $netPercevoirData = DB::table('net_percevoir_communes')
                    ->join('users', 'net_percevoir_communes.userId', '=', 'users.id')
                    ->join('cub_cars', 'net_percevoir_communes.userId', '=', 'cub_cars.carId')
                    ->where('cub_cars.cubId', auth()->id())
                    ->where('net_percevoir_communes.annee', $anneeN2)
                    ->select(
                        'users.id as commune_id',
                        'users.name as commune_name', // Nom de la commune
                        'net_percevoir_communes.partFixe',
                        'net_percevoir_communes.partVariable',
                        'net_percevoir_communes.total',
                        'net_percevoir_communes.etat',
                        'net_percevoir_communes.annee'
                    )
                    ->get();
    
                    if ($recetteCommune) {
                        // Mettre à jour la partCommune pour la recette existante
                        $recetteCommune->update(['partCommune' => $partCommune]);

                    }

                    foreach ($netPercevoirData as $netPercevoirData) {
                        NetPercevoirCommune::updateOrCreate(
                            ['userId' => $netPercevoirData->commune_id, 'annee' => $netPercevoirData->annee],
                            [
                                'partFixe' => $partCommune,
                            ]
                        );
                    }
               
            }
    
            DB::commit();
            
            return back()->with('success', " Recettes soumises avec succès pour l'année $anneeN2 !");
        } catch (QueryException $e) {
            DB::rollBack();
            // Gestion des erreurs de base de données
            // if ($e->getCode() === '23000') {
            //     return back()->with('successError', "Erreur lors de la soumission des documents.");
            // }
    
            // Rethrow l'exception pour le traitement par défaut
            throw $e;
        }
    }
    

    public function ReiseignerRecetteCommune(Request $request)
    {
        // Validation des fichiers
        $request->validate([
            'pil' => 'required|numeric',
            'ptc' => 'required|numeric',
            'peds' => 'required|numeric',
            'userId' => 'required',
        ]);
    
        // Vérifier si l'utilisateur a déjà soumis des fichiers pour l'année en cours
        $currentYear = Carbon::now()->year;
        $anneeN2 = $currentYear - 2;
        $anneeN3 = $currentYear - 3;
        $user_Id = auth()->id();
        $documents = FichierComptes::all();
        $recetteExistante = RecetteCar::where('annee', $anneeN2)
            ->where('userId', $request->userId)
            ->exists();
    
        $recetteExistanteAnneeN3 = RecetteCar::where('annee', $anneeN3)
            ->where('userId', $request->userId)
            ->exists();
    
        
        $documentSoumis = false;
            foreach($documents as $document) {
                if($document->userId == $request->userId && $document->annee == $anneeN2 ) {
                    $documentSoumis = true;
                break;
                }
            }

        
        if ($documentSoumis ==false) {
                return back()->with('successError', "Vous ne pouvez pas encore soumettre pour l'année $anneeN2 les reccettes de cette communes car elle n'a pas encore envoyé ses comptes administratifs pour la dite année.");
            }
        if ($recetteExistante) {
            return back()->with('successError', "Vous ne pouvez plus soumettre pour l'année $anneeN2. S'il y a des modifications à apporter, veuillez les faire depuis la zone de mise à jour.");
        }
    
        // Calculer le total de l'année N3 si existant
        $totalAnneeN3 = $recetteExistanteAnneeN3 ? RecetteCar::where('annee', $anneeN3)
            ->where('userId', auth()->id())
            ->value('totalAnneeN2') : 0;
    
        // Calculer la somme de tous les éléments entiers pour l'année N2
        $totalAnneeN2 = $request->pil + $request->ptc + $request->peds;
        $difference = $totalAnneeN2 - $totalAnneeN3;

        $illigibilite = "";

        if($difference <= 0  ){
             $illigibilite = "non";
        }elseif($difference  > 0 ){
            $illigibilite = "oui";
        }
    
        DB::beginTransaction();
        
    
        try {
            // Création de l'enregistrement dans la base de données
            $recette = RecetteCar::create([
                'annee' => $anneeN2,
                'etat' => "Attente",
                'pil' => $request->pil,
                'userId' => $request->userId,
                'ptc' => $request->ptc,
                'peds' => $request->peds,
                'totalAnneeN2' => $totalAnneeN2,
                'totalAnneeN3' => $totalAnneeN3,
                'difference' => $difference,
                'illigibilite' => $illigibilite,
            ]);
    
            DB::commit();
    
            return back()->with('success', "Recettes soumises avec succès pour l'année $anneeN2 !");
        } catch (QueryException $e) {
            // Annuler la transaction en cas d'erreur
            DB::rollBack();
    
            // Gestion des erreurs de base de données
            // if ($e->getCode() === '23000') {
            //     return back()->with('successError', "Erreur lors de la soumission des documents.");
            // }
    
            // Rethrow l'exception pour le traitement par défaut
            throw $e;
        }
    }

    public function calculerPartVariable()
    {
        // Récupérer l'ID de la commune authentifiée
        $communeAuthId = auth()->id();
    
        // Année actuelle et année N-2
        $currentYear = Carbon::now()->year;
        $anneeN2 = $currentYear - 2;
    
        // Récupérer les recettes pour l'année N-2 de la CUB authentifiée
        $recettesCUB = RecetteCUCAR::where('userId', $communeAuthId)
            ->where('annee', $anneeN2)
            ->first();
    
        // Vérifier si les recettes pour l'année N-2 existent
        if (!$recettesCUB) {
            return back()->with('successError', "Aucune recette trouvée pour l'année $anneeN2.");
        }
    
        // Récupérer les associations CUB-CAR pour la CUB authentifiée
        $associationsCUBCAR = CommuneCommunaute::where('cubId', $communeAuthId)->get();
        $totalCommunes = $associationsCUBCAR->count();
    
        // Filtrer les communes éligibles
        $communesEligibles = RecetteCAR::whereIn('userId', $associationsCUBCAR->pluck('carId'))
            ->where('illigibilite', 'oui')
            ->where('annee', $anneeN2)
            ->get();
    
        // Compter le nombre total de communes éligibles
        $totalCommunesEligibles = $communesEligibles->count();
    
        // Récupérer la part fixe pour la CUB
        $partFixe = $recettesCUB->partCommune;
    
        if ($totalCommunesEligibles > 0) {
            // Calculer la part variable par commune éligible
            $partVariableParCommune = $recettesCUB->partVariable / $totalCommunesEligibles;
    
            // Calcul du total de contribution des communes éligibles
            $totauxRecetteCommmuneIlligible = $communesEligibles->sum('totalAnneeN2');
    
            // Calcul du taux de répartition par commune
            $tauxRepartitionParCommunes = [];
            $recetteParCommune = [];
            foreach($communesEligibles as $commune){
                $taux = ($commune->totalAnneeN2 * 100) / $totauxRecetteCommmuneIlligible;
                $tauxRepartitionParCommunes[$commune->userId] = $taux; // Stocker le taux par userId
                $commune->update(['tauxRepartition' => $taux]);
                $recetteParCommune[$commune->userId] = $commune->totalAnneeN2  ;
            }

            //calcul de la part variable de chaque commune
            $partVariableParCommune = [];
            foreach($communesEligibles as $commune){
                $partVariableCommune = ($recettesCUB->partVariable*$commune->tauxRepartition)/100;
                $partVariableParCommune[$commune->userId] =  $partVariableCommune; // Stocker la partVariable par userId
                $commune->update(['totauxCommunes' => $totauxRecetteCommmuneIlligible]);
            }
    
            foreach ($associationsCUBCAR as $association) {
                // Récupérer le taux de répartition pour la commune actuelle
                $tauxRepartition = $tauxRepartitionParCommunes[$association->carId] ?? 0;
                $isEligible = $communesEligibles->contains('userId', $association->carId);
                $partVariable = $isEligible ? $partVariableParCommune[$association->carId] : 0;
                $total = $partFixe + $partVariable;
                $partTrimestriel = $total/4;
                $recetteParComm = $recetteParCommune[$association->carId] ?? 0;
    
                NetPercevoirCommune::updateOrCreate(
                    ['userId' => $association->carId, 'annee' => $anneeN2],
                    [
                        'partVariable' => $partVariable,
                        'partFixe' => $partFixe,
                        'etat' => 'Attente',
                        'total' => $total,
                        'tauxRepartition' => $tauxRepartition, // Ajouter le taux de répartition
                        'totauxCommunes' => $totauxRecetteCommmuneIlligible,
                        'totalTrimestriel' => $partTrimestriel,
                        'recetteParCommune' => $recetteParComm,
                    ]
                );
            }


    
            return back()->with('success', "$totalCommunesEligibles communes éligibles. Calcul des parts variables terminé pour l'année $anneeN2.  $partVariableCommune");
        } else {
            // Aucun commune éligible, répartir équitablement
            $totalCommunes = $associationsCUBCAR->count();
            $partVariableParCommune = $recettesCUB->partVariable / $totalCommunes;
    
            foreach ($associationsCUBCAR as $association) {
                $total = $partFixe + $partVariableParCommune;
                $partTrimestriel = $total/4;
                $recetteParComm = $recetteParCommune[$association->carId]??0;
    
                NetPercevoirCommune::updateOrCreate(
                    ['userId' => $association->carId, 'annee' => $anneeN2],
                    [
                        'partVariable' => $partVariableParCommune,
                        'etat' => 'Attente',
                        'partFixe' => $partFixe,
                        'total' => $total,
                        'tauxRepartition' => 0, // Mettre 0 car il n'y a pas de répartition spécifique
                        'totauxCommunes' => 0,
                        'totalTrimestriel' => $partTrimestriel,
                        'recetteParCommune' => $recetteParComm,
                    ]
                );
            }
    
            return back()->with('success', "Aucune commune éligible trouvée. Répartition équitable effectuée.");
        }
    }
    
    

        // Vous pouvez retourner une vue ou un message de confirmation ici
        // return view('calcul.part.variable')->with('communes', $communes);
      
    

    
    


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateRecette(Request $request, RecetteCUCAR $recette)
    {
         // Validation des fichiers
         $request->validate([
            'ptc' => 'required|numeric',
            'rdpc' => 'required|numeric',
            'rdp' => 'required|numeric',
            'pic' => 'required|numeric',
            'pcac' => 'required|numeric',
            'rtps' => 'required|numeric',
        ]);


        $total = $request->ptc + $request->rdpc + $request->rdp + $request->pic + $request->pcac + $request->rtps;
    
        $tauxApplique = 0;
        $explication = "";
        
        if ($total > 20000000000) {
            $tauxApplique = ($total * 6) / 100;
            $explication = "Vous avez un montant du produit de recette qui est supérieur à 20000000000 FCFA et par conséquent le taux à appliquer est de 6% de cette recette";
        } elseif ($total >= 10000000001 && $total <= 20000000000) {
            $tauxApplique = ($total * 7) / 100;
            $explication = "Vous avez un montant du produit de recette qui est dans l'intervalle 10000000001 FCFA et 20000000000 FCFA et par conséquent le taux à appliquer est de 7% de cette recette";
        } elseif ($total >= 5000000001 && $total <= 10000000000) {
            $tauxApplique = ($total * 8) / 100;
            $explication = "Vous avez un montant du produit de recette qui est dans l'intervalle 5000000001 FCFA et 10000000000 FCFA et par conséquent le taux à appliquer est de 8% de cette recette";
        } elseif ($total >= 1000000001 && $total <= 5000000000) {
            $tauxApplique = ($total * 9) / 100;
            $explication = "Vous avez un montant du produit de recette qui est dans l'intervalle 1000000001 FCFA et 5000000000 FCFA et par conséquent le taux à appliquer est de 9% de cette recette";
        } elseif ($total >= 500000001 && $total <= 1000000000) {
            $tauxApplique = ($total * 10) / 100;
            $explication = "Vous avez un montant du produit de recette qui est dans l'intervalle 500000001 FCFA et 1000000000 FCFA et par conséquent le taux à appliquer est de 10% de cette recette";
        } elseif ($total >= 0 && $total <= 500000000) {
            $tauxApplique = ($total * 11) / 100;
            $explication = "Vous avez un montant du produit de recette qui est dans l'intervalle 0 FCFA et 500000000 FCFA et par conséquent le taux à appliquer est de 11% de cette recette";
        }
        
        $resteCUB = $total - $tauxApplique;
        $partFixe = ($tauxApplique * 70) / 100;
        $partVariable = $tauxApplique - $partFixe;
    
        DB::beginTransaction();
        
        try {
        $recette->update([
            'tauxApplique' => $tauxApplique,
            'partFixe' => $partFixe,
            'etat' => "Attente",
            'partVariable' => $partVariable,
            'explication' => $explication,
            'resteCUB' => $resteCUB,
            'pic' => $request->pic,
            'pcac' => $request->pcac,
            'rtps' => $request->rtps,
            'ptc' => $request->ptc,
            'rdp' => $request->rdp,
            'rdpc' => $request->rdpc,
            'total' => $total,
        ]);

          // Récupérer les communes associées à la communauté urbaine
          $communes = CommuneCommunaute::where('cubId', auth()->id())->get();
    
          if ($communes->isNotEmpty()) {
              // Calculer la part fixe pour chaque commune
              $partCommune = $partFixe / $communes->count();
                  // Trouver la recette existante pour la commune et l'année
                  $recetteCommune = RecetteCUCAR::where('userId', auth()->id())->where('id', $recette->id)->first();
                  $netPercevoirData = DB::table('net_percevoir_communes')
                  ->join('users', 'net_percevoir_communes.userId', '=', 'users.id')
                  ->join('cub_cars', 'net_percevoir_communes.userId', '=', 'cub_cars.carId')
                  ->where('cub_cars.cubId', auth()->id())
                  ->where('net_percevoir_communes.id', $recette->id)
                  ->select(
                      'users.id as commune_id',
                      'users.name as commune_name', // Nom de la commune
                      'net_percevoir_communes.partFixe',
                      'net_percevoir_communes.partVariable',
                      'net_percevoir_communes.total',
                      'net_percevoir_communes.etat',
                      'net_percevoir_communes.id'
                  )
                  ->get();
  
                  if ($recetteCommune) {
                      // Mettre à jour la partCommune pour la recette existante
                      $recetteCommune->update(['partCommune' => $partCommune]);
                  }

                //   foreach ($netPercevoirData as $netPercevoirData) {
                //     NetPercevoirCommune::updateOrCreate(
                //         ['userId' => $netPercevoirData->commune_id, 'annee' => $recette->annee],
                //         [
                //             'partFixe' => $partCommune,
                //         ]
                //     );
                // }

            
             
          }
  
          DB::commit();
          
          return back()->with('success', " Recettes soumises avec succès pour l'année $recette->annee!");
      } catch (QueryException $e) {
          DB::rollBack();
          // Gestion des erreurs de base de données
          if ($e->getCode() === '23000') {
              return back()->with('successError', "Erreur lors de la soumission des documents.");
          }
  
          // Rethrow l'exception pour le traitement par défaut
          throw $e;
      }
        return back()->with('success', 'Mise à jour effectué avec success');
    }

    public function AnnulerRecette(RecetteCUCAR $recette)
    {
        $recette->delete();
        return back()->with('success', " Annulation réussi avec success");
    }


    //partie configuration
    public function indexConfiguration()
    {
        //
        $user = auth()->user();
        $currentYear = Carbon::now()->year;
        $anneeN1 = $currentYear - 1;
        $anneeN2 = $currentYear - 2;
        $recettes = RecetteCar::all();
        $documents = FichierComptes::all();
        $configs = Config::all();
        return view('Config.indexConfiguration',['user' => $user], compact('currentYear','anneeN1','anneeN2','recettes','documents','configs'));
    }

    public function configurerDelaie(Request $request)
    {
        //
        $currentYear = Carbon::now()->year;
        $anneeN2 = $currentYear - 2;
        $request->validate([
            'delaie' => 'required',
        ]);

        try {
            $config = Config::create([
                'annee' =>  $anneeN2,
                'delaie' => $request->delaie,
            ]);
            return back()->with('success', "Délaie définit avec success!");
        
        } catch (QueryException $e) {
            // Si une violation de contrainte d'intégrité se produit
            
            throw $e;
        }

    }

    public function rapportPdf($commune, $annee)
    {
        // Vérifier si un rapport existe pour cette activité
        $rapport = FichierComptes::where('userId', $commune)->where('annee', $annee)->first();
    
        // Si aucun rapport n'existe, renvoyer une réponse d'erreur
        if (!$rapport) {
            abort(404, 'Aucun rapport trouvé pour cette activité.');
        }
    
        // Construire le chemin complet du fichier PDF
        $cheminFichier = 'public/' . $rapport->pdf_file;
    
        // Vérifier si le fichier existe dans le système de fichiers
        if (Storage::exists($cheminFichier)) {
            // Extraire le nom de base du fichier pour éviter les caractères invalides
            $nomFichier = basename($rapport->pdf_file);
    
            // Renvoyer le fichier PDF en réponse avec le type MIME approprié
            return Storage::download($cheminFichier, $nomFichier, [
                'Content-Type' => 'application/pdf',
            ]);
        } else {
            // Renvoyer une réponse d'erreur si le fichier n'existe pas
            return back()->with('successError', "Aucun Compte administratif trouvé pour cette commune à l'année $annee!");
        }
    }
    

    public function rapportExcel($commune, $annee)
    {
        // Vérifier si un rapport existe pour cette activité
        $rapport = FichierComptes::where('userId', $commune)->where('annee', $annee)->first();
    
        // Si aucun rapport n'existe, renvoyer une réponse d'erreur
        if (!$rapport) {
            abort(404, 'Aucun rapport trouvé pour cette activité.');
        }
    
        // Construire le chemin complet du fichier PDF
        $cheminFichier = 'public/' . $rapport->excel_file;
    
        // Vérifier si le fichier existe dans le système de fichiers
        if (Storage::exists($cheminFichier)) {
            // Extraire le nom de base du fichier pour éviter les caractères invalides
            $nomFichier = basename($rapport->excel_file);
    
            // Renvoyer le fichier PDF en réponse avec le type MIME approprié
            return Storage::download($cheminFichier, $nomFichier, [
                'Content-Type' => 'application/pdf',
            ]);
        } else {
            // Renvoyer une réponse d'erreur si le fichier n'existe pas
            return back()->with('successError', "Aucun Compte administratif trouvé pour cette commune à l'année $annee!");
        }
    }

    public function delaie(Request $request)
    {
        //
            $user_Id = auth()->id();
            $currentYear = Carbon::now()->year;
            $anneeN1 = $currentYear - 1;
            $anneeN2 = $currentYear - 2;

            $request->validate([
                'delaie' => 'required',
            ]);

            if (Carbon::parse($request->delaie)->lt(Carbon::today())) {//s'assurer que le delaie n'est pas deja passé
                return back()->with('successError', "Le delaie doit être ultérieure ou égale à la date actuelle.");
            }

            $configs = Config::where('annee', $anneeN2)
            ->where('userId', auth()->id())
            ->exists();

            if ($configs) {//s'assurer que le delaie n'est pas deja passé
                return back()->with('successError', "Vous avez déja soumis un délaie pour la dite année. si vous avez un problème avec cela veuillez juste faire la mise à jour.");
            }
        
            try {
            $config = Config::create([
                'delaie' => $request->delaie,
                'annee' => $anneeN2,
                'etat' => "Attente",
                'userId'  => $user_Id
            ]);
                    return back()->with('success', "Delaie validé avec success!");                   
        
        } catch (QueryException $e) {
            // Si une violation de contrainte d'intégrité se produit
            if ($e->getCode() === '23000' && strpos($e->getMessage(), 'users_email_unique') !== false) {
                return redirect()->back()->with('successError', "Désolé! l'adresse email {$request->email} appartient déjà à un autre utilisateur. Veillez utiliser une autre. ");
            }
            if ($e->getCode() === '23000' && strpos($e->getMessage(), 'users_telephone_unique') !== false) {
                return redirect()->back()->with('successError', "Désolé! le numero de téléphone {$request->telephone} est déjà utilisé!");
            }
            // Gérer les autres types d'erreurs ici si nécessaire
            throw $e;
        
        }
        }


        // public function viewPDFInfo(request $request, RecetteCUCAR $recette)
        // {
        //     //
        //     $recettes = RecetteCUCAR::all();
        //     $pdf = PDF::loadView('Indexation.file', array('recettes'=> $recettes), compact('recettes'))->setPaper('a4','landscape');
        // }
        
        public function generatePDF(request $request, $userId, $annee, $recette)
        {
            $recettes = RecetteCUCAR::all(); 
            $currentYear = Carbon::now()->year;
            $commune = User::find($userId);
            $recette = RecetteCUCAR::find($recette);
            $netPercevoirData = DB::table('net_percevoir_communes')
            ->join('users', 'net_percevoir_communes.userId', '=', 'users.id')
            ->join('commune_communautes', 'net_percevoir_communes.userId', '=', 'commune_communautes.carId')
            ->where('commune_communautes.cubId', $userId)
            ->where('net_percevoir_communes.annee', $annee)
            ->select(
                'users.name as commune_name', // Nom de la commune
                'users.id as commune_id',
                'net_percevoir_communes.partFixe',
                'net_percevoir_communes.partVariable',
                'net_percevoir_communes.total',
                'net_percevoir_communes.etat',
                'net_percevoir_communes.annee',
                 'net_percevoir_communes.tauxRepartition',
                  'net_percevoir_communes.totauxCommunes',
                   'net_percevoir_communes.totalTrimestriel',
            )
            ->get();


            $pdf = PDF::loadView('Indexation.file', array('recettes'=> $recettes), compact('recettes','commune','recette','currentYear','netPercevoirData'))->setPaper('a4','portrait','currentYear');
            
            // Afficher le PDF dans le navigateur
            return $pdf->stream('document.pdf');
         }
}
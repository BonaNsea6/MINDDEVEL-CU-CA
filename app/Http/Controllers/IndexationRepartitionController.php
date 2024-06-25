<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\FichierComptes;
use App\Models\RecetteCUCAR;
use App\Models\CubCar;

class IndexationRepartitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = auth()->user();
        $currentYear = Carbon::now()->year;
        $anneeN1 = $currentYear - 1;
        $anneeN2 = $currentYear - 2;
        $recettes = RecetteCUCAR::all();
        $documents = FichierComptes::all();
        return view('Indexation.gestionIndexation',['user' => $user], compact('currentYear','anneeN1','anneeN2','recettes','documents'));
    }

    public function communes()
    {
        //
        $user = auth()->user();
        $currentYear = Carbon::now()->year;
        $anneeN1 = $currentYear - 1;
        $anneeN2 = $currentYear - 2;
        $recettes = RecetteCUCAR::all();
        $documents = FichierComptes::all();
        $communes = CubCar::with(['cubUser', 'carUser'])->get();
        return view('Indexation.communesArrondissements',['user' => $user], compact('currentYear','anneeN1','anneeN2','recettes','documents','communes'));
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
    public function store(Request $request)
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
                ->where('userId', auth()->id()) // Assurez-vous d'avoir une colonne `user_id` dans votre table `fichier_comptes`
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
                $explication = "Vous avez un montant un montant du produit de recette qui est superieur à 20000000000FCFA et par conséquent le taux à appliqué est de 6% de cette recette";
            } elseif ($total >= 10000000001 && $total <= 20000000000) {
                $tauxApplique = ($total * 7) / 100;
                $explication = "Vous avez un montant un montant du produit de recette qui est dans l'interval 10000000001FCFA et 20000000000FCFA et par conséquent le taux à appliqué est de 7% de cette recette";
            } elseif ($total >= 5000000001 && $total <= 10000000000) {
                $tauxApplique = ($total * 8) / 100;
                $explication = "Vous avez un montant un montant du produit de recette qui est dans l'interval 5000000001FCFA et 10000000000FCFA et par conséquent le taux à appliqué est de 8% de cette recette";
            } elseif ($total >= 1000000001 && $total <= 5000000000) {
                $tauxApplique = ($total * 9) / 100;
                $explication = "Vous avez un montant un montant du produit de recette qui est dans l'interval 1000000001FCFA et 5000000000FCFA et par conséquent le taux à appliqué est de 9% de cette recette";
            } elseif ($total >= 500000001 && $total <= 1000000000) {
                $tauxApplique = ($total * 10) / 100;
                $explication = "Vous avez un montant un montant du produit de recette qui est dans l'interval 500000001FCFA et 1000000000FCFA et par conséquent le taux à appliqué est de 10% de cette recette";
            } elseif ($total >= 0 && $total <= 500000000) {
                $tauxApplique = ($total * 11) / 100;
                $explication = "Vous avez un montant un montant du produit de recette qui est dans l'interval 0 FCFA et 500000000FCFA et par conséquent le taux à appliqué est de 11% de cette recette";
            }
            
            $resteCUB = $total - $tauxApplique;
            $partFixe = ($tauxApplique*70)/100;
            $partVariable = $tauxApplique - $partFixe;
            
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
                    'total' => $total, // Stocker la somme calculée dans la colonne 'totalle'
                ]);

                return back()->with('success', "Recettes soumises avec succès pour l'année $anneeN2 !");
            } catch (QueryException $e) {
                // Gestion des erreurs de base de données
                if ($e->getCode() === '23000') {
                    return back()->with('successError', "Erreur lors de la soumission des documents.");
                }

                // Rethrow l'exception pour le traitement par défaut
                throw $e;
            }
        }


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
}

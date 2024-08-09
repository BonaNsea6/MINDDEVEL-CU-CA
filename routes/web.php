<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexationRepartitionController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//routes admin

Route::group([
    "middleware" => ["auth", "auth.admin"], 
    "as" => "admin."
], function(){
    Route::group([
        "prefix" => "Indexations", 
        "as" => "Indexations."
    ], function(){
        //pour la connexion des utilisateurs 
        Route::get("gestionIndexations", [IndexationRepartitionController::class, "index"])->name("gestionIndexation");
        Route::get("gestionIndexationsCommune", [IndexationRepartitionController::class, "indexCommune"])->name("gestionIndexationCommune");

        Route::post('soumettre_infor', [IndexationRepartitionController::class, 'storefileCommunaute'])->name('storefileCommunaute');
        Route::post('soumettre_informations', [IndexationRepartitionController::class, 'storefileCommune'])->name('storefileCommune');
        Route::post('soumettre_informations_commune', [IndexationRepartitionController::class, 'storeCommune'])->name('soumettreCommune');

        Route::post('soumettre_Recettes', [IndexationRepartitionController::class, 'ReiseignerRecette'])->name('soumettreRecettes');
        Route::post('soumettre_informationsCommune', [IndexationRepartitionController::class, 'ReiseignerRecetteCommune'])->name('soumettreRecettesCommune');

        Route::get("lesCommunes", [IndexationRepartitionController::class, "communes"])->name("communes");
        Route::post('calcul', [IndexationRepartitionController::class, 'calculerPartVariable'])->name('calcul');

        Route::delete('/annulerRecette{recette}', [IndexationRepartitionController::class, 'AnnulerRecette'])->name('annulerRecette');
        Route::put('/mise_à_jour_Recette/{recette}', [IndexationRepartitionController::class, 'updateRecette'])->name('updateRecette');

        Route::get("Configurations", [IndexationRepartitionController::class, "indexConfiguration"])->name("configuration"); 
        Route::post('Definir_delaie', [IndexationRepartitionController::class, 'configurerDelaie'])->name('configurerDelaie');

        Route::get("consulterCompteAdministratif", [IndexationRepartitionController::class, "consulterCompteAdministratif"])->name("consulterCompteAdministratif");

        Route::get('/rapportsPdf/{commune}/{annee}', [IndexationRepartitionController::class, 'rapportPdf'])->name('rapportPdf');

        Route::get('/rapportsExcel/{commune}/{annee}', [IndexationRepartitionController::class, 'rapportExcel'])->name('rapportExcel');

        //gestion des utilisateurs
        Route::get("gestionUtilisateurs", [UserController::class, "index"])->name("gestionUtilisateurs"); 
        Route::post('nouvelUtilisateur', [UserController::class, 'store'])->name('nouvelUser');
        Route::put('/mise_à_jour_Utilisateur/{user}', [UserController::class, 'update'])->name('updateUtilisateur');
        Route::delete('/supprimerUtilisateur/{user}', [UserController::class, 'delete'])->name('supprimerUtilisateur');
        Route::post('/affectation', [UserController::class, 'affectation'])->name('affectation');

        Route::post('/delaie', [IndexationRepartitionController::class, 'delaie'])->name('configurerDelaie');

        //pdf
        Route::post('/viewPdfAdmin{user}/{annee}/{recette}', [IndexationRepartitionController::class, 'generatePDF'])->name('viewPDF');

    });
});


Route::group([
    "middleware" => ["auth", "auth.car"], 
    "as" => "car."
], function(){
    Route::group([
        "prefix" => "Indexation", 
        "as" => "Indexation."
    ], function(){
        //pour la connexion des utilisateurs 
        Route::get("gestionIndexations", [IndexationRepartitionController::class, "indexCommune"])->name("gestionIndexationCommune");

        Route::post('soumettre_informations', [IndexationRepartitionController::class, 'storefileCommune'])->name('storefileCommune');
        Route::post('soumettre_informations_commune', [IndexationRepartitionController::class, 'storeCommune'])->name('soumettreCommune');

        //pdf
        Route::post('/viewPdfAdmin{user}/{annee}/{recette}', [IndexationRepartitionController::class, 'generatePDF'])->name('viewPDF');

    });
});


Route::group([
    "middleware" => ["auth", "auth.commune"], 
    "as" => "commune."
], function(){
    Route::group([
        "prefix" => "Indexations", 
        "as" => "Indexations."
    ], function(){
        //pour la connexion des utilisateurs 
        Route::get("gestionIndexations", [IndexationRepartitionController::class, "index"])->name("gestionIndexation");

        Route::post('soumettre_infor', [IndexationRepartitionController::class, 'storefileCommunaute'])->name('storefileCommunaute');
        Route::post('soumettre_informations_commune', [IndexationRepartitionController::class, 'storeCommune'])->name('soumettreCommune');

        Route::post('soumettre_Recettes', [IndexationRepartitionController::class, 'ReiseignerRecette'])->name('soumettreRecettes');
        Route::post('soumettre_informationsCommune', [IndexationRepartitionController::class, 'ReiseignerRecetteCommune'])->name('soumettreRecettesCommune');

        Route::get("lesCommunes", [IndexationRepartitionController::class, "communes"])->name("communes");
        Route::post('calcul', [IndexationRepartitionController::class, 'calculerPartVariable'])->name('calcul');

        Route::delete('/annulerRecette{recette}', [IndexationRepartitionController::class, 'AnnulerRecette'])->name('annulerRecette');
        Route::put('/mise_à_jour_Recette/{recette}', [IndexationRepartitionController::class, 'updateRecette'])->name('updateRecette');

        Route::get("Configurations", [IndexationRepartitionController::class, "indexConfiguration"])->name("configuration"); 
        Route::post('Definir_delaie', [IndexationRepartitionController::class, 'configurerDelaie'])->name('configurerDelaie');

        Route::get("consulterCompteAdministratif", [IndexationRepartitionController::class, "consulterCompteAdministratif"])->name("consulterCompteAdministratif");

        Route::get('/rapportsPdf/{commune}/{annee}', [IndexationRepartitionController::class, 'rapportPdf'])->name('rapportPdf');

        Route::get('/rapportsExcel/{commune}/{annee}', [IndexationRepartitionController::class, 'rapportExcel'])->name('rapportExcel');

        // //gestion des utilisateurs
        // Route::get("gestionUtilisateurs", [UserController::class, "index"])->name("gestionUtilisateurs"); 
        // Route::post('nouvelUtilisateur', [UserController::class, 'store'])->name('nouvelUser');
        // Route::put('/mise_à_jour_Utilisateur/{user}', [UserController::class, 'update'])->name('updateUtilisateur');
        // Route::delete('/supprimerUtilisateur/{user}', [UserController::class, 'delete'])->name('supprimerUtilisateur');
        // Route::post('/affectation', [UserController::class, 'affectation'])->name('affectation');

        Route::post('/delaie', [IndexationRepartitionController::class, 'delaie'])->name('configurerDelaie');

        //pdf
        Route::post('/viewPdfAdmin{user}/{annee}/{recette}', [IndexationRepartitionController::class, 'generatePDF'])->name('viewPDF');

    });
});

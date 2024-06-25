<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexationRepartitionController;

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

        Route::post('soumettre_informations', [IndexationRepartitionController::class, 'store'])->name('soumettre');
        Route::post('soumettre_Recettes', [IndexationRepartitionController::class, 'ReiseignerRecette'])->name('soumettreRecettes');

        Route::get("lesCommunes", [IndexationRepartitionController::class, "communes"])->name("communes");
    });
});

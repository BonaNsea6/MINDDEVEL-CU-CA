<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserCreated;
use App\Mail\MailNotify;
use Illuminate\Database\QueryException;
use App\Models\User;
use App\Models\FichierComptes;
use App\Models\CubCar;
use App\Models\CommuneCommunaute;
use App\Models\RecetteCUCAR;
use App\Models\RecetteCar;
use App\Models\Role;
use App\Models\NetPercevoirCommune;
use Carbon\Carbon;
use PDF;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::orderBy('id', 'desc')->paginate(10000);
        $user = auth()->user();
        $user_Id = auth()->id();
        $roles = Role::all();
        $affectedCommuneIds = CommuneCommunaute::pluck('carId')->toArray();
        return view('Admin.gestionUtilisateurs',['user' => $user, 'userId' => $user_Id], compact('users','roles','affectedCommuneIds'));
    }

    public function communes()
    {
        //
        $users = User::orderBy('id', 'desc')->paginate(10000);
        $user = auth()->user();
        $user_Id = auth()->id();
        $roles = Role::all();
        $files = FichierComptes::orderBy('userId')->get();
        $communes = CommuneCommunaute::orderBy('cubId')->get();
        $recetteCommunautes = RecetteCUCAR::orderBy('userId')->get();
        $recetteCommune = RecetteCar::orderBy('userId')->get();
        $netPercevoirData = NetPercevoirCommune::all();
        return view('Admin.communaute',['user' => $user, 'userId' => $user_Id], compact('users','roles','communes','files','recetteCommunautes','recetteCommune','netPercevoirData'));
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
        //
            $request->validate([
                'name' => 'required',
                'boite_postale' => 'required',
                'telephone' => 'required|regex:/^[0-9]{9}$/',
                'email' => 'required',
                'password' => 'required',
                'roleId' => 'required',
            ]);
        
        
            // Créer un nouvel utilisateur et enregistrer le nom du fichier (ou le chemin d'accès complet) dans la colonne "photo_path" de la base de données
            try {
            $user = User::create([
                'name' => $request->name,
                'boite_postale' => $request->boite_postale,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'roleId' => $request->roleId,
                'password' => Hash::make($request->password),
            ]);
                //gestion des mails
                // Mail::send('utilisateurs.emails',['user' => $user],
                // function($message) use ($user){
                //     $message->to($user->email);
                //     $message->subject("hello $user->nom : Inscription sur la plateforme de ENSPD");
                // });
                    return back()->with('success', "Utilisateur $user->name ajouté avec succès!");
                    return view('layouts.app1')->with('fileName', $fileName);
                    
            
                // $user->notify(new UserCreated($user));
        
        } catch (QueryException $e) {
            // Si une violation de contrainte d'intégrité se produit
            if ($e->getCode() === '23000' && strpos($e->getMessage(), 'users_email_unique') !== false) {
                return redirect()->back()->with('successError', "Désolé! l'adresse email {$request->email} appartient déjà à un autre utilisateur. Veillez utiliser une autre. ");
            }
            if ($e->getCode() === '23000' && strpos($e->getMessage(), 'users_email_unique') !== false) {
                return redirect()->back()->with('successError', "Désolé! l'adresse email {$request->email} appartient déjà à un autre utilisateur. Veillez utiliser une autre. ");
            }
            if ($e->getCode() === '23000' && strpos($e->getMessage(), 'users.users_name_unique') !== false) {
                return redirect()->back()->with('successError', "Désolé! il le   nom d'utilisateur {$request->name}   existe déja !"); 
            }
            if ($e->getCode() === '23000' && strpos($e->getMessage(), 'users.users_boite_postale_unique') !== false) {
                return redirect()->back()->with('successError', "Désolé! il la boite postale {$request->boite_postale}   existe déja !"); 
            }
            // Gérer les autres types d'erreurs ici si nécessaire
        
            // Rethrow l'exception pour le traitement par défaut
            throw $e;
        
        }
        }


        public function affectation(Request $request)
    {
        //
            $request->validate([
                'communesId' => 'required',
                'comId' => 'required',
            ]);
        
            try {
            $CubCar = CommuneCommunaute::create([
                'cubId' => $request->comId,
                'carId' => $request->communesId,
            ]);
                    return back()->with('success', "Affectation réussie avec success!");                   
        
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
    public function update(Request $request, user $user)
    {
        //
        $request->validate([
            'name' => 'required',
            'boite_postale' => 'required',
            'telephone' => 'required|regex:/^[0-9]{9}$/',
            'email' => 'required',
            'password' => 'required',
            'roleId' => 'required',          
        ]);

        // $file = $request->file('photo');
        // $fileName = time() . '_' . $file->getClientOriginalName();
        // $file->storeAs('photos', $fileName, 'public');

        $user->update([
                'name' => $request->name,
                'boite_postale' => $request->boite_postale,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'roleId' => $request->roleId,
                'password' => Hash::make($request->password),
        ]);
        return back()->with('success', 'Utilisateur mis à jour avec success!');
    }

    public function delete(user $user)
    {
        $nom_complet = $user->name;
        $user->delete();
        return back()->with('success', " Utilisateur  $nom_complet supprimer avec success!");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function generateCommunePDF(request $request)
    {
        $communes = CommuneCommunaute::orderBy('cubId')->get();
        $pdf = PDF::loadView('Admin.communauteFile', array('communes'=> $communes), compact('communes'))->setPaper('a4','portrait');
        
        // Afficher le PDF dans le navigateur
        return $pdf->stream('communes.pdf');
     }
     public function generateRecetteCommunePDF(request $request)
     {
         $recetteCommunautes = RecetteCUCAR::orderBy('userId')->get();
         $pdf = PDF::loadView('Admin.recetteCommunauteFile', array('recetteCommunautes'=> $recetteCommunautes), compact('recetteCommunautes'))->setPaper('a4','landscape');
         
         // Afficher le PDF dans le navigateur
         return $pdf->stream('recetteCommunautes.pdf');
      }

      public function generateRecetteComPDF(request $request)
      {
          $recetteCommunes = RecetteCar::orderBy('userId')->get();
          $pdf = PDF::loadView('Admin.recetteCommuneFile', array('recetteCommunes'=> $recetteCommunes), compact('recetteCommunes'))->setPaper('a4','landscape');
          
          // Afficher le PDF dans le navigateur
          return $pdf->stream('recetteCommunes.pdf');
       }
}

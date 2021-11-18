<?php

namespace App\Http\Controllers;

use App\Mail\EMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Client;
use App\Models\Etablissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{

    // Elle retourne la vue home du restaurant
    public function homeClient()
    {
        return view('client.home');
    }
    // Inscription d'un client
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        $input['email'] = $request['email'];

        $rules = array('email' => 'unique:users,email');

        $validator = Validator::make($input, $rules);

        if ($validator->fails())
        {
            return back()->with(session()->flash('alert-success', "Cette adresse e-mail est déjà enregistrée. Vous êtes sûr de ne pas avoir de compte ?"));
        }else{

        $client = new User();
        $client->nameE = $request->nom;
        $client->name = null;
        $client->email = $request->email;
        $client->statut = 'client';
        $client->is_admin = 0;
        $client->is_actived = 0;
        $client->approved = 0;
        $client->password = Hash::make($request->password);
        $client->save();

        Client::create([
            'user_id' => $client->id,
        ]);

        Mail::to($request->email)->send(new EMail($client));

        return redirect('login')->with(session()->flash('alert-success', "Votre demande de creation de compte a bien été enregistré, valider votre compte.Merci!!!  "));
        }
    }

    // listes des enseignes
    public function listes()
    {
        $listeEnseignes =  User::has('etablissement')->get();
        return view('client.listeEnseigne',compact('listeEnseignes'));
    }

    public function searchEnseigneByClient()
    {
        $query = request()->get('rechercher');
        $listeEnseignes = User::where('name', 'LIKE',"%$query%")->get();
        if(request()->ajax()){
            return response()->json($listeEnseignes);
        }else{
            return view('client.listeEnseigne',compact('listeEnseignes'));
        }
    }

    public function searchEnseigneByClientAdvanced()
    {
        $q = request()->restaurant;
        $query = request()->get('search');
        if($q == 'restaurant')
        {
            $listeEnseigne = User::where('name', 'LIKE',"%$query%")->get();
            return response()->json($listeEnseigne);
        }

        // $query = request()->get('restau');
        // $listeEnseigne = User::where('type', 'LIKE',"%$query%")->get();

        // return response()->json($listeEnseigne);

    }
     // Fonction qui permet de valider le compte client par gmail
     public function verify($id, $verification)
     {
         $user = User::where('id', $id)->where('is_actived',$verification)->first();
         if($user)
         {
             $user->is_actived = 1;
             $user->update();

             return redirect()->route('login')->with(session()->flash('alert-success', ' Compte verifié. Connectez-vous!'));
         }else{
             return redirect()->route('login')->with(session()->flash('alert-danger', 'Email deja verifié!'));
         }
     }

     //renvoie la vue edit
     public function edit(User $user)
     {
         $comptes = Client::has('user')->get();
         return view('client.edit', compact('comptes', 'user'));
     }

     // Mise a jour du compte profil
     public function update(User $user, Request $request)
     {
         $data = $request->validate([
             'client_adresse' => '',
             'client_photo' => '',
             'client_numero' => '',
             'longitude' => '',
             'latitude' => '',
         ]);

             if ($request->hasFile('client_photo')){
                 $image_path = public_path("/photoProfile/".$user->client->client_photo);
                 if (File::exists($image_path)) {
                     File::delete($image_path);
                 }
                 $bannerImage = $request->file('client_photo');
                 $imgName = $bannerImage->getClientOriginalName();
                 $destinationPath = public_path('/photoProfile/');
                 $bannerImage->move($destinationPath, $imgName);
               } else {
                 $imgName = $user->client->client_photo;
               }
               $user->client->client_photo= $imgName;
             Auth()->user()->client->update(array_merge($data, ['client_photo' => $imgName]));
             // update for user
             $data = request()->validate([
                 'nom' => 'required',
                 'email' => 'required',
             ]);
             $user->update($data);

             return back()->with(session()->flash('alert-success', "Mise a jour effectuée "));
     }

}

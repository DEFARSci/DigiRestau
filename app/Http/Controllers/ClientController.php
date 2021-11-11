<?php

namespace App\Http\Controllers;

use App\Mail\EMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\User;

class ClientController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // La vue accueil
    public function homeClient()
    {
        return view('client.home');
    }
    // elle permet  d'ajouter un client dans la BD
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        $client = new User();
        $client->name = $request->nom;
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
     // Fonction qui permet de valider le compte
     public function verify($verification)
     {
         $user = User::where('is_actived',$verification)->first();
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

<?php

namespace App\Http\Controllers;

use App\Mail\EMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Etablissement;
use App\Models\TypeRestaurant;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewUser;
class RestaurantController extends Controller
{

    // La vue accueil
    public function homeRestaurant()
    {
        return view('restaurant.home');
    }

    //renvoie la vue edit
    public function edit(User $user)
    {
        $comptes = Etablissement::has('user')->get();
        return view('restaurant.edit', compact('comptes', 'user'));
    }

    // Mise a jour du compte
    public function update(User $user, Request $request)
    {
        $data = $request->validate([
            'etablissement_logo' => '',
            'etablissement_numero_tel' => '',
            'etablissement_adresse' => '',
            'longitude' => '',
            'latitude' => '',
        ]);

            if ($request->hasFile('etablissement_logo')){
                $image_path = public_path("/photoProfile/".$user->etablissement->etablissement_logo);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $bannerImage = $request->file('etablissement_logo');
                $imgName = $bannerImage->getClientOriginalName();
                $destinationPath = public_path('/photoProfile/');
                $bannerImage->move($destinationPath, $imgName);
              } else {
                $imgName = $user->etablissement->etablissement_logo;
              }
              $user->etablissement->etablissement_logo = $imgName;
            Auth()->user()->etablissement->update(array_merge($data, ['etablissement_logo' => $imgName]));
            // update for user
            $data = request()->validate([
                'nom' => 'required',
                'email' => 'required',
                'type' => '',
            ]);
            $user->update($data);

            return back()->with(session()->flash('alert-success', "Mise a jour effectuée "));
    }

 // elle permet  d'ajouter un restaurant dans la BD
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        $restau = new User();
        $restau->name = $request->nom;
        $restau->email = $request->email;
        $restau->type = $request->type;
        $restau->statut = 'enseigne';
        $restau->is_actived  = 0;
        $restau->is_admin = 0;
        $restau->approved = 0;
        $restau->password = Hash::make($request->password);
        $restau->save();

        Etablissement::create([
            'user_id' => $restau->id,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);

        return redirect('login')->with(session()->flash('alert-success', "Votre demande de creation de compte a bien été enregistré, il sera validé sous peu de temps.Merci!!!  "));
    }

    // Fonction qui renvoie la vue rechercher

    public function search()
    {
        return view('restaurant.search');
    }

    // Fonction qui permet de filtrer automatiquement les noms des restaurants dans la BD

    public function searchAutomatic(Request $request)
    {

        $datas= User::select('name')
                            ->where('name', 'like', "%{$request->term}%")
                            ->pluck('name');
        return response()->json($datas);
    }
}

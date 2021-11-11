<?php

namespace App\Http\Controllers;

use App\Mail\EMail;
use App\Models\CategorieConso;
use App\Models\Consommation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Etablissement;
use App\Models\OptionConsommation;
use App\Models\TypeRestaurant;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewUser;
class RestaurantController extends Controller
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
    public function homeRestaurant()
    {
        $cateConso = CategorieConso::all();
        $Consommation = Consommation::all();
        $conso = Consommation::has('user')->get();
        $optionconso = OptionConsommation::has('user')->get();
        $categories = CategorieConso::orderBy('id','DESC')->get();
        return view('restaurant.home',compact('cateConso','conso','categories','Consommation','optionconso'));
    }
//
    public function makeunactive(Consommation $conso)
    {
        $conso->statut = 1;
        $conso->update();
        return back();
    }

    public function makeactive(Consommation $conso)
    {
        $conso->statut = 0;
        $conso->update();

        return back();
    }

    //Ajout consommation
    public function addConso(Request $request)
    {
        $conso = new Consommation();
        $conso->user_id = Auth::user()->id;
        $conso->consommation_titre = $request->title;
        $conso->consommation_description = $request->description;
        $conso->consommation_prix = $request->prix;

        $imageName = null;

            if(request()->hasFile('image')){
                $uploadedImage = $request->file('image');
                $imageName = time() . '.' . $uploadedImage->getClientOriginalExtension();
                $destinationPath = public_path('/storage/');
                $uploadedImage->move($destinationPath, $imageName);
                $uploadedImage->imagePath = $destinationPath . $imageName;
            }

        $conso->consommation_image = $imageName;
        $conso->consommation_categorie_id = $request->categorie;

        $conso->save();

        return back()->with(session()->flash('alert-success', "Consommation Ajoutée "));
    }

    //Ajout Option consommation
    public function addOptionConso(Request $request)
    {
        $conso = new OptionConsommation();
        $conso->user_id = Auth::user()->id;
        $conso->option_conso_titre = $request->title;
        $conso->option_conso_description = $request->description;
        $conso->option_conso_prix = $request->prix;
        $conso->consommation_id = $request->conso;

        $conso->save();

        return back()->with(session()->flash('alert-success', "Option consommation Ajoutée "));
    }
    //delete option Consommation
    public function deleteOptionConso($option)
    {
        $option = OptionConsommation::find($option);
        $option->delete();
        return back()->with(session()->flash('alert-success', "Option Consommation Supprimée "));
    }

    //delete Consommation
    public function deleteConso($conso)
    {
        $consommation = Consommation::find($conso);
        $consommation->delete();
        return back()->with(session()->flash('alert-success', "Consommation Supprimée "));
    }
     //delete Categorie
    public function deleteCat($cat)
    {
         $cat = CategorieConso::find($cat);
         $cat->delete();
         return back()->with(session()->flash('alert-success', "Categorie Supprimée "));

    }
     // update option conso
     public function editOptionConso($option)
     {
         $options = OptionConsommation::find($option);
         $conso = Consommation::has('user')->get();
        return view('consommation.edit',compact('options','conso'));
     }
     public function updateOptionConso(Request $request, $option)
     {
         $options = OptionConsommation::find($option);
         $options->option_conso_titre = $request->title;
         $options->option_conso_description = $request->description;
         $options->option_conso_prix = $request->prix;
         $options->consommation_id = $request->conso_id;
         $options->save();
         return back()->with(session()->flash('alert-success', "Option consommation Modifiée "));
     }
    // update categorie
    public function editCat($cat)
    {
        $categories = CategorieConso::find($cat);
       return view('categorie.edit',compact('categories'));
    }

    public function updateCat(Request $request, $cat)
    {
        $categories = CategorieConso::find($cat);
        $categories->categorie_nom = $request->title;
        $categories->categorie_description = $request->description;
        $categories->save();
        return back()->with(session()->flash('alert-success', "Categorie Modifiée "));
    }
    //update Consommation
    public function updateConso(Request $request, $con)
    {
        $consommations = Consommation::find($con);
        $consommations->consommation_titre= $request->title;
        $consommations->consommation_description = $request->description;
        $consommations->consommation_prix = $request->prix;
        if ($request->hasFile('image')){
            $image_path = public_path("/storage/".$consommations->consommation_image);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $bannerImage = $request->file('image');
            $imgName = $bannerImage->getClientOriginalName();
            $destinationPath = public_path('/storage/');
            $bannerImage->move($destinationPath, $imgName);
          } else {
            $imgName = $consommations->consommation_image;
          }
          $consommations->consommation_image= $imgName;
        $consommations->consommation_categorie_id = $request->categorie;

        $consommations->save();
        return back()->with(session()->flash('alert-success', "Consommation Modifiée "));
    }

    // Ajout Ctegorie conso
    public function addCategorieConso(Request $request)
    {
        //dd($request);
        $categories = new CategorieConso();
        $categories->user_id = Auth::user()->id;
        $categories->categorie_nom = $request->title;
        $categories->categorie_description = $request->description;

        $categories->save();
        return back()->with(session()->flash('alert-success', "Categorie Ajoutée "));

        //dd($categories);
    }

    //renvoie la vue edit
    public function edit(User $user)
    {
        $comptes = Etablissement::has('user')->get();
        return view('restaurant.edit', compact('comptes', 'user'));
    }

    // Mise a jour du compte profil membre
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

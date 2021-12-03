<?php

namespace App\Http\Controllers;

use App\Models\Consommation;
use App\Models\Etablissement;
use App\Models\OptionConsommation;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function index()
    {
        $enseignes = Etablissement::has('user')->get();
        return view('accueil', compact('enseignes'));
    }

    public function show($user)
    {
        $conso = Consommation::where('user_id',$user)->get();
        //session(['conso' => [] ]);
        session('conso');
        $optionConso = OptionConsommation::has('user')->get();
        return view('menu.index', compact('conso','optionConso'));
    }

    // public function showMenu($menu)
    // {
    //     if(request()->menu){
    //         $conso = Consommation::where('consommation_categorie_id',request()->menu)->get();

    //     }else{
    //         $conso = Consommation::where('user_id',$menu)->get();
    //     }

    //     return view('menu.index', compact('conso'));
    // }


}

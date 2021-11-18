<?php

namespace App\Http\Controllers;

use App\Models\TypeRestaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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
    public function admin()
    {
        // $users = User::where('approved')->get();
        //$users = DB::table('users')->get();
        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.home', compact('users'));
    }

    // elle permet d'accepter les identifiants d'un new membre inscrit

    public function approved(Request $request, $user)
    {
        $data = User::find($user);
        if($data->statut == 'enseigne'){
            if($data->approved == 0)
            {
                $data->approved = 1;
            }else{
                $data->approved = 0;
            }

            $data->save();
        }
        return redirect()->back()->with(session()->flash('alert-success', 'Mise a jour effectue!'));
    }

    //Ajout type enseigne
    public function addType(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $typeR = new TypeRestaurant();
        $typeR->type = $request->name;
        $typeR->save();
        return redirect()->back()->with(session()->flash('alert-success', 'Type enseigne ajoutée!'));
    }
    public function ListeType()
    {
        return view('admin.listeType');
    }
}

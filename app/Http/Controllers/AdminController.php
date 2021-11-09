<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function admin()
    {
        // $users = User::where('approved')->get();
        //$users = DB::table('users')->get();
        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.home', compact('users'));
    }

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
}

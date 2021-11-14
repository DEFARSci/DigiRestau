<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function addLogin(Request $request)
    {
        $user = $request->all();
        $this->validate($request,[
            'email' =>'required|email',
            'password' => 'required',
        ]);
        $email = User::where('email',$user['email'])->count();
        if($email > 0)
        {
            //admin
            if(Auth::attempt(['email' => $user['email'], 'password' => $user['password'], 'is_admin' => 1])) {
                return redirect('/admin');
            }

            //client
            if(Auth::attempt(['email' => $user['email'], 'password' => $user['password'], 'statut' => 'client','is_actived' => 1])) {
                return redirect('/home/client');

            }elseif(Auth::attempt(['email' => $user['email'], 'password' => $user['password'], 'statut' => 'enseigne','is_actived' => 1,'approved' => 1])) {
                return redirect('/home/restaurant');
            }else{
                return redirect('login')->with(session()->flash('alert-danger', "Votre compte n'est pas activé!"));
            }
        }else
        {
            return redirect('login')->with(session()->flash('alert-danger', "Email incorrect.!!!  "));
        }
    }
}

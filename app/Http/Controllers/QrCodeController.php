<?php

namespace App\Http\Controllers;

use App\Models\Consommation;
use App\Models\Token_order;
use Carbon\Carbon;
use DateTime;
use Facade\FlareClient\Time\Time as TimeTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Ramsey\Uuid\Type\Time;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function index()
    {
        $tokens = Token_order::has('user')->get();
        return view('qrcode.index',compact('tokens'));
    }

    public function qrcodeAdd(Request $request)
    {
        $dateNow =  new DateTime('now');
        $dureeOffDateTime = new DateTime(date('Y-m-d H:m:s',strtotime($request->dureef)));

        //$interval = $dateNow->diff($dureeOffDateTime);
        //dd($interval);
        if($dateNow < $dureeOffDateTime)
        {
            Token_order::create([
            'token_order_table' => $request->table,
            'token_order_duration_fin' => $dureeOffDateTime,
            'token_order_etablissement_id' => Auth::user()->id,
            'token_order_token' => bcrypt(Auth::user()->name.Auth::user()->type),
        ]);
        return back()->with(session()->flash('alert-success', "Information generée"));

        }else{
            return back()->with(session()->flash('alert-danger', "L'heure d'expiration est incorecte"));

        }
    }

    public function show($qrcode)
    {

        $token = Token_order::find($qrcode);

        $dateNow =  new DateTime('now');
        $dureeOffDateTime = new DateTime(date('Y-m-d H:m:s',strtotime($token->token_order_duration_fin)));

        //dd($dateNow, $dureeOffDateTime);
        if($dureeOffDateTime > $dateNow)
        {
            $conso=Consommation::where('user_id', Auth::user()->id)->get();
            $qrcode = QrCode::format('png')->size(400)->errorCorrection('H')->generate('http://127.0.0.1:8000/voirMenu/'.$conso);

        }else{
            $qrcode = QrCode::format('png')->size(400)->errorCorrection('H')->generate('Qr code expiré');
        }
        return view('qrcode.show',compact('token','qrcode'));
    }
}

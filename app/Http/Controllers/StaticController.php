<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaticController extends Controller
{
    public function static(Request $request)
    {

        $actualYear = $request->year;
        // Années disponibles
        $years = range(Commande::oldest()->first()->created_at->year, now()->year);

        return view('charts.index',compact('years','actualYear'));
    }

    public function index(Request $request){

            $record = Commande::selectRaw("COUNT(*) count, DAYNAME(created_at) as day_name,DAY(created_at) as day")
            ->where('created_at', '>', Carbon::today()->subDay(6))
            ->groupBy('day_name','day')
            ->orderBy('day')
            ->get();

            $data = [];

            foreach($record as $row) {
                $data['label'][] = $row->day_name;
                $data['data'][] = (int) $row->count;
            }

            $data['chart_data'] = json_encode($data);
        return view('charts.index2', $data);
    }
}

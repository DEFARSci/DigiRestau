<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Commande;
use App\Models\Order;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class ChartStatic extends CommonChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        return $this->chartisan(new Commande, 'Commandes');

    }
}

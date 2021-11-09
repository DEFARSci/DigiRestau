<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commande;
use App\Models\OptionConsommation;

class OptionCommande extends Model
{
    use HasFactory;

    protected $fillable = [
        'option_commande_nbre',
        'option_commande_consommation',
        'option_commande_consommation_id',
        'option_commande_commande_id'
    ];


    public function optionConso()
    {
        return $this->belongsTo(OptionConsommation::class);
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}

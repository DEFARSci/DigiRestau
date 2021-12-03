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
        'quantite',
        'option_commande_consommation_id',
        'option_commande_commande_id',
        'user_id',
    ];


    public function consommations()
    {
        return $this->hasMany(Consommation::class,'option_commande_consommation_id');
    }

    public function Commande()
    {
        return $this->belongsTo(Commande::class,'option_commande_commande_id','quantite');
    }

    public function user()
    {
        return $this->hasOne(User::class,'user_id','quantite');
    }
}

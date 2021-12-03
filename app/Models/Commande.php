<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OptionCommande;
use App\Models\User;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [

        'statut',
        'Type_livraison',
        'numero_table',
        'commande_added_dateTime',
        'consommation_id',
        'enseigne_id',
        'commande_user_id'
    ];

    public function OptionCommandes()
    {
        return $this->hasMany(OptionCommande::class);
    }
    public function consommations()
    {
        return $this->belongsTo(Consommation::class,'consommation_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'commande_user_id');
    }

    public function enseigne()
    {
        return $this->belongsTo(User::class,'enseigne_id');
    }
}

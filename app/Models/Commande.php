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
        'commande_prix',
        'commande_statut',
        'commande_table',
        'commande_livraison',
        'commande_added_dateTime',
        'commande_startcook_dateTime',
        'commande_endcook_dateTime',
        'commande_done_dateTime'
    ];


    public function optionsCommande()
    {
        return $this->hasMany(OptionCommande::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategorieConso;
use App\Models\OptionConsommation;

class Consommation extends Model
{
    use HasFactory;

    protected $fillable = [
        'consommation_titre',
        'consommation_description',
        'consommation_prix',
        'consommation_image',
        'consommation_categorie_id',
        'user_id'
    ];

    public function categorie()
    {
        return $this->belongsTo(CategorieConso::class,'consommation_categorie_id');
    }

    public function optionsConso()
    {
        return $this->hasMany(OptionConsommation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commande()
    {
        return $this->hasMany(Commande::class);
    }
}

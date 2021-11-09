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
        'consommation_statut',
        'consommation_added_dateTime',
        'consommation_categorie_id',
    ];

    public function categorie()
    {
        return $this->belongsTo(CategorieConso::class);
    }

    public function optionsConso()
    {
        return $this->hasMany(OptionConsommation::class);
    }
}

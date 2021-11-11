<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consommation;
use App\Models\OptionCommande;

class OptionConsommation extends Model
{
    use HasFactory;

    protected $fillable = [
        'option_conso_prix',
        'option_conso_titre',
        'consommation_id',
        'option_conso_description'
    ];

    public function consomation()
    {
        return $this->belongsTo(Consommation::class,'consommation_id');
    }

    public function optionsCommandes()
    {
        return $this->hasMany(OptionCommande::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

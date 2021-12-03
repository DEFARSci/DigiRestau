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
        'option_conso_description',
        'user_id'
    ];

    public function consomation()
    {
        return $this->belongsTo(Consommation::class,'consommation_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPriceConso(){
        $prix = $this->option_conso_prix/1000;
        return number_format($prix,3,'.',' ') . ' CFA';
    }

    public function getBuyableIdentifier(){
        return $this->id;
    }

    public function getBuyableDescription(){
        return $this->option_conso_titre;
    }

    public function getBuyablePrice(){
        return $this->option_conso_prix;
    }


}

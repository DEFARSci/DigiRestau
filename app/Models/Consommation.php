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

    public function getBuyableIdentifier(){
        return $this->id;
    }

    public function getBuyableName(){
        return $this->consommation_titre;
    }

    public function getBuyablePrice(){
        return $this->consommation_prix;
    }


    public function getPrice(){
        $prix = $this->consommation_prix/1000;
        return number_format($prix,3,'.',' ') . ' CFA';
    }

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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function commande()
    {
        return $this->hasMany(Commande::class);
    }

    public function optionCommande()
    {
        return $this->belongsTo(OptionCommande::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Etablissement;
use App\Models\Consommation;
use App\Models\User;

class CategorieConso extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie_nom',
        'categorie_description',
        'user_id',
    ];

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consommations()
    {
        return $this->hasMany(Consommation::class);
    }
}

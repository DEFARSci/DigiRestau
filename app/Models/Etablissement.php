<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategorieConso;
use App\Models\Token_order;

class Etablissement extends Model
{
    use HasFactory;

    protected $fillable = [
        'etablissement_logo',
        'etablissement_numero_tel',
        'etablissement_adresse',
        'longitude',
        'latitude',
        'user_id'
    ];

    public function categories()
    {
        return $this->hasMany(CategorieConso::class);
    }

    public function tokens()
    {
        return $this->hasMany(Token_order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

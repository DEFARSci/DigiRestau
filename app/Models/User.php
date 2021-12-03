<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Commande;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'nameE',
        'email',
        'password',
        'statut',
        'type',
        'is_actived',
        'is_admin',
        'approved'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function categoriesConso()
    {
        return $this->hasMany(CategorieConso::class);
    }

    public function optionConso()
    {
        return $this->hasMany(OptionConsommation::class);
    }
    public function consommations()
    {
        return $this->hasMany(Consommation::class);
    }

    public function typesResta()
    {
        return $this->hasOne(TypeRestaurant::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function etablissement()
    {
        return $this->hasOne(Etablissement::class);
    }

   public function tokens(){
       return $this->hasMany(Token_order::class);
   }
}

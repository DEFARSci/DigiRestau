<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_adresse',
        'client_numero',
        'client_photo',
        'longitude',
        'latitude',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

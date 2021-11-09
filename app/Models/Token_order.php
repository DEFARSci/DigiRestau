<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Etablissement;

class Token_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'token_order_token',
        'token_order_table',
        'token_order_duration',
        'token_order_added_dateTime',
        'token_order_etablissement_id'
    ];

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }
}

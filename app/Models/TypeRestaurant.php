<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRestaurant extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

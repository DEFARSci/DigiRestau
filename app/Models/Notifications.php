<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    protected $fillable = [
        'type', 'sender', 'recipient', 'sending_date',
    ];
    public function user()
    {
         return $this->belongsTo('App\Models\User');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'transaction_type',
        'status',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanPayment extends Model
{
    protected $fillable = [
        'loan_id',
        'user_id',
        'amount',
        'balance_after',
    ];

    // ✅ FIX: relationship to Loan
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    // optional but useful
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'balance',
         'loan_type',
        'term_months',
        'monthly_installment',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
        
    }
      // ✅ ADD THIS RELATIONSHIP
    public function payments()
    {
        return $this->hasMany(LoanPayment::class);
    }
}

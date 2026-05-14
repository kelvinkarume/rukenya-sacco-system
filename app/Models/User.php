<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'name',
    'email',
    'password',
    'phone_number',
    'year_of_birth',
    'home_place',
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function savings()
{
    return $this->hasMany(\App\Models\Saving::class);
}

public function approvedSavings()
{
    return $this->savings()->whereIn('status', ['completed', 'approved']);
}

public function availableSavings()
{
    return $this->approvedSavings()->sum('amount');
}

public function loans()
{
    return $this->hasMany(\App\Models\Loan::class);
}

public function loanPayments()
{
    return $this->hasMany(\App\Models\LoanPayment::class);
}

public function notifications()
{
    return $this->hasMany(Notification::class);
}
}

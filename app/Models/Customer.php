<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Customer extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'contact_number',
        'company_name',
        'designation',
        'company_address',
        'sales_executive',
        'role',
        'password', // Ensure this is included
        'role_id'
    ];

    
    protected $hidden = ['password'];

    public function pointHistories(): HasMany
    {
        return $this->hasMany(PointHistory::class, 'customer_id');
    }

    public function getCurrentBalance()
    {
        // Calculate total points added and subtracted for the user
        $totalPointsAdded = PointHistory::where('customer_id', $this->id)
            ->sum('point_add');

        $totalPointsSubtracted = PointHistory::where('customer_id', $this->id)
            ->sum('point_minus');

        // Calculate the current balance
        $currentBalance = $totalPointsAdded - $totalPointsSubtracted;

        return $currentBalance;
    }
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'user_id'); // Specify the foreign key column here
    }
}

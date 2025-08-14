<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
    ];

    public function responses()
    {
        return $this->hasMany(TicketResponse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

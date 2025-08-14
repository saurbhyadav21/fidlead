<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedLead extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'lead_id','buyer_name', 'data_type'];
}

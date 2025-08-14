<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    // Define a relationship for buyer data
    public function buyerSellerData()
    {
        return $this->belongsTo(BuyerSellerData::class, 'row_id', 'id');
    }

    // Define a relationship for supplier data
    public function sellerSellerData()
    {
        return $this->belongsTo(SellerSellerData::class, 'row_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerSellerData extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_type', 
        'buyer_country', 
        'unloading_port',  // Corresponds to delivery_port
        'mode',
        'loading_country', 
        'loading_port', 
        'hs_02', 
        'business_category', 
        'hs_04', 
        'sub_category_i', 
        'hs_code_08', 
        'sub_category_ii', 
        'product_description', 
        'buyer_code',
        'buyer_name',
        'buyer_address', 
        'buyer_city',
        'pin_code', 
        'buyer_state', 
        'country_code',
        'buyer_phone',
        'buyer_mobile_ii',
        'buyer_email_i',
        'buyer_email_ii', 
        'website', 
        'contact_person',
        'show_contact_details',
        'call_button', 
        'whatsapp_button',
        'report_contact',  // Missing field
        'save_to_favorite',
        'edit_contact',     // Missing field
        'duplicate_filter'
    ];
}


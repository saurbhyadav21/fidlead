<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerSellerData extends Model
{
    use HasFactory;

    // Define which attributes are mass assignable
    protected $fillable = [
        'data_type',
        'supplier_country',
        'loading_port',
        'mode',
        'unloading_port',
        'unloading_country',
        'hs_02',
        'business_category',
        'hs_04',
        'sub_category_i',
        'hs_code_08',
        'sub_category_ii',
        'product_description',
        'supplier_code',
        'supplier_name',
        'supplier_address',
        'supplier_city',
        'supplier_pin_code',
        'supplier_state',
        'country_code',
        'supplier_phone',
        'supplier_mobile',
        'supplier_email_i',
        'supplier_email_ii',
        'supplier_website',
        'contact_person',
        'show_contact_details',
        'call_button',
        'whatsapp_button',
        'report_contact',
        'save_to_favorite',
        'edit_contact',
        'duplicate_filter'
    ];
}

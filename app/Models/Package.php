<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    // Specify the table associated with the model if it's not the plural form of the model name
    protected $table = 'packages';

    // Allow mass assignment for these fields
    protected $fillable = [
        'package_name',
        'package_type',
        'package_point',
        'package_cost',
    ];

    // Optionally, specify the dates if you want to handle the timestamps automatically
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}

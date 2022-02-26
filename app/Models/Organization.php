<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $table = 'organization';

    protected $fillable = [
        'user_id',
        'org_name',
        'street',
        'house_number',
        'postal_code',
        'location',
        'country',
        'phone',
        'fax',
        'image',
        'description',
        'ideas',
    ];
}

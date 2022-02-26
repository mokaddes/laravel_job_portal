<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocailProfile extends Model
{
    use HasFactory;

    protected $table = 'socail_profiles';

    protected $fillable = [
        'user_id',
        'facebook',
        'twitter',
        'linkedin',
    ];
}

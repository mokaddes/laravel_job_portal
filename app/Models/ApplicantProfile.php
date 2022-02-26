<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantProfile extends Model
{
    use HasFactory;

    protected $table = 'resumes';

    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'image'

    ];
}

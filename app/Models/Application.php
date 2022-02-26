<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';

    protected $fillable = [
        'job_id',
        'recruiter_id',
        'applicant_id',
        'applicant_name',
        'resume_id',
        'email',
        'job_title',
        'apply_date',
        'company_name'

    ];
}

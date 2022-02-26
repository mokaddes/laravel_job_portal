<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = ['site_name','site_logo','site_lang','time_zone','site_lang_id','time_zone_id', 'app_mode'];
}

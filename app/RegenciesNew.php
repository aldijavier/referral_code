<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegenciesNew extends Model
{
    protected $table = 'regencies_new';
    
    protected $fillable = ['name', 'province_id', 'initials'];
}

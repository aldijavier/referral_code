<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regencies extends Model
{
    protected $table = 'regencies';
    
    protected $fillable = ['name', 'province_id'];
}

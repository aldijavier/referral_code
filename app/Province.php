<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinsi_indonesia';
    
    protected $fillable = ['nama', 'id'];
}

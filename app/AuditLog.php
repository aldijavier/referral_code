<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    // use HasFactory;
    protected $table = 'audit_logs';
    protected $fillable =[
        'username',
        'ip_address',
        'location',
        'access_from',
        'activity'
    ];
}

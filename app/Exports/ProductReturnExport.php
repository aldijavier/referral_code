<?php

namespace App\Exports;
use App\AuditLog;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class ProductReturnExport implements FromCollection, WithHeadings
{
    protected $date_start;
    protected $date_finish;
    function __construct($date_start,$date_finish,$type) {
        $this->date_start = $date_start;
        $this->date_finish = $date_finish;
    }

    public function collection()
    {
        $query=DB::table('audit_logs')
        ->whereBetween(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), [$this->date_start, $this->date_finish])
        ->select('id',
        'username',
        'ip_address',
        'location',
        'access_from',
        'activity',
        'created_at',
        )->get();
        //dd($query);
        //dd($query);
        return $query;
    }

    public function headings(): array
    {   return [
            'ID', 
            'Username',  
            'IP Address', 
            'Location',  
            'Access From', 
            'Activity', 
            'Access Date',
        ];
    }
}

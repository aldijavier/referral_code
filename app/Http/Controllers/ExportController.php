<?php

namespace App\Http\Controllers;

use App\Exports\LogAssignExport;
use App\Exports\LogsAssignBulkExport;
use App\Models\Ticket;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketExport;
use App\Exports\ProductKeluarExport;
use App\Exports\ProductReturnExport;
use App\Traits\AuditLogsTrait;
use Browser;

class ExportController extends Controller
{
    use AuditLogsTrait;
    public function rfo($id)
    {
    	$ticket = Ticket::where('tickets.id',$id)
        ->leftjoin('customers','tickets.cid','=','customers.cid')
        ->get();
        
        if($ticket[0]->hold_by==''){
            $pdf = PDF::loadview('ticket_external.rfo_download',['ticket'=>$ticket]);
    	    return $pdf->download($ticket[0]->rfo.'.pdf');
            //return view('ticket_external.rfo_download');
        }
        else{
            $pdf = PDF::loadview('ticket_external.rfo_download_hold',['ticket'=>$ticket]);
    	    return $pdf->download($ticket[0]->rfo.'.pdf');
        }
    }
    public function rfoMaintenance($id)
    {
    	$ticket = Ticket::where('tickets.id',$id)
        ->leftjoin('customers','tickets.cid','=','customers.cid')
        ->leftjoin('mapping_incident','tickets.type_incident','=','mapping_incident.id')
        ->get();
        
        if($ticket[0]->hold_by==''){
            $pdf = PDF::loadview('ticket_maintenance.rfoMaintenance_download',['ticket'=>$ticket]);
    	    return $pdf->download($ticket[0]->rfo.'.pdf');
            //return view('ticket_external.rfo_download');
        }
        else{
            $pdf = PDF::loadview('ticket_external.rfo_download_hold',['ticket'=>$ticket]);
    	    return $pdf->download($ticket[0]->rfo.'.pdf');
        }
    }
    public function export(Request $request)
    {
        // dd($request);
        $request->validate([
            'date_start' => 'required|date',
            'date_finish' => 'required|date|after_or_equal:date_start',
        ]);

        return Excel::download(new TicketExport($request->date_start,$request->date_finish,$request->type),'Product Masuk Summary Report.xlsx');
    }

    public function exportkeluar(Request $request)
    {
        // dd($request);
        $request->validate([
            'date_start' => 'required|date',
            'date_finish' => 'required|date|after_or_equal:date_start',
        ]);

        return Excel::download(new ProductKeluarExport($request->date_start,$request->date_finish,$request->type),'Product Keluar Summary Report.xlsx');
    }

    public function exportreturn(Request $request)
    {
        //Audit Log
        $username= auth()->user()->email; 
        $ipAddress=$_SERVER['REMOTE_ADDR'];
        $location='0';
        $access_from=Browser::browserName();
        $activity='Export Audit Log';

        //dd($location);
        $this->auditLogs($username,$ipAddress,$location,$access_from,$activity);
        // dd($request);
        $request->validate([
            'date_start' => 'required|date',
            'date_finish' => 'required|date|after_or_equal:date_start',
        ]);

        return Excel::download(new ProductReturnExport($request->date_start,$request->date_finish,$request->type),'Audit Logs Summary Report.xlsx');
    }

    public function exportLogAssign(Request $request)
    {
        // dd($request);
        $request->validate([
            'id_ticket' => 'required',
        ]);

        return Excel::download(new LogAssignExport($request->id_ticket),'Tickets Log Report.xlsx');
    }


}

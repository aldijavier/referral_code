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

class ExportController extends Controller
{
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

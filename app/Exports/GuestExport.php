<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use App\Guest;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

// use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\WithDrawings;
// use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class GuestExport implements WithHeadings,ShouldAutoSize, FromQuery
{
   
    use Exportable;
    

    /**
    * @return \Illuminate\Support\Collection
    */

   
    // varible lokasi and date1 and date2
    
    protected $search1;
    protected $search2;
    protected $search;
    protected $searchAll;
    // public function __construct(String $search = null,String $search1 = null , String $search2 = null)
    // {
    //     // $this->search = $search;
    //     // $this->search1   = $search1;
    //     // $this->search2 = $search2;
    //          $search1 = $request->get('search1');
    //         $search2 = $request->get('search2');
    // }
    

    function __construct($search1,$search2, $search, $searchAll) {
     
        $this->search1 = $search1;
        $this->search2 = $search2;
        $this->search = $search;
        $this->searchAll = $searchAll;
    }

    // public function collection()
    // {
    // //     return Guest::all();

    //     // return Guest::select()->where('datein','>=', $search1 = $request->get('search1'))->where('datein','<=',  $search = $request->get('search1'))->get();
    //     $guests = DB::table('guests')->whereDate('datein','>=',$this->search1)->whereDate('datein','<=',$this->search2)->orderBy('id');


    //     return $guests;
    // }

    public function query()
    {
        
        $guests=DB::table('guests');
        $guests = Guest::withTrashed()->leftJoin('lokasis', 'lokasis.id', 'guests.lokasi_id')->leftJoin('ruangs', 'ruangs.id_ruang', 'guests.ruangan_id')->leftJoin('lantais', 'lantais.id_lantai', 'guests.lantai_id')
            ->select(
                'guests.id',
                'guests.guestsid',
                'guests.datein',
                'guests.dateout',
                'guests.name',
                'guests.telephone',
                'guests.company',
                'guests.email',
                'guests.activity',
                'guests.noRack',
                'guests.noLoker',
                'guests.foto',
                'guests.durasi',
                'lokasis.lokasi as lokasi',
                'ruangs.name_ruang as ruang',
                'lantais.name_lantai as lantai',
                'guests.access',
                'guests.remarks',
                'guests.service_quality',
                'guests.infrastructure_quality',
                'guests.clean_quality'
            );      
        if($this->search1){
            $guests=$guests->whereDate('datein','>=',$this->search1);
        }
         
        
        if($this->search2){
            $guests=$guests->whereDate('datein','<=',$this->search2);
        }

        if($this->search){
            $guests=$guests->where('lokasi_id','like','%'.$this->search.'%');
        }

        if($this->searchAll){
            $guests=$guests->where('company','like','%'.$this->searchAll.'%');
        }

        $guests = $guests->orderBy('id');
        // $guests = DB::table('guests')->whereDate('datein','>=',$this->search1)->whereDate('datein','<=',$this->search2)->orderBy('id');
        return $guests;
    }

    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class    => function(AfterSheet $event) {
    //             $cellRange = 'A1:W1'; // All headers
    //             $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
    //         },
    //     ];
    // }



    public function headings(): array
    {
        return[
            'Id',
            'guestsid',
            'Date In',
            'Date Out',
            'Nama',
            'Telephone',
            'Company',
            'Email',
            'Activity',
            'No Rack',
            'No Loker',
            'Foto',
            'Durasi',
            'Lokasi',
            'Ruang',
            'Lantai',
            'access',
            'Remarks',
            'service_quality',
            'infrastructure_quality',
            'clean_quality'
        ];
    }
   
}

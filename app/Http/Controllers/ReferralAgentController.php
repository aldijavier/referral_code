<?php

namespace App\Http\Controllers;
use App\Referral_Agent;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Auth;
use Excel;
use App\Instansi;
use App\Traits\AuditLogsTrait;
use Browser;

class ReferralAgentController extends Controller
{
    use AuditLogsTrait;
    public function index()
    {
        //Audit Log
        $username= auth()->user()->email; 
        $ipAddress=$_SERVER['REMOTE_ADDR'];
        $location='0';
        $access_from=Browser::browserName();
        $activity='Akses Dashboard Referral Agent Internal';

        //dd($location);
        $this->auditLogs($username,$ipAddress,$location,$access_from,$activity);
        $referral = \App\Referral_Agent::all();
        return view('referral_agent.index', ['referral' => $referral]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        $data_klasifikasi = \App\Klasifikasi::all();
        //Audit Log
        $username= auth()->user()->email; 
        $ipAddress=$_SERVER['REMOTE_ADDR'];
        $location='0';
        $access_from=Browser::browserName();
        $activity='Akses Membuat Referral Agent Internal';

        //dd($location);
        $this->auditLogs($username,$ipAddress,$location,$access_from,$activity);
        return view('suratkeluar/create',['data_klasifikasi'=> $data_klasifikasi]);
    }

    //function untuk tambah
    public function tambah (Request $request)
    {
       $request->validate([
            'filekeluar' => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'no_surat' => 'unique:suratkeluar|min:5',
            'isi' => 'min:5',
            'keterangan' => 'min:5',
       ]);
       $suratkeluar = new SuratKeluar();
       $suratkeluar->no_surat     = $request->input('no_surat');
       $suratkeluar->tujuan_surat = $request->input('tujuan_surat');
       $suratkeluar->isi          = $request->input('isi');
       $suratkeluar->kode         = $request->input('kode');
       $suratkeluar->tgl_surat    = $request->input('tgl_surat');
       $suratkeluar->tgl_catat    = $request->input('tgl_catat');
       $suratkeluar->keterangan   = $request->input('keterangan');
       $file                      = $request->file('filekeluar');
       $fileName   = 'suratKeluar-'. $file->getClientOriginalName();
       $file->move('datasuratkeluar/', $fileName);
       $suratkeluar->filekeluar  = $fileName;
       $suratkeluar->users_id = Auth::id();
       $suratkeluar->save();
       //Audit Log
       $username= auth()->user()->email; 
       $ipAddress=$_SERVER['REMOTE_ADDR'];
       $location='0';
       $access_from=Browser::browserName();
       $activity='Menambahkan Referral Agent Internal';

       //dd($location);
       $this->auditLogs($username,$ipAddress,$location,$access_from,$activity);
       return redirect('/suratkeluar/index')->with("sukses", "Data Surat Keluar Berhasil Ditambahkan");
    }

    //function untuk melihat file
    public function tampil($id_suratkeluar)
    {
        $suratkeluar = \App\SuratKeluar::find($id_suratkeluar);
        return view('suratkeluar/tampil',['suratkeluar'=>$suratkeluar]);
    }

    //function untuk download file
    public function downfunc(){

        $downloads=DB::table('suratkeluar')->get();
        return view('suratkeluar.tampil',compact('downloads'));
    }

    public function agendakeluardownload_excel(){
        $suratkeluar = \App\SuratKeluar::select('id', 'isi', 'tujuan_surat', 'kode', 'no_surat', 'tgl_surat', 'tgl_catat', 'keterangan')->get();
        return Excel::create('Agenda_Surat_Keluar', function($excel) use ($suratkeluar){
            $excel->sheet('Agenda_Surat_Keluar',function($sheet) use ($suratkeluar){
                $sheet->fromArray($suratkeluar);
            });
        })->download('xls');
    }
    //function untuk ke view edit
    public function edit ($id_suratkeluar)
    {
        $data_klasifikasi = \App\Province::all();
        $suratkeluar = \App\Referral_Agent::find($id_suratkeluar);
        //Audit Log
        $username= auth()->user()->email; 
        $ipAddress=$_SERVER['REMOTE_ADDR'];
        $location='0';
        $access_from=Browser::browserName();
        $activity='Mengakses Halaman Edit Referral Agent Internal Code';

        //dd($location);
        $this->auditLogs($username,$ipAddress,$location,$access_from,$activity);
        return view('referral_agent/edit',['suratkeluar'=>$suratkeluar],['data_klasifikasi'=>$data_klasifikasi]);
    }
    public function update (Request $request, $id_suratkeluar)
    {
        {
            $request->validate([
                 // 'filekeluar' => 'mimes:jpg,jpeg,png,doc,docx,pdf',
                 'tujuansurat' => 'unique:suratkeluar|max:15',
                 // 'isi' => 'min:5',
                 // 'keterangan' => 'min:5',
            ]);
     
            // new Form
            if($request->referral_for == 1) {
             $suratkeluar = \App\Referral_Ext::find($id_suratkeluar);
             $referral = new Referral_Ext($request->all());
     
             // $plan->createdBy()->associate(Auth::user());
             // $plan->updatedBy()->associate(Auth::user());
     
             $referral->save();
                
             //Audit Log
            $username= auth()->user()->email; 
            $ipAddress=$_SERVER['REMOTE_ADDR'];
            $location='0';
            $access_from=Browser::browserName();
            $activity='Mengubah Referral Code';

            //dd($location);
            $this->auditLogs($username,$ipAddress,$location,$access_from,$activity);

             return redirect('/referral/index')->with("sukses", "Data Promo Code Berhasil Ditambahkan");
     
             return redirect('referral/index');
             } else if($request->referral_for == 2){
                $referral = \App\Referral_Agent::find($id_suratkeluar);
                $referral->update($request->all());
                
                //Audit Log
                $username= auth()->user()->email; 
                $ipAddress=$_SERVER['REMOTE_ADDR'];
                $location='0';
                $access_from=Browser::browserName();
                $activity='Mengubah Referral Agent Internal Code';

                //dd($location);
                $this->auditLogs($username,$ipAddress,$location,$access_from,$activity);

                $referral->save();
                
                //Audit Log
                $username= auth()->user()->email; 
                $ipAddress=$_SERVER['REMOTE_ADDR'];
                $location='0';
                $access_from=Browser::browserName();
                $activity='Mengedit Referral Agent Internal Code';

                //dd($location);
                $this->auditLogs($username,$ipAddress,$location,$access_from,$activity);
                 // flash()->success('Referral Agent was successfully created');
     
                 return redirect('/referralagent/index')->with("sukses", "Data Agent Code Internal Berhasil Diubah");
             }  
             else if($request->referral_for == 3){
                 $referral = \App\Referral_Ext::find($id_suratkeluar);
                 $referral->update($request->all());
                 $name = DB::table('regencies_new')->where('name', $referral->regencies)->pluck('initials');
                 $id=$referral->id;
     
                 $id2 = Referral_Ext::select(DB::raw('max(id) as id_max'))->where("referral_for", "=", "3")->first();
                 $id2 = (int)$id2->id_max;
                 
                 // $create_form=Referral_Ext::where('id',$id)
                 // ->update([
                 // 'id' => $id2
                 // ]);
                 
     
                 $addNol = '';
                 // $id3 = Product_Masuk::select(DB::raw('max(max_id) as id_max2'))->where("jenis_kategori", "=", "1")->first();
                 // $id3 = (int)$id2->id_max2 + 1;
     
                 if (strlen($id2) == 1) {
                     $addNol = "000$id2";
                 } elseif (strlen($id2) == 2) {
                     $addNol = "00$id2";
                 } elseif (strlen($id2 == 3)) {
                     $addNol = "0$id2";
                 }
     
                 // $no_asset = $created_date->format('Y');
                 //no urut akhir
                 $noticket1="A-"."$name[0]-"."$addNol";
                 // dd($noticket1);
                 
                 
                 $create_form1=Referral_Agent::where('id',$id)
                     ->update([
                     'referral_code' => $noticket1
                 ]);
     
                 // dd($create_form1);
                 $referral->save();
     
                 // flash()->success('Referral Agent Ext was successfully created');
     
                 return redirect('/referralagent/index')->with("sukses", "Data Agent Code Internal Berhasil Diubah");
         }
        }
    }

    //function untuk hapus
    public function delete($id_suratkeluar)
    {
        $suratkeluar=\App\Referral_Agent::find($id_suratkeluar);
        $suratkeluar->delete();
        //Audit Log
        $username= auth()->user()->email; 
        $ipAddress=$_SERVER['REMOTE_ADDR'];
        $location='0';
        $access_from=Browser::browserName();
        $activity='Menghapus Referral Agent Internal Code';

        //dd($location);
        $this->auditLogs($username,$ipAddress,$location,$access_from,$activity);
        return redirect('/referralagent/index') ->with('sukses','Data Agent Code Internal Berhasil Dihapus');
    }

     //Function Untuk Agenda Surat keluar
     public function agenda(Request $request)
     {
        $data_suratkeluar = \App\SuratKeluar::all();
        return view('suratkeluar.agenda', compact('data_suratkeluar'));
     }
     public function agendakeluarcetak_pdf()
     {
        $inst = Instansi::first();
         $suratkeluar = SuratKeluar::all();
         $pdf = PDF::loadview('suratkeluar.cetakagendaPDF', compact('inst','suratkeluar'));
         return $pdf->stream();
     }

    public function galeri(Request $request)
    {
        $data_suratkeluar = \App\SuratKeluar::all();
        return view('suratkeluar.galeri',['data_suratkeluar'=> $data_suratkeluar]);
    }

}

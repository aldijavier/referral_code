<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Traits\AuditLogsTrait;
use Browser;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    use AuditLogsTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $pengguna)
    {
        //Audit Log
        $username= auth()->user()->email; 
        $ipAddress=$_SERVER['REMOTE_ADDR'];
        $location='0';
        $access_from=Browser::browserName();
        $activity='Akses Daftar User';

        //dd($location);
        $this->auditLogs($username,$ipAddress,$location,$access_from,$activity);
        $data_pengguna = $pengguna->all();
        return view('pengguna.index', compact('data_pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Audit Log
        $username= auth()->user()->email; 
        $ipAddress=$_SERVER['REMOTE_ADDR'];
        $location='0';
        $access_from=Browser::browserName();
        $activity='Akses Create User';

        //dd($location);
        $this->auditLogs($username,$ipAddress,$location,$access_from,$activity);
        return view('pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users|min:5',
            'email' => 'required|unique:users|email',
        ]);

        $pengguna = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
            'role' => $request->role,
        ]);
        //Audit Log
        $username= auth()->user()->email; 
        $ipAddress=$_SERVER['REMOTE_ADDR'];
        $location='0';
        $access_from=Browser::browserName();
        $activity='Membuat Akses User';

        //dd($location);
        $this->auditLogs($username,$ipAddress,$location,$access_from,$activity);

        return redirect()->route('pengguna.index')->with('sukses','Data Pengguna Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_pengguna= User::findorfail($id);
        //Audit Log
        $username= auth()->user()->email; 
        $ipAddress=$_SERVER['REMOTE_ADDR'];
        $location='0';
        $access_from=Browser::browserName();
        $activity='Akses Edit User';

        //dd($location);
        $this->auditLogs($username,$ipAddress,$location,$access_from,$activity);
        return view('pengguna.edit', compact('data_pengguna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pengguna = User::findorfail($id);

        $this->validate($request, [
            'name' => 'required|min:5',
            'email' => 'required|email',
        ]);

        $data_pengguna = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
            'role' => $request->role,
        ];

        $pengguna->update($data_pengguna);

        //Audit Log
        $username= auth()->user()->email; 
        $ipAddress=$_SERVER['REMOTE_ADDR'];
        $location='0';
        $access_from=Browser::browserName();
        $activity='Mengedit Akses User';

        //dd($location);
        $this->auditLogs($username,$ipAddress,$location,$access_from,$activity);

        return redirect()->route('pengguna.index')->with('sukses','Data Pengguna Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pengguna = User::findorfail($id);
            $pengguna->delete();
            //Audit Log
            $username= auth()->user()->email; 
            $ipAddress=$_SERVER['REMOTE_ADDR'];
            $location='0';
            $access_from=Browser::browserName();
            $activity='Delete User';

            //dd($location);
            $this->auditLogs($username,$ipAddress,$location,$access_from,$activity);
            return redirect()->route('pengguna.index')->with('sukses','Data Berhasil di Hapus');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('sukses','Maaf, Masih ada data yang terpaut dengan user ini.');
        }
    }
}

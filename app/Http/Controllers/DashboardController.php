<?php

namespace App\Http\Controllers;
use App\Traits\AuditLogsTrait;
use Browser;

class DashboardController extends Controller
{
    use AuditLogsTrait;
    public function index()
    {
        //Audit Log
        $username= auth()->user()->email; 
        $ipAddress=$_SERVER['REMOTE_ADDR'];
        $location='0';
        $access_from=Browser::browserName();
        $activity='Akses Dashboard';

        //dd($location);
        $this->auditLogs($username,$ipAddress,$location,$access_from,$activity);
        return view('dashboard');
    }
}

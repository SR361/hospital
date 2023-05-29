<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminDashboardController extends Controller
{
    public function dashboard()
    {
        // dd('admin login successfullly');
        $page = 'Dashboard';
        return view('super-admin.dashboard',compact('page'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Presence;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardAdminController extends Controller
{
    //
    public function showPermission(){
        return view('admin.dashboard.permission',[
            'title' => 'permission',
            'user' => auth()->user(),
            'permissions'=> Permission::all()
        ]);
    }

    public function showPresence(){
        $lokasizone_latitude = 1;
        $lokasizone_maxlatitude = 2; 
        $lokasizone_longitudeitude = 1;
        $lokasizone_maxlongitude = 2;
        // $latitude = $presence->latitude > $lokasizone_latitude && $presence->latitude < $lokasizone_maxlatitude;
        // $latitude = $presence->latitude > $lokasizone_latitude && $presence->latitude < $lokasizone_maxlatitude;
        return view('admin.dashboard.presence',[
            'title' => 'presence',
            'user' => auth()->user(),
            'presences'=> Presence::get(),
            'users' => User::get()
        ]);
    }
}

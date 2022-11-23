<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
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
            'permissions'=> Permission::all(),
            'position' => Position::get()
        ]);
    }

    public function showPresence(){
        // return Presence::get();
        return view('admin.dashboard.presence',[
            'title' => 'presence',
            'user' => auth()->user(),
            'presences'=> Presence::get(),
            'users' => User::get(),
            'lokasizone_latitude' => 1,
            'lokasizone_maxlatitude' => 2, 
            'lokasizone_longitude' => 1,
            'lokasizone_maxlongitude' => 2,
            "position" => Position::get()
        ]);
    }
    // function LaporanKehadiran(){
    //     return view('admin.dashboard.laporan_kehadiran',[
    //         'presences' => Presence::with('user')->get(),
    //         'users' => User::get(),
    //         'lokasizone_latitude' => 1,
    //         'lokasizone_maxlatitude' => 2, 
    //         'lokasizone_longitude' => 1,
    //         'lokasizone_maxlongitude' => 2,
    //         "position" => Position::get()
    //     ]);
    // }
    function LaporanKehadiranPerTanggal($tanggal_awal,$tanggal_akhir){
        // dd($tanggal_awal,$tanggal_akhir);
        return view('admin.dashboard.laporan_kehadiran',[
            'presences' => Presence::with('user')->whereBetween('presence_date',[$tanggal_awal,$tanggal_akhir])->get(),
            'title' => 'laporan_kehadiran',
            'users' => User::get(),
            'lokasizone_latitude' => 1,
            'lokasizone_maxlatitude' => 2, 
            'lokasizone_longitude' => 1,
            'lokasizone_maxlongitude' => 2,
            "position" => Position::get()
        ]);
    }
    
}

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
    function showDashboard(){
        $user = auth()->user();
        return view('admin.dashboard.index',[
            "title" => "Dashboard",
            "user" => $user,
            "UserCount" => User::count(),
            "PositionCount" => Position::count(),
            "position" => Position::get()
        ]); 
    }
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
        // -8.2941,114.3069
        $lat = '-8.2941'; // latitude of centre of bounding circle in degrees
        $long = '114.3069'; // longitude of centre of bounding circle in degrees
        $rad = 100; // radius of bounding circle in meters
        $Presensi = new Presence;
        $dataPresensi = $Presensi->getpresence($lat,$long);
        // $dataDistance = $Presensi->distance(-8.29390,114.3069);
        // return $dataDistance;
        return view('admin.dashboard.presence',[
            'title' => 'presence',
            'user' => auth()->user(),
            'rad' => 100,
            'presences'=> $dataPresensi,
            'users' => User::get(),
            "position" => Position::get()
        ]);
    }
   
    function LaporanKehadiranPerTanggal($tanggal_awal,$tanggal_akhir){
        $lat = '-8.2941'; // latitude of centre of bounding circle in degrees
        $long = '114.3069'; 
        $Presensi = new Presence;
        $dataPresensi = $Presensi->getpresence($lat,$long)->whereBetween('presence_date',[$tanggal_awal,$tanggal_akhir]);
        // return $dataPresensi;
        // dd($tanggal_awal,$tanggal_akhir);
        return view('admin.dashboard.laporan_kehadiran',[
            // 'presences' => Presence::with('user')->whereBetween('presence_date',[$tanggal_awal,$tanggal_akhir])->get(),
            'presences' => $dataPresensi,
            'title' => 'laporan_kehadiran',
            'users' => User::get(),
            'rad' => 100,
            "position" => Position::get()
        ]);
    }

    function showJabatan(){
        return view('admin.jabatan.index',
        [
        'position' => Position::get(),
        "title" => "jabatan",
        "user" => auth()->user(),
        "usercount" => User::get(),
     ]);
    }

    function showLokasi(){
        return view('admin.lokasi.index',[
            "title" => "Lokasi",
            "user" => auth()->user(),
            'position' => Position::get(),

        ]);
    }
    
}

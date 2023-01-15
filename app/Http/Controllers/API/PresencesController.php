<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Holiday;
use App\Models\Position;
use App\Models\Presence;
use App\Models\Attendance;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PresencesController extends Controller
{
    //
    function showPresences()
    {
        // return $attendance->get();
        $user = auth()->user();
        $presensi =  Presence::where('user_id', $user->id)->get();
        $permission =  Permission::where('user_id', $user->id)->get();
        $izin_pres = [$presensi,$permission];
        
        return \response()->json([
            "presensi" => $presensi,
            "permission" => $permission,
            "name" => $user->name,
     
        ]);
    }

    function formMasuk(Request $request)
    {
        $PresensiModel = new Presence;
        $radius = 100;
        $rules = $request->validate([
            "lat" => "required",
            "long" => "required"
        ]);
        $dataDistance = $PresensiModel->distance($request->lat, $request->long);
        $Wfh = Permission::where('user_id',auth()->user()->id)
        ->where('permission_type_id',1)
        ->where('aksi','accept')
        ->latest()
        ->first();
        $dataWfh = false;
        if($Wfh != null){
            $dataWfh = $Wfh->tanggal_end_izin >= now()->format('Y-m-d');
        }
        $keterangan = "anda di luar zona absen";
        if ($dataDistance < $radius) {
            $keterangan = "anda di dalam zona absen";
        }
        $attendance = auth()->user()->position->attendance->first();
        $presensi =  Presence::where('user_id', auth()->user()->id)->latest()->first();
        $start = $attendance->start_time;
        $limit_start = $attendance->limit_start_time;
        //   jika  start atau limit_start  tidak terpenuhi
        if (!$start || !$limit_start) {
            if ($presensi->presence_enter_time != null) {
                return response()->json([
                    'message' => 'anda sudah absen masuk'
                ], 401);
            } else if (!$dataWfh && $dataDistance > $radius) {
                return response()->json([
                    'message' => $keterangan
                ], 420);
            } else {
                $presensi->update([
                    'longitude' => $request->long,
                    'latitude' => $request->lat,
                    'presence_enter_time' => now()->format('H:i:s'),
                ]);
                return response()->json([
                    'message' => 'anda berhasil absen masuk',
                    'distance' => $dataDistance,
                    'keterangan' => $keterangan
                ], 200);
            }
        } else {
            // definisi dari cekwaktu ,
            // cek apakah waktu saat ini lebih dari jadwal masuk atau tidak
            $cekWaktu = now()->format('H:i:s') >= $start && now()->format('H:i:s') <= $limit_start;
            // return $cekWaktu == true ;
            // cek apakah cekWaktu true atau false
            if (!$cekWaktu || $presensi->presence_enter_time) {
                return response()->json([
                    'message' => 'maaf anda tidak bisa absen'
                ], 401);
            } else if (!$dataWfh && $dataDistance > $radius) {
                return response()->json([
                    'message' => $keterangan
                ], 420);
            } else {
                $presensi->update([
                    'longitude' => $request->long,
                    'latitude' => $request->lat,
                    'presence_enter_time' => now()->format('H:i:s'),
                ]);
                return response()->json([
                    'message' => 'anda berhasil absen masukkk',
                    'distance' => $dataDistance,
                    'keterangan' => $keterangan,
                ], 200);
            }
        }
    }



    function createPresence()
    {
        // definisi dari attendance id = mengambil data user yang jadwal absensinya sesuai dengan user yang login
        $attendance_id = auth()->user()->position->attendance->first()->id;
        $user_id = auth()->user()->id;
        // definisi dari presensi = mengambil data 
        $presensi = Presence::where('attendance_id',$attendance_id)
        ->where('user_id', $user_id)
        ->where('presence_date', now()->format('Y-m-d'));
        if($presensi == true){
        // cek var presensi ada atau tidak ada, jika presensi dengan tanggal tidak ada, maka create data presensi
        if ($presensi->count() == 0) {
            Presence::create([
                'user_id' => auth()->user()->id,
                'attendance_id' => $attendance_id,
                'longitude' => null,
                'latitude' => null,
                'presence_date' => now()->format('Y-m-d'),
                'presence_enter_time' => null,
                'presence_out_time' => null
            ]);

            return response()->json([
                'status' => 'success',
                'deskripsi' => 'oke'
            ], 200);
        } else {
            return response()->json([
                'deskripsi' => 'lanjut ke form absen masuk dan keluar'
            ], 401);
        }
        }
        else{
            return response()->json([
                'deskriptsi' => 'jadwal untuk staff ini belum tersedia'
            ],401);
        }
    }

    function formKeluar(Request $request)
    {
        $Wfh = Permission::where('user_id',auth()->user()->id)
        ->where('permission_type_id',1)
        ->where('aksi','accept')
        ->latest()
        ->first();
        $dataWfh = false;
        if($Wfh != null){
            $dataWfh = $Wfh->tanggal_end_izin >= now()->format('Y-m-d');
        }
        // return auth()->user();
        // var presensimodel = class presence
        $PresensiModel = new Presence;
        $radius = 100;
        $rules = $request->validate([
            "lat" => "required",
            "long" => "required"
        ]);
       
        // definisi dari dataDistance = mengambil fungsi distance yang memiliki 2 parameter inputan dari var PresensiModel 
        $dataDistance = $PresensiModel->distance($request->lat, $request->long);
        // definisi dari attendance = mengambil data jadwal absensi yang sama dengan user yang login saat ini  
        $keterangan = "anda di zona nyaman";
        if ($dataDistance > $radius) {
        $keterangan = "anda di zona yang kurang nyaman";
        }
        $attendance = auth()->user()->position->attendance->first();
        // definisi var presensi yaitu untuk menampung data presence yang dimana attendace_id sama dengan attendance id, user id = user_id yang login saat ini, dan presence_date yang sama dengan tanggal saat ini
        $presensi =  Presence::where('user_id', auth()->user()->id)
        ->where('presence_date', now()->format('Y-m-d'))
        ->latest()->first();
        
        // definisi enter yaitu untuk menampung data var presensi presence enter time yang pertama 
        $enter = Carbon::parse('12:35')->format('H:i:s');
        if($presensi->presence_enter_time){
            $enter = $presensi->presence_enter_time;
        }
        // pengecekan absensi pulang untuk pegwai
        if ($attendance->end_time || $attendance->limit_end_time) {
            $cekWaktu = now()->format('H:i:s') >= $attendance->end_time && now()->format('H:i:s') <= $attendance->limit_end_time;
            // $cekUser  = $attendance->position->name = 'dosen' ;
            if (!$cekWaktu || $presensi->presence_out_time) {
                return response()->json([
                    'status' => 'oke',
                    'message' => 'maaf anda sudah tidak bisa absen keluar'
                ], 401);
            } else if(!$dataWfh && $dataDistance > $radius){
                // return "anda berhasil memasukkan data";
                return response()->json([
                    'status' => '',
                    'message' => 'Anda Berada Di Luar Zona Absen',
                    'keterangan' => 'diluar zona absen'
                ], 420);
            }
            else {
                $presensi->update([
                    'longitude' => $request->long,
                    'latitude' => $request->lat,
                    'presence_out_time' => now()->format('H:i:s'),
                ]);
                return response()->json([
                    'status' => 'oke',
                    'message' => 'anda berhasil absen',
                    'keterangan' => $keterangan
                ], 200);
             }
            }
        // }

        // pengecekan absensi pulang untuk dosen
        else {
            // definsi jam1 yaitu untuk menampung var enter setelah 5 jam
            $jam1 = Carbon::parse($enter)->addHours(5)->format('H:i:s');
            // definsi limit_jam1 yaitu untuk menampung var jam1 setelah 10 menit
            $limit_jam1 = Carbon::parse($jam1)->addMinute(10)->format('H:i:s');
            // definsi waktu1 yaitu untuk menampung jam saat ini
            $waktu1 = now()->format('H:i:s');
            // definsi cekWaktu1 yaitu untuk menampung pengecekan data waktu1 apakah waktu1 itu lebih dari  sama dengan jam1 dan kurang dari sama dengan limit_jam1
            $cekWaktu1 = $waktu1 >= $jam1 && $waktu1 <= $limit_jam1;
            // definsi jam2 yaitu untuk menampung var enter setelah 10 jam
            $jam2 = Carbon::parse($enter)->addHours(10)->format('H:i:s');
            // definsi limit_jam2 yaitu untuk menampung var enter setelah 10 menit
            $limit_jam2 = Carbon::parse($jam2)->addMinute(10)->format('H:i:s');
            // definsi cekWaktu2 yaitu untuk menampung pengecekan data waktu1 apakah waktu2 itu lebih dari  sama dengan jam1 dan kurang dari sama dengan limit_jam2
            $cekWaktu2 = $waktu1 >= $jam2 && $waktu1 <= $limit_jam2;
            $cekWaktu = $cekWaktu1 && $cekWaktu2;
            // jika cekwaktu bernilai true
            if (!$cekWaktu || $presensi->presence_out_time != null) {
                return response()->json([
                    'message' => 'anda tidak bisa absen sekarang, coba lagi nanti',
                ], 401);
            } else if(!$dataWfh && $dataDistance > $radius){
                // $keterangan = "anda di zona yang kurang nyaman";
                // if ($dataWfh || $dataDistance < $radius) {
                //     $keterangan = "anda di zona nyaman";
                return response()->json([
                    'status' => '',
                    'message' => 'Anda Berada Di Luar Zona Absen',
                    'keterangan' => 'diluar zona absen'
                ], 420);
                
            }
                else {
                    $presensi->update([
                        'longitude' => $request->long,
                        'latitude' => $request->lat,
                        'presence_out_time' => now()->format('H:i:s'),
                    ]);
                    return response()->json([
                        'message' => 'anda berhasil absen pulang',
                        'distance' => $dataDistance,
                        'keterangan' => $keterangan
                    ], 200);} 
                
            }
        }
    
}
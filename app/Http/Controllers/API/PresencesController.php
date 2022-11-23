<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Holiday;
use App\Models\Position;
use App\Models\Presence;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PresencesController extends Controller
{
    //
    function showPresences(){
        // return $attendance->get();
        $attendance_id = auth()->user()->position->attendance->first()->id;
        $presensi =  Presence::where('attendance_id', $attendance_id)->latest()->get();
        return $presensi;
    }
    function formMasuk(Request $request){
            // mencari jadwal pertama kali untuk absensi
            $attendance = auth()->user()->position->attendance->first();
            $presensi =  Presence::where('attendance_id', $attendance->id)->latest();
            $pres = $presensi->get();
            $start = $attendance->start_time;
            $limit_start= $attendance->limit_start_time;
            if(!$start || !$limit_start ){
                if($pres[0]->presence_enter_time != null){
                    return response()->json([
                        'message' => 'anda sudah absen masuk'
                    ],200);
                }else{
                    $presensi->update([
                        'longitude' => $request->longitude,
                        'latitude' => $request->latitude,
                        'presence_enter_time' => now()->format('H:i:s'),
                    ]);
                    response()->json([
                        'message' => 'anda berhasil absen masuk'
                    ],200);
                }
            }
            else{
            $cekWaktu = now()->format('H:i:s') >= $start && now()->format('H:i:s') <= $limit_start; 
                // return "tidak ada null";
                if(!$cekWaktu){
                    return response()->json([
                        'description' => 'maaf anda tidak bisa absen'
                    ],200);
                }else{
                $presensi->update([
                    'longitude' => $request->longitude,
                    'latitude' => $request->latitude,
                    'presence_enter_time' => now()->format('h:i:s'),
                ]);
                return response()->json([
                    'status' => 'oke',
                    'description' => 'anda berhasil absen'
                ],200);
            }
            }
            
    }

    function createPresence(){
          $holidays = Holiday::where('date_holidays', now()->format('y-m-d'));
          $ceckHolidays = $holidays == null && now()->format('l') != 'Sunday';
            $attendance_id = auth()->user()->position->attendance->first()->id;
            $presensi = Presence::where('attendance_id', $attendance_id)->where('presence_date', now()->format('y-m-d'));
            // jika presensi dengan tanggal tidak ada, maka create data presensi
            
            if($presensi->count() == 0 && $ceckHolidays){    
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
                ],200);
            }
            else{
            return response()->json([
                'deskripsi' => 'lanjut ke form absen masuk dan keluar'
            ],200);
                }
    }

    function formKeluar(Request $request){
            $attendance = auth()->user()->position->attendance->first();
            $presensi =  Presence::where('attendance_id', $attendance->id)->latest()->get();
            foreach ($presensi as $presens){           
                $enter = $presens->presence_enter_time;
            }
            // return $enter;
            if($attendance->end_time || $attendance->limit_end_time){
                $cekWaktu = now()->format('H:i:s') >= $attendance->end_time && now()->format('H:i:s') <= $attendance->limit_end_time; 
                     // $cekUser  = $attendance->position->name = 'dosen' ;
                if(!$cekWaktu){
                    return response()->json([
                        'status' => 'oke',
                        'description' => 'maaf anda sudah tidak bisa absen keluar'
                    ],200);
                }
                else{
                    // return "anda berhasil memasukkan data";
                $presensi->update([
                    'longitude' => $request->longitude,
                    'latitude' => $request->latitude,
                    'presence_out_time' => now()->format('h:i:s'),
                ]);
                return response()->json([
                    'status' => 'oke',
                    'description' => 'anda berhasil absen'
                ],200);
                }
            }
            else{
             // pengkondisian tahap satu
                    $jam1 = Carbon::parse($enter)->addHours(5)->format('H:i:s');
                    $limit_jam1 = Carbon::parse($jam1)->addMinute(10)->format('H:i:s');
                    $waktu1 = now()->format('H:i:s');
                    $cekWaktu1 = $waktu1 >= $jam1 && $waktu1 <= $limit_jam1;
    
                    $jam2 = Carbon::parse($enter)->addHours(10)->format('H:i:s');
                    $limit_jam2 = Carbon::parse($jam2)->addMinute(10)->format('H:i:s');
                    // $waktu2 = now()->format('H:i:s');
                    $cekWaktu2 = $waktu1 >= $jam2 && $waktu1 <= $limit_jam2;
                    // return [$jam2, $limit_jam2];
    
                    if(!$cekWaktu2 && !$cekWaktu1){
                        return $waktu1. " gagal ditambahkan " .$enter;
                    } else{
                        return $waktu1. " berhasil ditambahkan ". $enter;
                    }
                }
    }
}

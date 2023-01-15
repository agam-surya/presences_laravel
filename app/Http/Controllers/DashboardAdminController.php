<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use App\Models\Presence;
use App\Models\Attendance;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    //
    function showDashboard(){
        // return $this->saw();
        $user = auth()->user();
        return view('admin.dashboard.index',[
            "title" => "Dashboard",
            "user" => $user,
            "UserCount" => User::count(),
            "Users" => User::get(),
            'saw'=> $this->saw(),
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

    public function updateStatus(Request $request, Permission $permission){
      try {
        //code...
        $data = [
            'permission_type_id' => $permission->position_type_id,
            'user_id' => $permission->position_type_id,
            'description' => $permission->position_type_id,
            'tanggal_start_izin'=> $permission->position_type_id,
            'tanggal_end_izin'=> $permission->position_type_id,
            'aksi'=> $request->aksi,
            'file'=> $permission->position_type_id,
        ];
        $permission->update([
            'aksi' => $request->aksi,
        ]);
        return redirect()->back()->with('success', 'status izin berhasil di update');
      } catch (\Throwable $th) {
        //throw $th;
        return $th->getMessage();
      }
    }

    public function showPresence(){
        $lat = '-8.2941'; // latitude of centre of bounding circle in degrees
        $long = '114.3069'; // longitude of centre of bounding circle in degrees
        $rad = 300; // radius of bounding circle in meters
        $Presensi = new Presence;
        
        $dataPresensi = $Presensi->getpresence($lat,$long); #method untuk mengambil distance
      
        return view('admin.dashboard.presence',[
            'title' => 'presence',
            "position" => Position::get(),
            'user' => auth()->user(),
            'rad' => $rad,
            'presences'=> $dataPresensi,
            'users' => User::get(),
            "permission" => Permission::get()
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
            'rad' => 300,
            "position" => Position::get()
        ]);
    }

   

    function showLokasi(){
        return view('admin.lokasi.index',[
            "title" => "Lokasi",
            "user" => auth()->user(),
            'position' => Position::get(),

        ]);
    }

    function presIzin(){
        
        $izin = Permission::where('user_id', auth()->user()->id)->get();
        $pres = Presence::where('user_id', auth()->user()->id)->get();
        foreach($izin as $i){
            $dataiz = [
                'status' => 'izin',
                'preseces_date' => $i->tanggal_start_izin,
            ];
            $datai[] = $dataiz;
            foreach($pres as $p){
                $datapr = [
                    'status' => 'tidak izin',
                    'preseces_date' => $p->presence_date,
                ];
                $datap[] = $datapr;
            }
        }
        // return $dati;
        return [$datai,$datap];
    }

    public function saw(){
        $user1 = User::all();
        $lat = '-8.2941'; // latitude of centre of bounding circle in degrees
        $long = '114.3069'; 
        $Presensi = new Presence;
        $attendace = Attendance::all(); #jadwal absensi
        $dataPresensi = $Presensi->getpresence($lat,$long);
        foreach($user1 as $data){ #data yang akan dipakai
            $jumlah_presmasuk = $dataPresensi->where('user_id', $data->id)
            ->where('presence_enter_time' ,'!=', null)
            ->count();
            $jumlah_prespulang = $dataPresensi->where('user_id', $data->id)
            ->where('presence_out_time' ,'!=', null)
            ->count();
            $jumlah_absen_diluar = $dataPresensi->where('user_id', $data->id)
            ->where('radius' ,'>=', 300 )
            ->count();
            $jumlah_absen_didalam = $dataPresensi->where('user_id', $data->id)
            ->where('radius' ,'<=', 300 )
            ->count();
            $keterangan = $jumlah_absen_diluar + ($jumlah_absen_didalam*2);
            $var = array(
                 $jumlah_presmasuk, #0
                 $jumlah_prespulang, #1
                 $keterangan, #2
            ); 
            $datas[] = $var; 
        }
       
        
        $trans = array_map(null, ...$datas); #trnsform 
        $bobot = [30,30,40]; 
        /**
         * jika tidak ada data, atau data dari user tidak ada, 
         * maka langsung return datanya
         */
        foreach($user1 as $user){
            $nama[] = [
                $user->name,
                $user->position->posisi
            ];
        }
        if(array_sum($trans[0]) == 0){
            for ($i=0 ; $i < count($datas)  ; $i++) { 
                # code...
                $nullData[] = [
                    'skor' => $datas[$i][0],
                    'nama' => $nama[$i][0],
                    'jabatan' => $nama[$i][1],
                ]; 
            }
            return $nullData;
        }
            // normalisasi data
            foreach($datas as $i) {
            # code..
                $sopi[] = [
                    $i[0] / max($trans[0]),
                    $i[1] / max($trans[1]),
                    $i[2] / max($trans[2]),
                ];                    
            }
                # code...
                // pembobotan setiap kirteria pada data user
                foreach($sopi as $b){
                    $saw[] = [
                        $b[0] * $bobot[0], 
                        $b[1] * $bobot[1], 
                        $b[2] * $bobot[2], 
                    ];
                }
                // kalkulasi Saw
                foreach($saw as $s){
                    $skor[] = [
                        array_sum($s),
                    ];
                }
                //proses penampilan data
                for ($i=0 ; $i < count($skor)  ; $i++) { 
                    # code...
                    $last[] = [
                        'skor' => $skor[$i][0],
                        'nama' => $nama[$i][0],
                        'jabatan' => $nama[$i][1],
                    ]; 
                }
                
                rsort($last); #urutkan data
                //proses penampilan data
                foreach($last as $l){
                    $as[] = [
                        'skor' => $l['skor'],
                        'nama' => $l['nama'],
                        'jabatan' => $l['jabatan'],
                    ];
                }
                // ambil 5 user terekomendasi
                for($i = 0;$i <= 4;$i++){
                    $sort[] = [
                        'skor' => $as[$i]['skor'],
                        'nama' => $as[$i]['nama'],
                        'jabatan' => $as[$i]['jabatan'],
                    ];
                }
                return $sort;
    }
    function presencesData(){
        return view('admin.dashboard.saw', [
            'title' => 'presence',
            "position" => Position::get(),
            'user' => auth()->user(),
            'saw'=> $this->saw(),
            'users' => User::get(),
        
        ]);
    }

    function apiSPK(){
        return response()->json([
            "saw" => $this->saw()
        ]);
    }

    
    
}

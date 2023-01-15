<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user();
        return view('admin.attendance.index',[
            "title" => "attendance",
            "user" => $user,
            "attendances" => Attendance::get(),
            "position" => Position::get()
          
        ]);
        // return $attendace[0]->position->posisi;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = [
            'position_id' => $request->position_id,
            'title' => $request->title,
            'start_time' => $request->start_time,
            'limit_start_time' => $request->limit_start_time,
            'end_time' => $request->end_time,
            'limit_end_time' => $request->limit_end_time,     
        ];
            try { 
                // mencari apakah posisi ada  yang sama
                    $a = Attendance::where('position_id', $input['position_id'])->latest()->first();
                    if($a != null){
                        return redirect()->back()->with('error','jadwal untuk posisi tidak boleh sama dengan yang sebelumnya');
                    }else{
                        Attendance::create($input);
                        return redirect('/attendance')->with('success','data berhasil di masukkan');
                    }
            } catch (\Exception $e) {
                return $e->getMessage();
            }

    }
        function coba (){
            $position = Position::all();
            return $position;
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
    public function edit(Attendance $attendance)
    {
        //
        return view('admin.attendance.edit',[
            'attendance' => $attendance,
            "title" => "attendance",
            'position' => Position::all(),
            "user" => auth()->user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
        $Data = [
            'title' => $request->title,
            'start_time' => $request->start_time,
            'limit_start_time' => $request->limit_start_time,
            'end_time' => $request->end_time,
            'limit_end_time' => $request->limit_end_time, 
        ];
        try {
            //code...  
        Attendance::where('id', $attendance->id)
        ->update($Data); 
        return redirect('/attendance')->with('success', 'data berhasil di update');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with('error', 'data gagal di update: '. $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
        Attendance::destroy($attendance->id);
        return redirect('/attendance')->with('success', 'data berasil di hapus');
    }
}

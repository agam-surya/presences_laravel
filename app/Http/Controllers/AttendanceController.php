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
        $attendance = Attendance::get();
        $user = auth()->user();
        return view('admin.attendance.index',[
            "title" => "attendance",
            "user" => $user,
            "attendance" => Attendance::get(),
          
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
        return view('admin.attendance.create',[
            "position" => Position::all(),
            "title" => "attendance",
            "user" => auth()->user(),
        ]);
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
            'limit_end_time' => $request->limti_end_time,     
        ];
            // Attendance::create($input);
            try { 
                // mencari apakah posisi ada  yang sama
                $position = Position::get();
                foreach($position as $p);
                $attendance = Attendance::where('position_id', $p->id)->get();
                if(count($attendance) != 1){
                    // kalau tiddak ada, maka create jadwal untuk posisi ini
                    Attendance::create($input);
                    return redirect('/attendance')->with('success','data berhasil di masukkan');
                }else{
                    return redirect('/attendance')->with('success','data gagal dimasukkan');
                }
                // return redirect('/attendance')->with('success','data berhasil di masukkan');
            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
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
            'position_id' => $request->position_id,
            'title' => $request->title,
            'start_time' => $request->start_time,
            'limit_start_time' => $request->limit_start_time,
            'end_time' => $request->end_time,
            'limit_end_time' => $request->limit_end_time, 
        ];
        Attendance::where('id', $attendance->id)
        ->update($Data); 
        return redirect('/attendance')->with('success', 'data berhasil di update');
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

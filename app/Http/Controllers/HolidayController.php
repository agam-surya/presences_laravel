<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Holiday;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Holiday::get();
        return view('admin.holiday.index',[
            "title" => "attendance",
            "user" => auth()->user(),
            "holidays" => $data,
            "position" => Position::get(),
            // "posisi" => Position::where('id',1)->get(),
            "roles" => Role::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        try {
            //code...
            $validate = $request->validate([
                'keterangan' => 'required',
                'date_holidays' => 'required'
            ]);
            Holiday::create($validate); 
            return redirect()->back()->with('success', 'holiday create successfully');

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'holiday create failed :'. $th->getMessage());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function show(Holiday $holiday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $holiday)
    {
        //
        try {
            //code...
            $validate = $request->validate([
                'keterangan' => 'required',
                'date_holidays' => 'required'
            ]);
            Holiday::where('id', $holiday->id)
            ->update($validate); 
            return redirect()->back()->with('success', 'holiday update successfully');

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'holiday update failed :'. $th->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        //
        try {
            Holiday::destroy($holiday->id);
            return redirect()->back()->with('success', 'data holiday berhasi dihapus');
            } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'data holiday destroy failed : '. $th->getMessage());

            }
    }
}

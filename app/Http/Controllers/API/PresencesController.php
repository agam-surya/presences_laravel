<?php

namespace App\Http\Controllers\API;

use App\Models\Presence;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PresencesController extends Controller
{
    //
    function showPresences(Attendance $attendance){
        // return $attendance->get();
        $presensi = Presence::where('user_id', auth()->user()->id)
        ->where('attendance_id', $attendance->id)->get();
        return $presensi;
        }
}

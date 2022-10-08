<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CobaController extends Controller
{
    //
    public function coba(){
        return response()->json(
            'halaman coba laravel'
        );
    }
}

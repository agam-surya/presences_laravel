<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    //
    function show(){
        $permissions = Permission::where('user_id', auth()->user()->id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $permissions,
            'message' => 'sukses menampilkan data'
        ],200);
    }
    
    function create(Request $request){
        $rules = [
            'permission_type_id' => 'required',
            'desciption' => 'required',            
        ];
        $validatedData = $request->validate($rules);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['tanggal_sart_izin'] = now()->format('y-m-d');
        $validatedData['tanggal_end_izin'] = Carbon::parse($request->tanggal_end_izin)->format('y-m-d');
        $validatedData['file'] = $request->file('file')->store('post-file');
        Permission::create($validatedData);
        try { 
            return response()->json([
                'status' => 'success',
                'description' => 'berhasil mengirim data izin'
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}

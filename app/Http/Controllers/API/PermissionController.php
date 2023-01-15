<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    function show(){
        $permissions = Permission::where('user_id', auth()->user()->id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $permissions,
            'message' => 'sukses menampilkan data'
        ],200);
    }

    function sendCreate(){
        
    }
    
    function create(Request $request){
        $rules = [
            'permission_type_id' => 'required',
            'description' => 'required',            
        ];
        $validatedData = $request->validate($rules);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['tanggal_start_izin'] = now()->format('Y-m-d');
        $validatedData['tanggal_end_izin'] = Carbon::parse($request->tanggal_end_izin)->format('Y-m-d');
        if($request->file('file')){
            $fileName = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('post-file', $fileName, 'public');
            $validatedData["file"] = '/'.$path;
        }
        $filter = Permission::where('user_id', auth()->user()->id)
        ->where('aksi','accept')
        ->latest()
        ->first();

            if($filter == true){
               $parse = Carbon::parse($filter->tanggal_end_izin)->format('Ymd');
                if($parse >= Carbon::parse($request->tanggal_end_izin)->format('Ymd')){
                    return response()->json([
                                'status' => 'fail',
                                'message' => 'tanggal izin masih tersedia,silahkan input tanggal izin'
                            ],401); 
                }else{                  
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
                
              
            }else{
                try { 
                    Permission::create($validatedData);
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

}

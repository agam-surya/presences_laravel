<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class profileController extends Controller
{
    //
    function show(){
        // $respon = $this->responseApi(200, '', 'tes', $user);
        return response()->json([
            // $user,
            'nama' => auth()->user()->name,
            'posisi' => auth()->user()->position->posisi,
            'address' => auth()->user()->address,
            'phone' => auth()->user()->phone,
            'image' => auth()->user()->image
        ]);
    }

    function update(Request $request)
    {
        // aturan request name,password dan address 
        $rules = [
        'name'=> 'required',
        'password' => 'required',
        'address' => 'required',
        ];       
        $validatedData = $request->validate($rules);
        // jika ada request image maka taruh ke folder storage/post-image
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('post-image');
        }
            $validatedData['password'] = bcrypt($validatedData['password']);
        User::where('id', auth()->user()->id)
        ->update($validatedData);   
        return response()->json([
            'deskripsi' => 'sukses megupdate data',
            'data' => $validatedData
        ],200);
    }
}

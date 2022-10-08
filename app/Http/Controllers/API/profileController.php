<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class profileController extends Controller
{
    //
    function show(){
        $user = User::where('id', auth()->user()->id)->get();
        // $respon = $this->responseApi(200, '', 'tes', $user);
        return response()->json($user);
    }

    function update(Request $request)
    {
        //
        $rules = [
        'name'=> 'required',
        'password' => 'required',
        'address' => 'required',
        ];
       
        $validatedData = $request->validate($rules);
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('post-image');
        }
        // if($){
            $validatedData['password'] = bcrypt($validatedData['password']);
        // }
        User::where('id', auth()->user()->id)
        ->update($validatedData);   
        return response()->json([
            'deskripsi' => 'sukses megupdate data',
            'data' => $validatedData
        ],200);
        // return redirect('/dashboard/posts')->with('success', 'new Post Has update');
    }
}

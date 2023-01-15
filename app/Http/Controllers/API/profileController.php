<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class profileController extends Controller
{
    //
    function show(){
        // $respon = $this->responseApi(200, '', 'tes', $user);
        return response()->json([
            // $user,
            'name' => auth()->user()->name,
            'position' => auth()->user()->position->posisi,
            'address' => auth()->user()->address,
            'phone' => auth()->user()->phone,
            'image' => auth()->user()->image
        ]);
    }

    function update(Request $request)
    {
        $user = User::where('id',auth()->user()->id);
        // aturan request name,password dan address 
        $rules = [
        'name'=> '',
        'password' => '',
        'address' => '',
        'phone' => '',
        ];       
        $validatedData = $request->validate($rules);
        // jika ada request image maka taruh ke folder storage/post-image
        if ($request->file('image')) {

            $validatedData['image'] = ($request->file('image')->store('post-image'));

            if (auth()->user()->image != '' && auth()->user()->image != 'image') {
                $old = \str_replace('', '', auth()->user()->image);
                Storage::delete($old);
            }
        }
        // User::where('id', auth()->user()->id)
        $user->update($validatedData);

        return response()->json([
            'deskripsi' => 'sukses megupdate data',
            'data' => $validatedData
        ],200);
    }
}

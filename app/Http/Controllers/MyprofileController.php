<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MyprofileController extends Controller
{
    //
     function edit() {
        try {
            //code...
            if (Role::where('id', auth()->user()->role_id) == null){
                return redirect('/login');
            }
            return view('admin.profile', [
                'position' => Position::get(),
                "title" => "Dashboard",
                'user'=> auth()->user()
            ]);

        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/login');
             }
    }
   
    function update(Request $request, User $user) {
        try {
            if (Role::where('id', $user->role_id) == null){
                return redirect('/login');
                }
                $validatedData = $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required',
                    'password' => '',
                    'image' => 'image|file|max:1024',
                    'position_id' => 'required',
                    'address' => 'required',
                    'phone' => 'required',
                ]);



                if($validatedData['password'] == null){
                    $password = $user->password;
                }
                else{
                $password = Hash::make( $validatedData['password']);
                }

                $validatedData['password'] = $password;
                if ($request->file('image')) {

                    $validatedData['image'] = ($request->file('image')->store('post-image'));
        
                    if (auth()->user()->image != '' && auth()->user()->image != 'image') {
                        $old = \str_replace('', '', auth()->user()->image);
                        Storage::delete($old);
                    }
                }
                if($request->image == null){
                    $image = $user->image;
                }else{
                   $image = $request->file('image')->store('post-image');
                }
                $validatedData['image'] = $image;
                 User::where('id', $user->id)
                ->update($validatedData); 
                return redirect()->back()->with('success', 'myprofile update successfully');
            
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'myprofile update invalid:'.$th->getMessage());
        }
       
     }  
}

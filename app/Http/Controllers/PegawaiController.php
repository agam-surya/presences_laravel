<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
        $pegawais = User::where('position_id', 2)->get();
        return view('admin.pegawai.index',[
            "title" => "attendance",
            "user" => auth()->user(),
            "pegawais" => $pegawais,
          
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
        return view('admin.pegawai.create',[
            "title" => "attendance",
            "user" => auth()->user(),
            "roles" => Role::get(),
        ]);
        // return Role::get();
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password'=> 'required|min:8|max:255|',
            'image' => 'required|image|file|max:1024',
            'role_id' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);
            $validatedData['password'] = Hash::make($validatedData['password']);
            $validatedData['image'] = $request->file('image')->store('post-image');
            $validatedData['position_id'] = 2; 

        User::create($validatedData);
        return redirect('/pegawai')->with('success', 'Data Pegawai berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        // return view('admin.pegawai.edit',[
        //     "title" => "attendance",
        //     "user" => auth()->user(),
        //     "roles" => Role::get(),
        // ]);
        return 'edit';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $pegawai)
    {
        //
        return view('admin.pegawai.edit',[
            "pegawai" => $pegawai,
            "title" => "attendance",
            "user" => auth()->user(),
            "roles" => Role::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $pegawai)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => '',
            'image' => 'image|file|max:1024',
            'role_id' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        if($validatedData['password'] == null){
            $password = $pegawai->password;
        }
        else{
        $password = Hash::make( $validatedData['password']);
        }

        $validatedData['password'] = $password;

        if($request->image == null){
            $image = $pegawai->image;
        }else{
        $image = $request->file('image')->store('post-image');
        }
        $validatedData['image'] = $image;

        User::where('id', $pegawai->id)
        ->update($validatedData); 
        return redirect('/pegawai')->with('success', 'data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $pegawai)
    {
        //
        User::destroy($pegawai->id);
        return redirect('/pegawai');
    }
}
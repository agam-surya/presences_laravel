<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $pegawais = User::where('position_id', 2)->get() ;
        // $pegawais = User::get() ;
        return view('admin.pegawai.index',[
            "title" => "pegawai",
            "user" => auth()->user(),
            "pegawais" => $pegawais,
            "position" => Position::get(),
            "roles" => Role::get()
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
        // return view('admin.pegawai.create',[
        //     "title" => "attendance",
        //     "user" => auth()->user(),
        //     "roles" => Role::get(),
        //     "position" => Position::get(),

        // ]);
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
        return $user;
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
        // return view('admin.pegawai.edit',[
        //     "pegawai" => $pegawai,
        //     "title" => "attendance",
        //     "user" => auth()->user(),
        //     "roles" => Role::get(),
        // ]);
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
        $old = \str_replace('', '', auth()->user()->image);
        Storage::delete($old);
        }
        // if ($request->file('image')) {

        //     $validatedData['image'] = ($request->file('image')->store('post-image'));

        //     if (auth()->user()->image != '' && auth()->user()->image != 'image') {
        //     }
        // }
        $validatedData['image'] = $image;
        try {
            //code...
            User::where('id', $pegawai->id)
            ->update($validatedData); 
            return redirect('/pegawai')->with('success', 'data berhasil di update');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error','email harus berbeda dengan email user lain');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $pegawai)
    {
        try {
            //code...
        User::destroy($pegawai->id);            
        return redirect()->back()->with('success','data berhasil dihapus');

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error','maaf data tidak bisa dihapus karena ada data lainnya juga');
        }
    }
}

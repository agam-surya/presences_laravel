<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
        $dosens = User::where('position_id', 1)->get();
        return view('admin.dosen.index',[
            "title" => "attendance",
            "user" => auth()->user(),
            "dosens" => $dosens,
          
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
        return view('admin.dosen.create',[
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
            $validatedData['position_id'] = 1; 
        User::create($validatedData);
        return redirect('/dosen')->with('success', 'Data Dosen berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return 'edit';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $dosen)
    {
        //
        return view('admin.dosen.edit',[
            "dosen" => $dosen,
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
    public function update(Request $request, User $dosen)
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
            $password = $dosen->password;
        }
        else{
        $password = Hash::make( $validatedData['password']);
        }

        $validatedData['password'] = $password;

        if($request->image == null){
            $image = $dosen->image;
        }else{
        $image = $request->file('image')->store('post-image');
        }
        $validatedData['image'] = $image;
        try {
            //code...
            User::where('id', $dosen->id)
            ->update($validatedData); 
            return redirect('/dosen')->with('success', 'data berhasil di update');
        } catch (\Exception $e) {
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
    public function destroy(User $dosen)
    {
        //
        try {
            //code...
            
        User::destroy($dosen->id);
        return redirect('/dosen');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
}

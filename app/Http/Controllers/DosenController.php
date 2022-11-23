<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use DataTables;
// use 

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       //
      
        # code...
        // $dosens = User::where('name', 'like','%' .$request->search.'%')->where('position_id', 1)->paginate(5);
        $data = User::where('position_id',1)->get();
        if(request()->ajax()){
            return datatables()->of($data)
                    // ->addColumns('aksi', function ($dosen){
                    //     $buttons = "<button class='edit btn btn-warning' >Edit</button>";
                    //     $buttons .= "<button class='hapus btn btn-danger' >Hapus</button>";
                    //     return $buttons;
                    // })
                    // ->rawColumns(['aksi'])
                    ->make(true);
        }
       return view('admin.dosen.index',[
        "title" => "attendance",
        "user" => auth()->user(),
        "dosens" => $data,
        "position" => Position::get(),
        // "posisi" => Position::where('id',1)->get(),
        "roles" => Role::get(),
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
            "position" => Position::get()
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
        try {
            //code...
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
        } catch (\Exception $th) {
            //throw $th;
            return redirect('/dosen')->with('error', 'Data Dosen gagal ditambahkan : ' . $th->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    // public function show(User $user)
    // {
    //     return 'edit';
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $dosen)
    {
        //
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
            return redirect()->back()->with('success', 'dosen update successfully');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with('error', 'dosen update error:'.$e->getMessage());
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
        User::destroy($dosen->id);
        return redirect()->back()->with('success', 'data dosen berhasi dihapus');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.jabatan.index',
        [
        'position' => Position::get(),
        "title" => "jabatan",
        "user" => auth()->user(),
        "usercount" => User::get(),
     ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

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
                'posisi' => 'required|max:255',
            ]); 
            Position::create($validatedData);
            return redirect('/jabatan')->with('success', 'Data Jabatan berhasil ditambahkan');
        } catch (\Exception $th) {
            //throw $th;
            return redirect('/jabatan')->with('error', 'Data Jabatan gagal ditambahkan : ' . $th->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
        $data = User::where('position_id',$position->id)->orderBy('id','desc')->get();
        // $data = Position::where('id',$user->positioid)->first();
        return view('admin.staff.index',[
            "title" => 'Data Staff',
            "user" => auth()->user(),
            "dosens" => $data,
            "position" => Position::get(),
            "posisi" => Position::where('id',$position->id)->get(),
            "roles" => Role::get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $position
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        //
        try {
            //code...
            $validatedData = $request->validate([
                'posisi' => 'required|max:255',
            ]); 
            Position::where('id',$position->id)->update($validatedData);
            return redirect('/jabatan')->with('success', 'Jabatan berhasil diupdate');
            } catch (\Exception $th) {
            //throw $th;
            return redirect('/jabatan')->with('error', 'Jabatan gagal diupdate : ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        //
        try {
            Position::destroy($position->id);
            return redirect()->back()->with('success', 'data berhasil dihapus');
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
    }


    // STAFF
    public function storeStaff(Request $request, Position $position)
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
                    $validatedData['position_id'] = $position->id; 
                User::create($validatedData);
                return redirect()->back()->with('success', 'Data ' .$position->posisi.' berhasil ditambahkan');
            } catch (\Exception $th) {
                //throw $th;
                return redirect()->back()->with('error', $th->getMessage());
                // return redirect()->back()->with('error', 'Data Dosen gagal ditambahkan : ' . $th->getMessage());
            }
            
        
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function updateStaff(Request $request, User $user)
    {
        try{
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => '',
            'image' => 'image|file|max:1024',
            'role_id' => 'required',
            'address' => 'required',
            'phone' => 'required',
            // 'position_id' => 'required',
        ]);

        // dd(User::where('id',4)->first()); 

        if($validatedData['password'] == null){
            $password = $user->password;
        }
        else{
        $password = Hash::make( $validatedData['password']);
        }
        $validatedData['password'] = $password;

        if($request->image == null){
            $image = $user->image;
        }else{
        $image = $request->file('image')->store('post-image');
        $old = \str_replace('', '', $user->image);
        Storage::delete($old);
        }
        $validatedData['image'] = $image;
            //code...
            User::where('id', $user->id)
            ->update($validatedData); 
            return redirect()->back()->with('success', 'Data ' .$user->position->posisi.' berhasil diupdate');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with('error',  'Data '.$user->position->posisi.' update error: '.$e->getMessage());
        }
       
    }
    // delete user
    public function destroyStaff(User $user)
    {
        //
        try {
            User::destroy($user->id);
            $old = \str_replace('', '', $user->image);
            Storage::delete($old);
            return redirect()->back()->with('success', 'data user berhasi dihapus');
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
    }
}

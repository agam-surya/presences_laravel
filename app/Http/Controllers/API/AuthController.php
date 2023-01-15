<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PersonalAccessToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function responseApi($statusCode, $user = '', $message, $description = '', $token = '')
    {
        return [
            "statusCode" => $statusCode,
            "user" => $user,
            "message" => $message,
            "description" => $description,
            "token" => $token,
        ];
    }

    public function register(Request $request)
    {
        // validate request
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required',
            'position_id' => 'required',
        ]);

        // create user
        $user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => bcrypt($validate['password']),
            'role_id' => $validate['role_id'],
            'remember_token' => 'null',
            'phone' => '081081091',
            'position_id' => $validate['position_id'],
            'image' => 'image',
            'address' => 'address',
        ]);

        // return user response

        return response([
            'user' => $user,
        ]);
    }

    function login(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // tidak tersedia
        if ($validate->fails()) {
            $respon = $this->responseApi(403, '', $validate->validated(), '');

            return response()->json($respon, 403);
        } else {
            // tidak sesuai
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                $respon = $this->responseApi(403, '', 'invalid credentials', '');

                return response()->json($respon, 403);
            }


            // cek jika token user tidak kosong => supaya mencegah bisa lebih dari 1 kali login pada waktu bersamaan, harus logout dulu sebelum login diperangkat lain
           

            $user = User::where('email', $request->email)->first();

            $tokenUser = $user->tokens()->get();
            
            if (!count($tokenUser) == 0) {
                // return Carbon::parse($tokenUser[0]->created_at)->format('y-m-d');
                // return $tokenUser;
                if(Carbon::parse($tokenUser->first()->created_at)->addMinutes()->format('Y-m-d H:i:s') <= now()->format('Y-m-d H:i:s')){
                $user->tokens()->delete();
                return $this->buatToken($request);
                }
                $respon = $this->responseApi(403, $user->name, 'Akun Di Perangkat Lain', 'Silahkan Logout Akun Anda Terlebih Dahulu');
                return response()->json($respon, 403);
            }

            // if()
            return $this->buatToken($request);
        }
    }

    function buatToken(Request $request){
        $user = User::where('email', $request->email)->first();
        $tokenResult = $user->createToken('token-auth')->plainTextToken;
            $respon = [
                'message' => 'Login successfully',
                'user' => auth()->user(),
                'token' => $tokenResult,

            ];
            $this->responseApi(200, auth()->user(), 'Login successfully', '', $tokenResult);
            // if()
            return response()->json($respon, 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        $respon = [
            'message' => 'Logout successfully',
        ];
        return response()->json($respon, 200);
    }

    public function coba(Request $request)
    {
        $respon = [
            'message' => 'Login successfully',
            'user' => [
                'email' => 'agam@gmail.com',
                'status_code' => 200,
            ],
            'token' => 'asd7as8d7asdsad8',
            'token_type' => 'Bearer',
        ];
        return response()->json($respon, 200);
    }

    public function user()
    {
        $respon = [
            'user' => auth()->user()
        ];
        return response()->json($respon, 200);
    }
}

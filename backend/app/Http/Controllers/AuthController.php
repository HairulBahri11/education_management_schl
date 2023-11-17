<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function login_index()
    {
        return view('login');
    }

    public function register_index()
    {
        return view('register');
    }
    public function login(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //check validation
        if ($validasi->fails()) {
            return redirect('/registrasi')->with('error', 'Email dan Password Wajib Di isi ');
        }


        //check credentials
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return redirect('/login')->with('error', 'Email dan Password Salah');

        }
        //get user5
        $user = User::where('email', $request->email)->get();

        return redirect('/')->with('success', 'Login Berhasil');
    }

    public function register(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //check validation
        if ($validasi->fails()) {
            return response()->json([
                'message' => 'error',
                'error' => $validasi->errors()
            ], 401);
        }

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'orangtua',
            'foto' => '7309681.jpg',
            'no_hp' => $request->no_hp,
            'active' => 1,
        ]);

        $user->assignRole('orangtua');

        if ($user) {
           return redirect('/login')->with('success', 'Registrasi Berhasil Silahkan Login Terlebih Dahulu');
        } else {
            return redirect('/register')->with('error', 'Registrasi Gagal');
        }
    }

    public function logout()
    {
        // try {
        //     $data = User::find($id);
        //     if ($data->id == Auth::user()->id) {
        //         $data->tokens()->delete();
        //         return response()->json([
        //             'message' => 'you are logout',
        //         ]);
        //     }
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'message' => $e->getMessage()
        //     ]);
        // }

        Auth::logout();
        return redirect('/login')->with('success', 'Logout Berhasil');
    }
}

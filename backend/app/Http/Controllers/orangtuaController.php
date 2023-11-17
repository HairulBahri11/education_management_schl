<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class orangtuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('role', 'orangtua')->get();
        return view('dashboard.orangtua.orangtua', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.orangtua.orangtua_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        if ($validasi->fails()) {
            return $validasi->errors();
        }

        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $extension = $file->getClientOriginalName();
            $filename = time().'-'.$extension;
            $file = $file->storeAs('public/images', $filename);
        }

        $data = User::create([
            'nama' => $request->get('nama'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role' => 'orangtua',
            'alamat' => $request->get('alamat'),
            'no_hp' => $request->get('no_hp'),
            'foto' => $filename,
            'active' => 1
        ]);

        if($data){
            return redirect('/orangtua')->with('success', 'Data Berhasil Ditambahkan');
        }else{
            return redirect('/orangtua')->with('error', 'Data Gagal');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::find($id);
        return view('dashboard.orangtua.orangtua_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        if($validasi->fails()){
            return $validasi->errors();
        }

        $data = User::find($id);
        $data->nama = $request->get('nama');
        $data->email = $request->get('email');
        $data->alamat = $request->get('alamat');
        $data->no_hp = $request->get('no_hp');

        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $extension = $file->getClientOriginalName();
            $filename = time().'.'.$extension;
            $file = $file->storeAs('public/images', $filename);
            $data->foto = $filename;
        }

        // jika request mengisi form password
        if($request->has('password')){
            $data->password = bcrypt($request->get('password'));
        }

        $data->save();

        if($data){
            return redirect('/orangtua')->with('success', 'Data Berhasil Diubah');
        }else{
            return redirect('/orangtua')->with('error', 'Data Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function wa($nohp){
        $nohp = $nohp;
        $msg = "Hello saya" .Auth::user()->nama .' - '.Auth::user()->email . "ingin bertanya";

        return redirect()->away('https://api.whatsapp.com/send?phone='.$nohp .'&text='.$msg);

    }

    public function setnonActive($id){
        $data = User::find($id);

        if($data->active == 1){
            $data->active = 0;
            $status = "Status Akun Orangtua Di Non Active";
        }
        else{
            $data->active = 1;
            $status = "Status Akun Orangtua Di Active";
        }



        $data->save();

        return redirect('/orangtua')->with('success', $status);
    }

}

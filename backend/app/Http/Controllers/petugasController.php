<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class petugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Petugas::all();
        return view('dashboard.petugas.petugas', compact('data' ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.petugas.petugas_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama_petugas' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',


        ]);

        if ($validasi->fails()) {
            return $validasi->errors();
        }

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $extension = $file->getClientOriginalName();
            $filename = time().'.'.$extension;
            $file = $file->storeAs('public/images', $filename);
        }
        else{
            $filename = '7309681.jpg';
        }

        $data = Petugas::create([
            'nama_petugas' => $request->get('nama_petugas'),
            'no_hp' => $request->get('no_hp'),
            'alamat' => $request->get('alamat'),
            'photo' => $filename

        ]);

        if ($data) {
            return redirect('/petugas')->with('success', 'Data Berhasil Ditambahkan');
        }else{
            return redirect('/petugas')->with('error', 'Data Gagal Ditambahkan');
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
        $data = Petugas::find($id);
        return view('dashboard.petugas.petugas_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(), [
            'nama_petugas' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        if ($validasi->fails()) {
            return $validasi->errors();
        }

        $data = Petugas::find($id);
        $data->nama_petugas = $request->get('nama_petugas');
        $data->no_hp = $request->get('no_hp');
        $data->alamat = $request->get('alamat');


        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $extension = $file->getClientOriginalName();
            $filename = time().'.'.$extension;
            $file = $file->storeAs('public/images', $filename);
            $data->photo = $filename;
        }

        $data->save();

        return redirect('/petugas')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Petugas::find($id);
        $path = 'public/images/';
        $default_image = '7309681.jpg';
        if($data->photo != $default_image){
            Storage::delete($path.$data->photo);
        }
        $data->delete();

        return redirect('/petugas')->with('success', 'Data Berhasil Dihapus');
    }

    public function wa($nohp){
        $nohp = $nohp;
        $msg = "Hello saya" .Auth::user()->nama .' - '.Auth::user()->email . "ingin bertanya";

        return redirect()->away('https://api.whatsapp.com/send?phone='.$nohp .'&text='.$msg);

    }
}

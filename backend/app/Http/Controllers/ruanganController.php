<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ruanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ruangan::all();
        return view('dashboard.ruangan.ruangan', compact('data' ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $petugas = Petugas::all();
        return view('dashboard.ruangan.ruangan_create' , compact('petugas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama_ruangan' => 'required',
            'kapasitas' => 'required',
            'petugas_id' => 'required',
        ]);

        if($validasi->fails()){
            return $validasi->errors();
        }
        $data = ruangan::create([
            'nama_ruangan' => $request->get('nama_ruangan'),
            'kapasitas' => $request->get('kapasitas'),
            'petugas_id' => $request->get('petugas_id'),

        ]);

        if($data){
            return redirect('/ruangan')->with('success', 'Data Berhasil Disimpan');
        }else{
            return redirect('/ruangan')->with('error', 'Data Gagal Disimpan');
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
        $data = ruangan::find($id);
        $petugas = Petugas::all();
        return view('dashboard.ruangan.ruangan_edit', compact('data', 'petugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(), [
            'nama_ruangan' => 'required',
            'kapasitas' => 'required',
            'petugas_id' => 'required',

        ]);

        if($validasi->fails()){
            return $validasi->errors();
        }

        $data = ruangan::find($id);
        $data->nama_ruangan = $request->get('nama_ruangan');
        $data->kapasitas = $request->get('kapasitas');
        $data->petugas_id = $request->get('petugas_id');
        $data->save();

        if($data){
            return redirect('/ruangan')->with('success', 'Data Berhasil Diubah');
        }else{
            return redirect('/ruangan')->with('error', 'Data Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ruangan::find($id);
        $data->delete();

        if($data){
            return redirect('/ruangan')->with('success', 'Data Berhasil Dihapus');
        }else{
            return redirect('/ruangan')->with('error', 'Data Gagal Dihapus');
        }
    }

    public function wa($nohp){
        $nohp = $nohp;
        return redirect()->away('https://api.whatsapp.com/send?phone='.$nohp);

    }
}

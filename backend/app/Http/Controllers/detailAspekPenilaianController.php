<?php

namespace App\Http\Controllers;

use App\Models\Aspek_Penilaian;
use App\Models\Detail_Aspek_Penilaian;
use Illuminate\Http\Request;

class detailAspekPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $id)
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, String $id)
    {
        $aspek_penilaian_id = $id;
        $data = Detail_Aspek_Penilaian::create([
            'aspek_penilaian_id' => $aspek_penilaian_id,
            'nama_detail_aspek_penilaian' => $request->nama_detail_aspek_penilaian
        ]);

        if ($data) {
            return redirect()->back()->with('success', 'Detail Aspek Penilaian Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Detail Aspek Penilaian Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Detail_Aspek_Penilaian::where('aspek_penilaian_id', $id)->get();
        $aspek_penilaian_id = $id;
        return view('dashboard.aspek_penilaian.detail_aspek_penilaian', compact('data', 'aspek_penilaian_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Detail_Aspek_Penilaian::find($id);
        $data->delete();
        if ($data) {
            return redirect()->back()->with('success', 'Detail Aspek Penilaian Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Detail Aspek Penilaian Gagal Dihapus');
        }
    }
}

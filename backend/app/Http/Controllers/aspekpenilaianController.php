<?php

namespace App\Http\Controllers;

use App\Models\Aspek_Penilaian;
use App\Models\Detail_Aspek_Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class aspekpenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Aspek_Penilaian::orderby('id', 'desc')->get();
        return view('dashboard.aspek_penilaian.aspek_penilaian', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.aspek_penilaian.aspek_penilaian_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data  = Validator::make($request->all(), [
            'aspek_penilaian' => 'required',
            'bidang' => 'required',
            'value_all_detail_aspek_penilaian' => 'required',
        ]);

        if ($data->fails()) {
            return redirect()->back()->withErrors($data->errors());
        }

        $aspek_penilaian = Aspek_Penilaian::create([
            'aspek_penilaian' => $request->aspek_penilaian,
            'bidang' => $request->bidang
        ]);

        $arr_detail_aspek = $request->input('value_all_detail_aspek_penilaian')[0];
        $arr_detail_aspek = explode(',', $arr_detail_aspek);
        // dd($arr_detail_aspek);

        foreach ($arr_detail_aspek as $detail_aspek) {
            $data_detail = Detail_Aspek_Penilaian::create([
                'aspek_penilaian_id' => $aspek_penilaian->id,
                'nama_detail_aspek_penilaian' => $detail_aspek
            ]);
        }

        return redirect()->route('aspekpenilaian.index')->with('success', 'Aspek Penilaian Berhasil Ditambahkan');
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
        $data = Aspek_Penilaian::find($id);
        $data->delete();
        return redirect()->route('aspekpenilaian.index')->with('success', 'Aspek Penilaian Berhasil Dihapus');
    }
}

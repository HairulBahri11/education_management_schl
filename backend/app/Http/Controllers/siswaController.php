<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Pendaftaran;
use App\Models\Program;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class siswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Siswa::orderby('id', 'desc')->get();


        return view('dashboard.siswa.siswa', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pendaftaran = Pendaftaran::where('status_pembayaran', 'Sudah-Bayar')->orderby('id', 'desc')->get();
        return view('dashboard.siswa.siswa_create', compact('pendaftaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'pendaftaran_id' => 'required',
            'nama_siswa' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        if ($validasi->fails()) {
            return response($validasi->errors());
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalName();
            $filename = time() . '.' . $extension;
            $file = $file->storeAs('public/images', $filename);
        } else {
            $filename = '7309681.jpg';
        }

        $qrcode = 'BJ-' . Str::random(5) . '-' . date('Ymd');
        $data = Siswa::create([
            'pendaftaran_id' => $request->get('pendaftaran_id'),
            'kode_siswa' => $qrcode,
            'nama_siswa' => $request->get('nama_siswa'),
            'tempat_lahir' => $request->get('tempat_lahir'),
            'tgl_lahir' => $request->get('tgl_lahir'),
            'foto' => $filename
        ]);
        if ($data) {
            return redirect()->route('siswa.index')->with('success', 'Data Berhasil Disimpan');
        } else {
            return redirect()->back()->with('error', 'Data Gagal Disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Siswa::where('id', $id)->with('pendaftaran')->first();
        $orangtua = User::where('id', $data->pendaftaran->id_orangtua)->first();
        $orangtua_id = $orangtua->id;
        $siswa = $data->pendaftaran->nama_anak;

        // // cek program apa aja yang sudah diikuti oleh siswa itu
        $program = Pendaftaran::where('id_orangtua', $orangtua_id)->where('nama_anak', $siswa)->with('program')->get();

        return response()->json([
            'data' => $data,
            'orangtua' => $orangtua,
            'program' => $program

        ]);
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
        //
    }

    public function wa($nohp)
    {
        $nohp = $nohp;
        return redirect()->away('https://api.whatsapp.com/send?phone=' . $nohp);
    }
}

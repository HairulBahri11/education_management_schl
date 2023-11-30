<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\Manajemen_Kelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class absensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'pengajar') {
            $data = Absensi::where('pengajar_id', Auth::user()->id)->orderby('id', 'desc')->get();
        } else {
            $data = Absensi::orderby('id', 'desc')->get();
        }

        return view('dashboard.absensi.absensi', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jadwal = Jadwal::where('status', 'aktif')->orderby('id', 'desc')->get();
        $manajemen_kelas = Manajemen_Kelas::where('status', 'aktif')->get();
        if (Auth::user()->role == 'pengajar') {
            $jadwal = Jadwal::where('pengajar_id', Auth::user()->id)->where('status', 'aktif')->orderby('id', 'desc')->get();
            $manajemen_kelas = Manajemen_Kelas::where('status', 'aktif')->get();
        }
        return view('dashboard.absensi.absensi_create', compact('jadwal', 'manajemen_kelas'));
    }

    public function ajax()
    {
        $jadwal = Jadwal::where('status', 'aktif')->orderby('id', 'desc')->get();
        $manajemen_kelas = Manajemen_Kelas::where('status', 'aktif')->get();

        return response()->json([
            'jadwal' => $jadwal,
            'manajemen_kelas' => $manajemen_kelas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'jadwal_id' => 'required',
        ]);

        if ($data->fails()) {
            return response($data->errors());
        }

        $data = Jadwal::find($request->jadwal_id);
        $pengajar_id = $data->pengajar_id;
        $kelas_id = $data->kelas_id;

        $data = Absensi::create([
            'jadwal_id' => $request->jadwal_id,
            'pengajar_id' => $pengajar_id,
            'kelas_id' => $kelas_id,
            'tgl_absen' => Carbon::createFromDate($request->tgl_absen)->format('Y-m-d'),
        ]);
        // field ini harus uniq
        if (Auth::user()->role == 'pengajar') {
            if ($data) {
                return redirect('/absensi-pengajar')->with('success', 'Aktifasi Absen Berhasil');
            } else {
                return redirect('/absensi-pengajar')->with('error', 'Aktifasi Absen Gagal');
            }
        }

        if ($data) {
            return redirect('/absensi')->with('success', 'Aktifasi Absen Berhasil');
        } else {
            return redirect('/absensi')->with('error', 'Aktifasi Absen Gagal');
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
}

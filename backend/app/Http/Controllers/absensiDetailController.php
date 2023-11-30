<?php

namespace App\Http\Controllers;


use App\Models\Siswa;
use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\Absensi_Detail;
use App\Models\Manajemen_Kelas;
use Illuminate\Support\Facades\Auth;

class absensiDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
        $absensi_id = $id;
        $data_absensi = Absensi::where('id', $absensi_id)->first();
        $kelas_id = $data_absensi->kelas_id;
        $data_manajemen_kelas = Manajemen_Kelas::where('kelas_id', $kelas_id)->get();
        $data_manajemen_kelas = $data_manajemen_kelas->pluck('id')->toArray();
        $data_siswa = Manajemen_Kelas::where('kelas_id', $kelas_id)->get();
        $data_siswa = $data_siswa->pluck('siswa_id')->toArray();
        $data_siswa = Siswa::whereIn('id', $data_siswa)->get();


        for ($i = 0; $i < count($data_siswa); $i++) {
            $data = new Absensi_Detail();
            $data->absensi_id = $absensi_id;
            $data->siswa_id = $data_siswa[$i]->id;
            $data->manajemen_kelas_id = $data_manajemen_kelas[$i];
            $data->kehadiran = 'Alfa';
            $data->save();
        }

        if (Auth::user()->role == 'pengajar') {
            return redirect('/absensi-pengajar')->with('success', 'Absensi Berhasil Diaktifkan');
        }

        return redirect('/absensi')->with('success', 'Absensi Berhasil Diaktifkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Absensi_Detail::where('absensi_id', $id)->get();
        return view('dashboard.absensi.absensi-detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Absensi_Detail::where('absensi_id', $id)->get();
        $item_absen = Absensi_Detail::where('absensi_id', $id)->where('kehadiran', 'Hadir')->get();

        $absensi_id = $id;


        return view('dashboard.absensi.absensi_detail', compact('item', 'item_absen', 'absensi_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    public function absen(Request $request)
    {
        $kode_siswa = $request->kode_siswa;
        // $manajemen_kelas_id = $request->manajemen_kelas_id;
        $siswa = Siswa::where('kode_siswa', $kode_siswa)->first();

        // dd($manajemen_kelas_id);
        $siswa_id = $siswa->id;

        // dd($request->absensi_id);
        $cekabsen = Absensi_Detail::where('absensi_id', $request->absensi_id)->where('siswa_id', $siswa_id)->first();
        // dd($cekabsen);

        if ($cekabsen == null) {

            if (Auth::user()->role == 'pengajar') {

                return redirect('/absensi_detail-pengajar/' . $request->absensi_id)->with('error', 'Maaf Anda Bukan Termasuk Siswa Pada Jadwal Ini');
            }

            return redirect('/absensi_detail/' . $request->absensi_id)->with('error', 'Maaf Anda Bukan Termasuk Siswa Pada Jadwal Ini');
        } elseif ($cekabsen['kehadiran'] == 'Hadir') {

            if (Auth::user()->role == 'pengajar') {

                return redirect('/absensi_detail-pengajar/' . $request->absensi_id)->with('error', 'Maaf Anda Sudah Absen');
            }
            return redirect('/absensi_detail/' . $request->absensi_id)->with('error', 'Maaf Anda Sudah Absen');
        } else {
            $data = Absensi_Detail::where('absensi_id', $request->absensi_id)->where('siswa_id', $siswa_id)->first();
            // dd($data);
            $manajemen_kelas_id = Manajemen_Kelas::where('siswa_id', $siswa->id)->first();
            $manajemen_kelas_id = $manajemen_kelas_id->id;
            $data['kehadiran'] = 'Hadir';
            $data['absensi_id'] = $request->absensi_id;
            $data['siswa_id'] = $siswa_id;
            $data['manajemen_kelas_id'] = $manajemen_kelas_id;
            $data['tgl_absen'] = date('Y-m-d');
            $data->save();
            if (Auth::user()->role == 'pengajar') {
                return redirect('/absensi_detail-pengajar/' . $request->absensi_id)->with('success', 'Absensi Berhasil');
            }
            return redirect('/absensi_detail/' . $request->absensi_id)->with('success', 'Absensi Berhasil');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function setHadir(String $id)
    {
        $data = Absensi_Detail::where('id', $id)->first();
        $data->kehadiran = 'Hadir';
        $data->tgl_absen = date('Y-m-d');
        $data->save();

        if (Auth::user()->role == 'pengajar') {

            return redirect('/absensi_detail-pengajar/' . $data->absensi_id)->with('success', 'Absensi Berhasil Diubah Menjadi Hadir');
        }

        return redirect('/absensi_detail/' . $data->absensi_id)->with('success', 'Absensi Berhasil Diubah Menjadi Hadir');
    }

    public function setAlpa(String $id)
    {
        $data = Absensi_Detail::where('id', $id)->first();
        $data->kehadiran = 'Alfa';
        $data->tgl_absen = date('Y-m-d');
        $data->save();

        if (Auth::user()->role == 'pengajar') {

            return redirect('/absensi_detail-pengajar/' . $data->absensi_id)->with('success', 'Absensi Berhasil Diubah Menjadi Alpa');
        }


        return redirect('/absensi_detail/' . $data->absensi_id)->with('success', 'Absensi Berhasil Diubah Menjadi Alpa');
    }

    public function setIzin(String $id)
    {
        $data = Absensi_Detail::where('id', $id)->first();
        $data->kehadiran = 'Izin';
        $data->tgl_absen = date('Y-m-d');
        $data->save();

        if (Auth::user()->role == 'pengajar') {

            return redirect('/absensi_detail-pengajar/' . $data->absensi_id)->with('success', 'Absensi Berhasil Diubah Menjadi Izin');
        }


        return redirect('/absensi_detail/' . $data->absensi_id)->with('success', 'Absensi Berhasil Diubah Menjadi Izin');
    }

    public function setSakit(String $id)
    {
        $data = Absensi_Detail::where('id', $id)->first();
        $data->kehadiran = 'Sakit';
        $data->tgl_absen = date('Y-m-d');
        $data->save();
        if (Auth::user()->role == 'pengajar') {

            return redirect('/absensi_detail-pengajar/' . $data->absensi_id)->with('success', 'Absensi Berhasil Diubah Menjadi Sakit');
        }

        return redirect('/absensi_detail/' . $data->absensi_id)->with('success', 'Absensi Berhasil Diubah Menjadi Sakit');
    }
}

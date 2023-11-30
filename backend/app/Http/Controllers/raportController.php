<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Raport;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\Detail_Raport;
use App\Models\Aspek_Penilaian;
use Illuminate\Support\Facades\Auth;
use App\Models\Detail_Aspek_Penilaian;

class raportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(String $id_kelas, String $id_siswa)
    {
        $kelas = Kelas::find($id_kelas);
        $siswa = Siswa::find($id_siswa);
        if ($kelas->program->bidang == 'Robotik') {
            $aspek = Aspek_Penilaian::where('bidang', 'Robotik')->get();
            foreach ($aspek as $aspek) {
                $detail_aspek[] = Detail_Aspek_Penilaian::where('aspek_penilaian_id', $aspek->id)->get();
            }
        } elseif ($kelas->program->bidang == 'BahasaInggris') {
            $aspek = Aspek_Penilaian::where('bidang', 'BahasaInggris')->get();
            foreach ($aspek as $aspek) {
                $detail_aspek[] = Detail_Aspek_Penilaian::where('aspek_penilaian_id', $aspek->id)->get();
            }
        } elseif ($kelas->program->bidang == 'BahasaMandarin') {
            $aspek = Aspek_Penilaian::where('bidang', 'BahasaMandarin')->get();
            foreach ($aspek as $aspek) {
                $detail_aspek[] = Detail_Aspek_Penilaian::where('aspek_penilaian_id', $aspek->id)->get();
            }
        }
        // dd($aspek_penilaian_ar1);

        return view('dashboard.raport.raport_create', compact('kelas', 'siswa', 'detail_aspek'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $raport = Raport::create([
            'siswa_id' => $request->siswa_id,
            'kelas_id' => $request->kelas_id,
            'program_id' => $request->program_id,
            'pengajar_id' => $request->pengajar_id,
            'total_nilai' => 0,
            'awal_tahun_ajaran' => $request->awal_tahun_ajaran,
            'akhir_tahun_ajaran' => $request->akhir_tahun_ajaran,
            'topik_aktifitas' => $request->topik_aktifitas,
            'catatan' => $request->catatan
        ]);

        $simbol_mutu = '';
        // $i = 0;
        foreach ($request->nilai as $key => $value) {
            if ($value >= 90) {
                $simbol_mutu = 'A';
            } elseif ($value >= 80) {
                $simbol_mutu = 'B';
            } elseif ($value >= 70) {
                $simbol_mutu = 'C';
            } elseif ($value >= 60) {
                $simbol_mutu = 'D';
            } elseif ($value >= 50) {
                $simbol_mutu = 'E';
            } else {
                $simbol_mutu = 'F';
            }

            $raport_detail[] = Detail_Raport::create([
                'raport_id' => $raport->id,
                'aspek_id' => $request->aspek_id[$key],
                'detail_aspek_id' => $request->detail_aspek_id[$key],
                'simbol_mutu' => $simbol_mutu,
                'nilai' => $value
            ]);

            // $i++;
        }

        $raport->update([
            'total_nilai' => collect($raport_detail)->sum('nilai')
        ]);

        if (Auth::user()->role == 'pengajar') {
            return redirect('/raport-kelas-pengajar')->with('success', 'Data raport berhasil ditambahkan');
        }

        return redirect('/raport-kelas')->with('success', 'Data raport berhasil ditambahkan');
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
    public function edit(string $id_raport, string $id_kelas,  string $id_siswa)
    {
        // dd($id_raport, $id_kelas, $id_siswa);
        $kelas = Kelas::find($id_kelas);
        $siswa = Siswa::find($id_siswa);
        $raport = Raport::where('siswa_id', $id_siswa)->where('kelas_id', $id_kelas)->get();
        $detail_raport = Detail_Raport::where('raport_id', $id_raport)->get();

        return view('dashboard.raport.raport_lihat', compact('raport', 'detail_raport', 'siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data_raport = Raport::find($id);
        $data_raport = $data_raport->update([
            'siswa_id' => $request->siswa_id,
            'kelas_id' => $request->kelas_id,
            'program_id' => $request->program_id,
            'pengajar_id' => $request->pengajar_id,
            'total_nilai' => 0,
            'awal_tahun_ajaran' => $request->awal_tahun_ajaran,
            'akhir_tahun_ajaran' => $request->akhir_tahun_ajaran,
            'topik_aktifitas' => $request->topik_aktifitas,
            'catatan' => $request->catatan
        ]);

        // $data_raport->update();

        // dd($request->aspek_id);
        $simbol_mutu = '';
        // $i = 0;
        foreach ($request->nilai as $key => $value) {
            if ($value >= 90) {
                $simbol_mutu = 'A';
            } elseif ($value >= 80) {
                $simbol_mutu = 'B';
            } elseif ($value >= 70) {
                $simbol_mutu = 'C';
            } elseif ($value >= 60) {
                $simbol_mutu = 'D';
            } elseif ($value >= 50) {
                $simbol_mutu = 'E';
            } else {
                $simbol_mutu = 'F';
            }
            // $raport_detail = Detail_Raport::where('raport_id', $id)->get();
            // $raport_detail = $raport_detail->update([
            //     'raport_id' => $id,
            //     'aspek_id' => $request->aspek_id[$key],
            //     'detail_aspek_id' => $request->detail_aspek_id[$key],
            //     'simbol_mutu' => $simbol_mutu,
            //     'nilai' => $value
            // ]);
            $raport_detail = Detail_Raport::where('raport_id', $id)
                ->where('aspek_id', $request->aspek_id[$key])
                ->where('detail_aspek_id', $request->detail_aspek_id[$key])
                ->update([
                    'simbol_mutu' => $simbol_mutu,
                    'nilai' => $value
                ]);

            // update total_nilai

            $raport = Raport::find($id);

            if ($raport) {
                $raport->update([
                    'total_nilai' => Detail_Raport::where('raport_id', $id)->sum('nilai')
                ]);
            }
        }


        // $data_raport->save();
        if (Auth::user()->role == 'pengajar') {
            return redirect('/raport-kelas-pengajar')->with('success', 'Data raport berhasil diupdate');
        }
        return redirect('/raport-kelas')->with('success', 'Data raport berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cetak(string $id)
    {

        $raport = Raport::find($id);
        $detail_raport = Detail_Raport::where('raport_id', $id)->get();
        $kelas = Kelas::find($raport->kelas_id);
        $siswa = Siswa::find($raport->siswa_id);

        $detail_raport_index1 = $detail_raport[0]->aspek->id;
        $detail_raport_index2 = $detail_raport[count($detail_raport) - 1]->aspek->id;
        // dd($detail_raport_index1, $detail_raport_index2);
        $data_detail_raport_index1 = Detail_Raport::where('aspek_id', $detail_raport_index1)->where('raport_id', $id)->get();
        $data_detail_raport_index2 = Detail_Raport::where('aspek_id', $detail_raport_index2)->where('raport_id', $id)->get();

        return view('dashboard.raport.cetak_raport', compact('raport', 'siswa', 'kelas', 'detail_raport', 'data_detail_raport_index1', 'data_detail_raport_index2'));
    }
}

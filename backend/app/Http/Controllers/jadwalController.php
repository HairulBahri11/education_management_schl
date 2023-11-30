<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\Absensi;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class jadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Jadwal::whereHas('program', function ($query) {
            $query->where('kategori_program', 'Premium');
        })->get();

        if (Auth::user()->role == 'pengajar') {
            $data = Jadwal::where('pengajar_id', Auth::user()->id)->get();
        }


        return view('dashboard.jadwal-premium.jadwal-premium', compact('data'));
    }

    public function index_trial()
    {
        $data = Jadwal::whereHas('program', function ($query) {
            $query->where('kategori_program', 'Trial');
        })->get();

        return view('dashboard.jadwal-trial.jadwal-trial', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::whereHas('program', function ($query) {
            $query->where('kategori_program', 'Premium');
        })->where('status', 'aktif')->get();
        $pengajar = User::where('role', 'pengajar')->where('active', 1)->get();
        return view('dashboard.jadwal-premium.jadwal-premium_create', compact('kelas', 'pengajar'));
    }

    public function create_trial()
    {
        $kelas = Kelas::whereHas('program', function ($query) {
            $query->where('kategori_program', 'Trial');
        })->where('status', 'aktif')->get();
        $pengajar = User::where('role', 'pengajar')->where('active', 1)->get();
        return view('dashboard.jadwal-trial.jadwal-trial_create', compact('kelas', 'pengajar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'kelas_id' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'hari' => 'required',
        ]);

        $input_jm = $request->input('value_all_jam_mulai')[0];
        $input_jm = explode(',', $input_jm);
        $input_js = $request->input('value_all_jam_selesai')[0];
        $input_js = explode(',', $input_js);
        $input_h = $request->input('value_all_hari')[0];
        $input_h = explode(',', $input_h);




        if ($validasi->fails()) {
            return response($validasi->errors());
        }

        $jamMulai = collect($input_jm)->map(function ($jam) {
            return Carbon::createFromFormat('H:i', $jam)->format('H:i:s');
        });

        $jamSelesai = collect($input_js)->map(function ($jam) {
            return Carbon::createFromFormat('H:i', $jam)->format('H:i:s');
        });



        $kelas = Kelas::find($request->kelas_id);
        $program = $kelas->program_id;
        $pengajar = $kelas->pengajar_id;

        $i = 0;
        foreach ($input_h as $h => $value) {
            $data = Jadwal::create([
                'kelas_id' => $request->kelas_id,
                'program_id' => $program,
                'pengajar_id' => $pengajar,
                'jam_mulai' => $jamMulai[$i],
                'jam_selesai' => $jamSelesai[$i],
                'hari' => $value,
                'status' => 'Aktif'
            ]);
            // $absensi = Absensi::create([
            //     'jadwal_id' => $data->id,
            //     'pengajar_id' => $request->pengajar_id,
            //     'kelas_id' => $request->kelas_id,
            //     'Total_Hadir' => 0,
            //     'Total_Sakit' => 0,
            //     'Total_Izin' => 0,
            //     'Total_Alpa' => 0
            // ]);
            $i++;
        }


        if ($data) {
            return redirect('/jadwal-premium')->with('success', 'Data jadwal berhasil ditambahkan');
        } else {
            return back()->with('error', 'Data jadwal gagal ditambahkan');
        }
    }

    public function store_trial(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'kelas_id' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'hari' => 'required',
        ]);

        $input_jm = $request->input('value_all_jam_mulai')[0];
        $input_jm = explode(',', $input_jm);
        $input_js = $request->input('value_all_jam_selesai')[0];
        $input_js = explode(',', $input_js);
        $input_h = $request->input('value_all_hari')[0];
        $input_h = explode(',', $input_h);


        if ($validasi->fails()) {
            return response($validasi->errors());
        }

        $jamMulai = collect($input_jm)->map(function ($jam) {
            return Carbon::createFromFormat('H:i', $jam)->format('H:i:s');
        });

        $jamSelesai = collect($input_js)->map(function ($jam) {
            return Carbon::createFromFormat('H:i', $jam)->format('H:i:s');
        });

        $kelas = Kelas::find($request->kelas_id);
        $program = $kelas->program_id;
        $pengajar = $kelas->pengajar_id;

        $i = 0;
        foreach ($input_h as $h => $value) {
            $data = Jadwal::create([
                'kelas_id' => $request->kelas_id,
                'program_id' => $program,
                'pengajar_id' => $pengajar,
                'jam_mulai' => $jamMulai[$i],
                'jam_selesai' => $jamSelesai[$i],
                'hari' => $value,
                'status' => 'Aktif'
            ]);
            // $absensi = Absensi::create([
            //     'jadwal_id' => $data->id,
            //     'pengajar_id' => $request->pengajar_id,
            //     'kelas_id' => $request->kelas_id,
            //     'Total_Hadir' => 0,
            //     'Total_Sakit' => 0,
            //     'Total_Izin' => 0,
            //     'Total_Alpa' => 0
            // ]);
            $i++;
        }


        if ($data) {
            return redirect('/jadwal-trial')->with('success', 'Data jadwal berhasil ditambahkan');
        } else {
            return back()->with('error', 'Data jadwal gagal ditambahkan');
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

    public function setnonactive(String $id)
    {
        $data = Jadwal::find($id);

        if ($data->status == 'Aktif') {
            $data->status = 'Tidak Aktif';
            $status = "Status Jadwal Di Non Aktifkan";
        } else {
            $data->status = 'Aktif';
            $status = "Status Jadwal Di Aktifkan";
        }

        $data->save();

        return redirect('/jadwal-premium')->with('success', $status);
    }

    public function setnonactive_trial(String $id)
    {
        $data = Jadwal::find($id);

        if ($data->status == 'Aktif') {
            $data->status = 'Tidak Aktif';
            $status = "Status Jadwal Di Non Aktifkan";
        } else {
            $data->status = 'Aktif';
            $status = "Status Jadwal Di Aktifkan";
        }

        $data->save();

        return redirect('/jadwal-trial')->with('success', $status);
    }

    function getJadwal(String $id)
    {
        $data = Jadwal::find($id);
        // $pengajar = User::where('id', $data->pengajar_id)->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    function newdata(String $id)
    {
        $data = Jadwal::where('id', $id)->get();
        $pengajar = User::where('id', $data->pengajar_id)->get();
        return response()->json([
            'data' => $data,

        ]);
    }
}

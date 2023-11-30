<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Raport;
use App\Models\Petugas;
use App\Models\Program;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\Manajemen_Kelas;

use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class kelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data_kelas = Kelas::orderBy('id', 'desc')->get();
        // data kelas order by status aktif

        $data_kelas = Kelas::orderBy('status', 'asc')->get();
        $data_program = Program::all();
        if (Auth::user()->role == 'pengajar') {
        }
        return view('dashboard.kelas.kelas', compact('data_kelas', 'data_program'));
    }

    public function index_kelas_raport()
    {
        $data_kelas = Kelas::where('status', 'aktif')->orderBy('status', 'asc')->get();
        $data_program = Program::all();
        if (Auth::user()->role == 'pengajar') {
            $data_kelas = Kelas::where('status', 'aktif')->where('pengajar_id', Auth::user()->id)->orderBy('status', 'asc')->get();
            $data_program = Program::all();
        }
        return view('dashboard.raport.kelas', compact('data_kelas', 'data_program'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_kelas = Kelas::orderBy('id', 'desc')->get();
        if ($data_kelas->isEmpty()) {
            $nama_kelas = 'BJ1';
        } else {
            // Get the last class name
            $lastClassName = $data_kelas->first()->nama_kelas;
            // Extract the class number
            $lastClassNumber = intval(substr($lastClassName, 2));
            // Increment the class number
            $nextClassNumber = $lastClassNumber + 1;
            // Generate the new class name
            $nama_kelas = 'BJ' . $nextClassNumber;
        }
        // mengecek apakakh program terdaftar di kelas , jika iya maka program tersebut tidak bisa dipilih lagi
        // kecuali program premium , jadi untuk program premium bisa dipilih untuk beberapa kelas
        // Check if the program is already registered in a class
        $registeredPrograms = Kelas::pluck('program_id')->toArray();

        // Exclude the premium program from the check
        $excludedPrograms = Program::all()->pluck('id')->toArray();

        // Get the available programs that can be selected
        $data_program = Program::whereNotIn('id', $registeredPrograms)
            ->orWhereIn('id', $excludedPrograms)
            ->get();

        $data_pengajar = User::where('role', 'pengajar')->where('active', '1')->get();

        // Pass the available programs to the view
        // return view('dashboard.kelas.kelas_create', compact('data_kelas', 'availablePrograms', 'nama_kelas'));
        return view(
            'dashboard.kelas.kelas_create',
            compact(
                'data_kelas',
                'data_program',
                'nama_kelas',
                'data_pengajar'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'nama_kelas' => 'required',
            'program_id' => 'required',
        ]);

        if ($data->fails()) {
            return response($data->errors());
        }
        // dd($request->all());

        $req = $request->all();
        $req['siswa_idnya'] = explode(",", $req['siswa_idnya'][0]);
        // dd($req);

        $data  = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'program_id' => $request->program_id,
            'pengajar_id' => $request->pengajar_id,
            'status' => 'aktif'
        ]);

        // cek apakah siswa_id berupa array, jika iya lakukan looping perulangan
        if (is_array($req['siswa_idnya'])) {
            foreach ($req['siswa_idnya'] as $siswa_id) {
                $manajemen_kelas = Manajemen_Kelas::create([
                    'siswa_id' => $siswa_id,
                    'kelas_id' => $data->id,
                    'tgl_mulai' => $request->tgl_mulai,
                    'tgl_selesai' => $request->tgl_selesai,
                    'status' => 'aktif',
                    'program_id' => $request->program_id
                ]);
            }
        } else {
            $manajemen_kelas = Manajemen_Kelas::create([
                'siswa_id' => $req['siswa_idnya'],
                'kelas_id' => $data->id,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'status' => 'aktif',
                'program_id' => $request->program_id
            ]);
        }

        return redirect('/kelas')->with('success', 'Data Kelas Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelas = Kelas::find($id);
        return response()->json([
            $kelas
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function detail(string $id)
    {
        $data = Kelas::find($id);
        $data_siswa = Manajemen_Kelas::where('kelas_id', $data->id)->get();

        // dd($data_siswa);
        return view('dashboard.kelas.kelas_detail', compact('data', 'data_siswa'));
    }

    public function detail_siswa_raport(string $id)
    {
        $data = Kelas::find($id);
        $data_siswa = Manajemen_Kelas::where('kelas_id', $data->id)->get();

        // cek di raport apakah ada data siswa yang sudah diberi nilai
        $data_anak = $data_siswa->pluck('siswa_id')->toArray();
        // $data_raport = Raport::whereIn('id', $data_anak)->get();
        // if ($data_raport != null) {
        //     $hidden_raport = 'hidden';
        // } else {
        //     $hidden_raport = '';
        // }


        // dd($data_siswa);
        return view('dashboard.raport.kelas_detail', compact('data', 'data_siswa',));
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
    public function destroy(string $idkelas, string $idsiswa)
    {
        $data = Manajemen_Kelas::where('siswa_id', $idsiswa)->where('kelas_id', $idkelas)->delete();
        if ($data) {
            return redirect('kelas/' . $idkelas . '/detailkelas')->with('success', 'Data Siswa Berhasil Dihapus');
        } else {
            return redirect('kelas/' . $idkelas . '/detailkelas')->with('success', 'Data Gagal Dihapus');
        }
    }

    public function pilihsiswa($id_programnya)
    {
        // ambil data siswa berdasarkan data pendaftaran program yang dipilih
        $dataSiswa = Siswa::join('Pendaftaran', 'Siswa.pendaftaran_id', '=', 'Pendaftaran.id')
            ->join('Program', 'Pendaftaran.id_program', '=', 'Program.id')
            ->where('Program.id', $id_programnya)
            ->get();

        return response()->json($dataSiswa);
    }

    public function halPilihSiswa()
    {
        dd('halaman pilih siswa');
        return view('dashboard.kelas.kelas_pilihsiswa');
    }

    public function hal_tambahSiswa(String $id)
    {
        $data = Kelas::find($id);
        return view('dashboard.kelas.kelas_tambah-siswa', compact('data'));
    }
    public function tambahsiswa(Request $request, String $id)
    {
        $data_kelas = Kelas::find($id);
        // tambah siswa dikelas itu
        $validasi = Validator::make($request->all(), [
            'program_id' => 'required',
            'siswa_idnya' => 'required',
        ]);

        if ($validasi->fails()) {
            return back()->with('error', $validasi->errors());
        }

        $req = $request->all();
        $req['siswa_idnya'] = explode(",", $req['siswa_idnya'][0]);

        // cek apakah siswa_id berupa array, jika iya lakukan looping perulangan
        if (is_array($req['siswa_idnya'])) {
            foreach ($req['siswa_idnya'] as $siswa_id) {
                $manajemen_kelas = Manajemen_Kelas::create([
                    'siswa_id' => $siswa_id,
                    'kelas_id' => $id,
                    'tgl_mulai' => date('Y-m-d'),
                    'tgl_selesai' => date('Y-m-d'),
                    'status' => 'aktif',
                    'program_id' => $data_kelas->program_id
                ]);
            }
        } else {
            $manajemen_kelas = Manajemen_Kelas::create([
                'siswa_id' => $req['siswa_idnya'],
                'kelas_id' => $id,
                'tgl_mulai' => date('Y-m-d'),
                'tgl_selesai' => date('Y-m-d'),
                'status' => 'aktif',
                'program_id' => $data_kelas->program_id
            ]);
        }

        return redirect('kelas/' . $id . '/detailkelas')->with('success', 'Data Siswa Berhasil Ditambahkan');
    }

    public function setnonActive($id)
    {
        $data = Kelas::find($id);

        if ($data->status == 'aktif') {
            $data->status = 'Tidak Aktif';
            $status = "Status Kelas Di Non Aktifkan";
        } else {
            $data->status = 'aktif';
            $status = "Status Kelas Di Aktifkan";
        }

        $data->save();

        return redirect('/kelas')->with('success', $status);
    }
}

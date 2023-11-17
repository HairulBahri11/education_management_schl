<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\Absensi;
use App\Models\Absensi_Detail;
use App\Models\Program;
use App\Models\Pendaftaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\Manajemen_Kelas;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\alert;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Validator;

class pendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = Pendaftaran::orderby('id', 'desc')->get();
        $data = Pendaftaran::orderByRaw("FIELD(status_pembayaran, 'Menunggu-Konfirmasi', 'Sudah-Bayar', '-')")
            ->get();
        // dd($data);
        if (Auth::user()->role == 'orangtua') {
            // ambil data siswa yang terdaftar
            // $data = Pendaftaran::where('id_orangtua', Auth::user()->id)->get();
            // Mendapatkan ID pengguna yang sedang login
            $userId = Auth::id();

            $data = DB::table('Siswa')
                ->join('Pendaftaran', 'Siswa.pendaftaran_id', '=', 'Pendaftaran.id')
                ->where('Pendaftaran.id_orangtua', $userId)
                ->get();
            // dd($data);
            return view('dashboard-orangtua.pendaftaran.ortu-pendaftaran', compact('data'));
        }



        return view('dashboard.pendaftaran.pendaftaran', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orangtua = User::where('role', 'orangtua')->get();
        $program = Program::all();
        return view('dashboard.pendaftaran.pendaftaran_create', compact('orangtua', 'program'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'id_orangtua' => 'required',
            'nama_anak' => 'required',
            'asal_sekolah' => 'required',
            'id_program' => 'required',
            // 'catatan' => 'required',
        ]);

        if ($validasi->fails()) {

            return response($validasi->errors());
        }

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $extension = $file->getClientOriginalName();
            $filename = time() . '.' . $extension;
            $file = $file->storeAs('public/images', $filename);

            $statuspembayaran = $request->status_pembayaran;
        } else {
            $filename = '-';
            $statuspembayaran = '-';
        }

        // cek apakah pendaftaran tersebut trial , klok trial data langsung masuk ketabel siswa
        // cek apakah pendaftaran tersebut trial
        $data_program = Program::where('id', $request->id_program)->first();
        $kategori_kelasnya =  $data_program->kategori_program;


        if ($kategori_kelasnya == 'Trial') {

            $data = Pendaftaran::create([
                'kode_pendaftaran' => "Trial-IB-" . uniqid(),
                'id_orangtua' => $request->id_orangtua,
                'nama_anak' => $request->nama_anak,
                'asal_sekolah' => $request->asal_sekolah,
                'id_program' => $request->id_program,
                'status' => 'aktif',
                'tgl_daftar' => date('Y-m-d'),
                'catatan' => $request->catatan,
                'bukti_pembayaran' => $filename,
                'status_pembayaran' => $statuspembayaran,

            ]);

            // dicek lagi apakah data dia sudah terdata du tabel siswa
            // jika tidak simpan data langsung ke tabel siswa
            $data_pendaftaran = Pendaftaran::where('id', $data->id)->first();
            $id_datapendaftaran = $data_pendaftaran->id;
            $id_dataorangtuanya = $data_pendaftaran->id_orangtua;
            $id_namaanak = $data_pendaftaran->nama_anak;

            // dd($data_pendaftaran);
            // masih belum fix
            $data_siswa = Siswa::where('nama_siswa', $id_namaanak)->first();

            // dd($data_siswa);

            if ($data_siswa) {

                return redirect()->route('siswa.index')->with('success', 'Data Pendaftaran Kelas Baru Trial Berhasil Disimpan');
            } else {
                $data_pendaftaran = Pendaftaran::where('id', $data->id)->first();
                $id_datapendaftaran = $data_pendaftaran->id;


                // $data_siswa = Siswa::where('nama_siswa', $data_pendaftaran->nama_anak)->first();
                // $data_siswa = $data_siswa->id;




                // simpan data langsung ke tabel siswa
                $siswa = Siswa::create([
                    'pendaftaran_id' => $id_datapendaftaran,
                    'kode_siswa' => "BJ-" . Str::random(5) . '-' . date('Ymd'),
                    'nama_siswa' => $request->nama_anak,
                    'tempat_lahir' => '-',
                    'tgl_lahir' => date('Y-m-d'),
                    'foto' => '7309681.jpg',
                ]);

                // Check if the data was successfully saved
                if ($siswa) {
                    return redirect()->route('siswa.index')->with('success', 'Data Berhasil Disimpan dan Data Siswa Berhasil Ditambahkan');
                } else {
                    return redirect()->back()->with('error', 'Data Gagal Disimpan');
                }
            }
        } else {
            $data = Pendaftaran::create([
                'kode_pendaftaran' => "IB-" . uniqid(),
                'id_orangtua' => $request->id_orangtua,
                'nama_anak' => $request->nama_anak,
                'asal_sekolah' => $request->asal_sekolah,
                'id_program' => $request->id_program,
                'status' => 'aktif',
                'tgl_daftar' => date('Y-m-d'),
                'catatan' => $request->catatan,
                'bukti_pembayaran' => $filename,
                'status_pembayaran' => $statuspembayaran,

            ]);

            // dicek lagi apakah data dia sudah terdata du tabel siswa
            // jika tidak simpan data langsung ke tabel siswa
            $data_pendaftaran = Pendaftaran::where('id', $data->id)->first();
            $id_datapendaftaran = $data_pendaftaran->id;
            $id_dataorangtuanya = $data_pendaftaran->id_orangtua;
            $id_namaanak = $data_pendaftaran->nama_anak;

            // dd($data_pendaftaran);
            // masih belum fix
            $data_siswa = Siswa::where('nama_siswa', $id_namaanak)->first();

            // dd($data_siswa);

            if ($data_siswa) {

                return redirect()->route('siswa.index')->with('success', 'Data Pendaftaran Kelas Baru Trial Berhasil Disimpan');
            } else {
                $data_pendaftaran = Pendaftaran::where('id', $data->id)->first();
                $id_datapendaftaran = $data_pendaftaran->id;


                // $data_siswa = Siswa::where('nama_siswa', $data_pendaftaran->nama_anak)->first();
                // $data_siswa = $data_siswa->id;




                // simpan data langsung ke tabel siswa
                $siswa = Siswa::create([
                    'pendaftaran_id' => $id_datapendaftaran,
                    'kode_siswa' => "BJ-" . Str::random(5) . '-' . date('Ymd'),
                    'nama_siswa' => $request->nama_anak,
                    'tempat_lahir' => '-',
                    'tgl_lahir' => date('Y-m-d'),
                    'foto' => '7309681.jpg',
                ]);

                // Check if the data was successfully saved
                if ($siswa) {
                    return redirect()->route('siswa.index')->with('success', 'Data Berhasil Disimpan dan Data Siswa Berhasil Ditambahkan');
                } else {
                    return redirect()->back()->with('error', 'Data Gagal Disimpan');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */


    public function show(string $id)
    {
        // cek jika kode pendaftaran ada maka jangan tampilkan data prndaftaran
        // $data = Siswa::where('pendaftaran_id', $id)->first();

        // dd($data->pendaftaran->kode_pendaftaran);
        // $data = Pendaftaran::where('kode_pendaftaran', $id)->first();
        // $data_siswa = Siswa::where('pendaftaran_id', $data->id)->first();

        // if ($data_siswa) {
        //     return response()->json([
        //         'status' => false,

        //     ]);
        // } else {
        //     return Response()->json([
        //         'status' => true,
        //         'data' => $data

        //     ]);
        // }

        // $data = Pendaftaran::find($id);
        // return Response()->json([
        //     'status' => true,
        //     'data' => $data,
        // ]);



        // $data_pendaftaran = Pendaftaran::where('id_program' , $id)->get();
        // pluck id_orangtua dan nama_siswa

        // cek program trial apa bukan

        // $program = Program::find($id);

        // if ($program->kategori_program == 'Premium') {
        //     $data_pendaftaran = Pendaftaran::where('id_program', $id)->get();

        //     $data_siswa = Siswa::whereIn('nama_siswa', $data_pendaftaran->pluck('nama_anak'))->get();
        //     // cek apakah data siswa tersebut sudah ada di manajemen kelas atau belum
        //     $existingStudents = Manajemen_Kelas::whereIn('siswa_id', $data_siswa->pluck('id'))->where('program_id', $id)->get();

        //     $data_siswa = $data_siswa->filter(function ($siswa) use ($existingStudents) {
        //         // Filter hanya siswa yang tidak ada dalam manajemen kelas
        //         return !$existingStudents->contains('siswa_id', $siswa->id);
        //     });

        //     $data_siswanya = Siswa::whereIn('id', $data_siswa->pluck('id'))->get();
        // } else {
        //     $data_pendaftaran = Pendaftaran::where('id_program', $id)->get();

        //     $data_siswanya = Siswa::whereIn('nama_siswa', $data_pendaftaran->pluck('nama_anak'))->get();
        // }

        $program = Program::find($id);

        $data_pendaftaran = Pendaftaran::where('id_program', $id)->get();

        $data_siswa = Siswa::whereIn('nama_siswa', $data_pendaftaran->pluck('nama_anak'))->get();
        // cek apakah data siswa tersebut sudah ada di manajemen kelas atau belum
        $existingStudents = Manajemen_Kelas::whereIn('siswa_id', $data_siswa->pluck('id'))->where('program_id', $id)->get();

        $data_siswa = $data_siswa->filter(function ($siswa) use ($existingStudents) {
            // Filter hanya siswa yang tidak ada dalam manajemen kelas
            return !$existingStudents->contains('siswa_id', $siswa->id);
        });

        $data_siswanya = Siswa::whereIn('id', $data_siswa->pluck('id'))->get();
        return response()->json([
            'data' => $data_siswanya,
        ]);

        return response()->json([
            'data' => $data_siswanya,
        ]);
    }

    public function show_tambah(string $id)
    {
        $program = Program::find($id);

        $data_pendaftaran = Pendaftaran::where('id_program', $id)->get();

        $data_siswa = Siswa::whereIn('nama_siswa', $data_pendaftaran->pluck('nama_anak'))->get();
        // cek apakah data siswa tersebut sudah ada di manajemen kelas atau belum
        $existingStudents = Manajemen_Kelas::whereIn('siswa_id', $data_siswa->pluck('id'))->where('program_id', $id)->get();

        $data_siswa = $data_siswa->filter(function ($siswa) use ($existingStudents) {
            // Filter hanya siswa yang tidak ada dalam manajemen kelas
            return !$existingStudents->contains('siswa_id', $siswa->id);
        });

        $data_siswanya = Siswa::whereIn('id', $data_siswa->pluck('id'))->get();
        return response()->json([
            'data' => $data_siswanya,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Pendaftaran::find($id);
        return Response()->json($data);
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

    public function konfirmasi(string $id)
    {
        $data = Pendaftaran::find($id);
        $ortu_id = $data->id_orangtua;
        $nama_anak = $data->nama_anak;
        $data_siswa = Siswa::where('nama_siswa', $nama_anak)->first();
        // dd($data_siswa);
        if ($data_siswa) {
            $data->status_pembayaran = 'Sudah-Bayar';
            $statusnya = 'Konfirmasi Pembayaran Berhasil';
            $data->save();
        } else {
            // nambahin data siswa dan ubah status pembayaran pada pendaftaran
            $data->status_pembayaran = 'Sudah-Bayar';
            $qrcode = 'BJ-' . Str::random(5) . '-' . date('Ymd');
            $data_siswa = Siswa::create([
                'pendaftaran_id' => $data->id,
                'kode_siswa' => $qrcode,
                'nama_siswa' => $data->nama_anak,
                'tempat_lahir' => '-',
                'tgl_lahir' => date('Y-m-d'),
                'jenis_kelamin' => 'L',
                'foto' => '7309681.jpg',
            ]);

            $data->save();
            $statusnya = 'Konfirmasi Pembayaran Berhasil dan Data Siswa Berhasil Ditambahkan';
        }

        return redirect('/pendaftaran')->with('success', $statusnya);
    }

    public function hal_tambahbaru(string $id)
    {
        // pergi ke halaman untuk menambah program baru pada user
        $data = Pendaftaran::find($id);
        $id_program = $data->id_program;

        // cek programnya apakah dia sudah pernah daftar program itu
        $program = Program::whereNotIn('id', [$id_program])->get();
        return view('dashboard.pendaftaran.pendaftaran_create_datas', compact('data', 'program'));
    }


    public function hal_tambahbaruNew(string $id)
    {
        // id siswa = id
        $data_siswa = Siswa::find($id);
        $data_siswa_id_orangtua = $data_siswa->pendaftaran->id_orangtua;
        $data_siswa_nama_anak = $data_siswa->nama_siswa;


        // cek apakah data orangtua_id dan nama_siswa ada cek programnya apa aja
        $pendaftaran_data = Pendaftaran::where('id_orangtua', $data_siswa_id_orangtua)->where('nama_anak', $data_siswa_nama_anak)->get();


        $programIds = $pendaftaran_data->pluck('id_program')->all();
        $program = Program::whereNotIn('id', $programIds)->get();
        // dd($program);

        $data = $data_siswa;
        //Kami menggunakan pluck untuk mengambil semua nilai id_program dari koleksi $pendaftaran_data dan mengonversinya menjadi array.
        // Kemudian, kami melakukan query pada model Program untuk menemukan semua program yang id-nya tidak ada dalam array $programIds.

        return view('dashboard.pendaftaran.pendaftaran_create_datas', compact('data', 'program'));
    }

    // dashboard orangtua
    public function detail(string $id)
    {


        $data = Siswa::where('pendaftaran_id', $id)->first();
        $orangtuaId = Auth::user()->id;

        $data_program = Pendaftaran::where('id_orangtua', $orangtuaId)->where('nama_anak', $data->nama_siswa)->get();

        // data program yang belum pernah diambil
        $data_others_program = Program::whereNotIn('id', $data_program->pluck('id_program')->all())->get();
        // dd($data_others_program);
        $data_all_program = $data_others_program;

        // dd($data);
        // data kelas siswa diambil dari Manajemen_Kelas
        $data_kelas = Manajemen_Kelas::where('siswa_id', $data->id)->get();
        // dd(count($data_kelas));
        // dd($data_kelas[0]->kelas_id);
        // for ($i = 0; $i < count($data_kelas); $i++) {
        //     // $data_all_program = $data_all_program->merge(Program::where('id', $data_kelas[$i]->program_id)->get());
        //     $jadwal[$i] = Jadwal::where('kelas_id', $data_kelas[$i]->kelas_id)->get();
        // }

        // $absen = Absen::where()

        // cek absensi siswa
        // for ($i = 0; $i < count($data_kelas); $i++) {
        //     $absensi[$i] = Absensi_Detail::where('siswa_id', $data->id)->get();
        // }
        $absensi = Absensi_Detail::where('siswa_id', $data->id)->get();

        // dd($absensi);



        // dd($jadwal);
        // $jadwal = Jadwal::where('kelas_id', $data_kelas->kelas_id)->get();
        // dd($jadwal);

        return view('dashboard-orangtua.pendaftaran.ortu-detailpendaftaran', compact('data', 'data_program', 'data_all_program', 'absensi'));
    }

    // tambah data pendaftaran
    public function tambah_pendaftaran(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'id_orangtua' => 'required',
            'nama_anak' => 'required',
            'asal_sekolah' => 'required',
            'id_program' => 'required',
            // 'catatan' => 'required',
        ]);

        if ($validasi->fails()) {

            return response($validasi->errors());
        }

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $extension = $file->getClientOriginalName();
            $filename = time() . '.' . $extension;
            $file = $file->storeAs('public/images', $filename);

            $statuspembayaran = $request->status_pembayaran;
        } else {
            $filename = '-';
            $statuspembayaran = '-';
        }

        // cek apakah pendaftaran tersebut trial , klok trial data langsung masuk ketabel siswa
        // cek apakah pendaftaran tersebut trial
        $data_program = Program::where('id', $request->id_program)->first();
        $kategori_kelasnya =  $data_program->kategori_program;


        if ($kategori_kelasnya == 'Trial') {

            $data = Pendaftaran::create([
                'kode_pendaftaran' => "Trial-IB-" . uniqid(),
                'id_orangtua' => $request->id_orangtua,
                'nama_anak' => $request->nama_anak,
                'asal_sekolah' => $request->asal_sekolah,
                'id_program' => $request->id_program,
                'status' => 'aktif',
                'tgl_daftar' => date('Y-m-d'),
                'catatan' => $request->catatan,
                'bukti_pembayaran' => $filename,
                'status_pembayaran' => $statuspembayaran,

            ]);

            // dicek lagi apakah data dia sudah terdata du tabel siswa
            // jika tidak simpan data langsung ke tabel siswa
            $data_pendaftaran = Pendaftaran::where('id', $data->id)->first();
            $id_datapendaftaran = $data_pendaftaran->id;
            $id_dataorangtuanya = $data_pendaftaran->id_orangtua;
            $id_namaanak = $data_pendaftaran->nama_anak;

            // dd($data_pendaftaran);
            // masih belum fix
            $data_siswa = Siswa::where('nama_siswa', $id_namaanak)->first();

            // dd($data_siswa);

            if ($data_siswa) {

                return redirect()->route('siswa.index')->with('success', 'Data Pendaftaran Kelas Baru Trial Berhasil Disimpan');
            } else {
                $data_pendaftaran = Pendaftaran::where('id', $data->id)->first();
                $id_datapendaftaran = $data_pendaftaran->id;


                // $data_siswa = Siswa::where('nama_siswa', $data_pendaftaran->nama_anak)->first();
                // $data_siswa = $data_siswa->id;




                // simpan data langsung ke tabel siswa
                $siswa = Siswa::create([
                    'pendaftaran_id' => $id_datapendaftaran,
                    'kode_siswa' => "BJ-" . Str::random(5) . '-' . date('Ymd'),
                    'nama_siswa' => $request->nama_anak,
                    'tempat_lahir' => '-',
                    'tgl_lahir' => date('Y-m-d'),
                    'foto' => '7309681.jpg',
                ]);

                // Check if the data was successfully saved
                if ($siswa) {
                    return redirect()->back()->with('success', 'Data Berhasil Disimpan dan Data Siswa Berhasil Ditambahkan');
                } else {
                    return redirect()->back()->with('error', 'Data Gagal Disimpan');
                }
            }
        } else {
            $data = Pendaftaran::create([
                'kode_pendaftaran' => "IB-" . uniqid(),
                'id_orangtua' => $request->id_orangtua,
                'nama_anak' => $request->nama_anak,
                'asal_sekolah' => $request->asal_sekolah,
                'id_program' => $request->id_program,
                'status' => 'aktif',
                'tgl_daftar' => date('Y-m-d'),
                'catatan' => $request->catatan,
                'bukti_pembayaran' => $filename,
                'status_pembayaran' => $statuspembayaran,

            ]);

            // dicek lagi apakah data dia sudah terdata du tabel siswa
            // jika tidak simpan data langsung ke tabel siswa
            $data_pendaftaran = Pendaftaran::where('id', $data->id)->first();
            $id_datapendaftaran = $data_pendaftaran->id;
            $id_dataorangtuanya = $data_pendaftaran->id_orangtua;
            $id_namaanak = $data_pendaftaran->nama_anak;

            // dd($data_pendaftaran);
            // masih belum fix
            $data_siswa = Siswa::where('nama_siswa', $id_namaanak)->first();

            // dd($data_siswa);

            if ($data_siswa) {

                return redirect()->back()->with('success', 'Data Pendaftaran Kelas Baru Premium Berhasil Disimpan');
            } else {
                $data_pendaftaran = Pendaftaran::where('id', $data->id)->first();
                $id_datapendaftaran = $data_pendaftaran->id;


                // $data_siswa = Siswa::where('nama_siswa', $data_pendaftaran->nama_anak)->first();
                // $data_siswa = $data_siswa->id;




                // simpan data langsung ke tabel siswa
                $siswa = Siswa::create([
                    'pendaftaran_id' => $id_datapendaftaran,
                    'kode_siswa' => "BJ-" . Str::random(5) . '-' . date('Ymd'),
                    'nama_siswa' => $request->nama_anak,
                    'tempat_lahir' => '-',
                    'tgl_lahir' => date('Y-m-d'),
                    'foto' => '7309681.jpg',
                ]);

                // Check if the data was successfully saved
                if ($siswa) {
                    return redirect()->back()->with('success', 'Data Berhasil Disimpan dan Data Siswa Berhasil Ditambahkan');
                } else {
                    return redirect()->back()->with('error', 'Data Gagal Disimpan');
                }
            }
        }
    }
}

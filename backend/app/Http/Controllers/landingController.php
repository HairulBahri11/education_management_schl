<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Program;
use PDF;
use App\Models\Pendaftaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class landingController extends Controller
{
    public function index()
    {
        // Ambil data program urutan terakhir
        $programNew = Program::latest()->first(); // Mengambil program terbaru

        // Ambil semua program urutkan berdasarkan 'created_at' secara descending
        $premium_program = Program::where('kategori_program', 'Premium')->orderBy('created_at', 'desc')->paginate(3);
        $trial_program = Program::where('kategori_program', 'Trial')->orderBy('created_at', 'desc')->paginate(3);

        $all_premium_program = Program::where('kategori_program', 'Premium')->orderBy('created_at', 'desc')->get();
        $all_trial_program = Program::where('kategori_program', 'Trial')->orderBy('created_at', 'desc')->get();

        return view(
            'landing.landing',
            compact(
                'programNew',
                'premium_program',
                'trial_program',
                'all_premium_program',
                'all_trial_program'
            )
        );
    }

    public function daftarprogram(Request $request)
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

                return redirect()->back()->with('success', 'Data Pendaftaran Kelas Baru Trial Berhasil Disimpan');
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

    function cetakIdentitas(string $id)
    {

        $data = Siswa::where('id', $id)->first();

        return view('dashboard-orangtua.pendaftaran.cetak_kartu',  compact('data'));

        // $pdf = PDF::loadView('dashboard-orangtua.pendaftaran.cetak_kartu', [ 'data' => $data]);
        // $pdf->setPaper('a8', 'portrait');

        // return $pdf->download('cetak_kartu.pdf');

    }

    // function cetakKartu(string $id){
    //     $data = Siswa::where('id', $id)->first();

    //     $pdf = PDF::loadView('dashboard-orangtua.pendaftaran.cetak_kartu' , [ 'data' => $data]);
    //     $pdf->setPaper('a8', 'portrait');
    //     return $pdf->download('cetak_kartu.pdf');

    // }
}

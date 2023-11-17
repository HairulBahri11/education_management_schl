<?php

namespace App\Http\Controllers;

use App\Charts\pendaftaranBulananChart;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Program;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index(pendaftaranBulananChart $chart)
    {
        $chart = $chart->build();
        $data_pendaftaran = Pendaftaran::orderby('id', 'desc')->get();
        //sudah bayar
        $data_sudahbayar = Pendaftaran::where('status_pembayaran', 'Sudah-Bayar')->get();
        $total_harga_bayar = 0;
        foreach ($data_sudahbayar as $sudahbayar) {
            $total_harga_bayar += $sudahbayar->program->harga;
        }
        $frekuensi_sudahbayar = Pendaftaran::where('status_pembayaran', 'Sudah-Bayar')->count();
        //Belum Bayar
        $frekuensi_belumbayar = Pendaftaran::where('status_pembayaran', 'Belum-Bayar')->count();

        // Menunggu Konfirmasi
        $frekuensi_menunggukonfirmasi = Pendaftaran::where('status_pembayaran', 'Menunggu-Konfirmasi')->count();


        $frekuensi_pengajar = User::where('role', 'pengajar')->count();
        $frekuensi_siswa = Siswa::all()->count();

        // frekuensi yang daftar program premium
        $data = Pendaftaran::all();
        $premiumCount = $data->where('program.kategori_program', 'Premium')->count();
        $trialCount = $data->where('program.kategori_program', 'Trial')->count();
        // dd($premiumCount, $trialCount);

        if (Auth::user()->role == 'orangtua') {
            $data = Pendaftaran::where('id_orangtua', Auth::user()->id)->get();
            $premiumCount = $data->where('program.kategori_program', 'Premium')->count();
            $trialCount = $data->where('program.kategori_program', 'Trial')->count();
            $frekuensi_sudahbayar = Pendaftaran::where('id_orangtua', Auth::user()->id)->where('status_pembayaran', 'Sudah-Bayar')->count();
            //Belum Bayar
            $frekuensi_belumbayar = Pendaftaran::where('id_orangtua', Auth::user()->id)->where('status_pembayaran', 'Belum-Bayar')->count();

            // Menunggu Konfirmasi
            $frekuensi_menunggukonfirmasi = Pendaftaran::where('id_orangtua', Auth::user()->id)->where('status_pembayaran', 'Menunggu-Konfirmasi')->count();
        }

        $kirim = [
            'chart' => $chart,
            'total_harga_bayar' => $total_harga_bayar,
            'frekuensi_sudahbayar' => $frekuensi_sudahbayar,
            'frekuensi_belumbayar' => $frekuensi_belumbayar,
            'frekuensi_menunggukonfirmasi' => $frekuensi_menunggukonfirmasi,
            'frekuensi_pengajar' => $frekuensi_pengajar,
            'frekuensi_siswa' => $frekuensi_siswa,
            'premiumCount' => $premiumCount,
            'trialCount' => $trialCount

        ];


        return view('dashboard.dashboard', compact('kirim'));
    }

    public function dashboard_ortu()
    {
    }
}

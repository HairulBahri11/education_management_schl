<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

use function PHPSTORM_META\map;

class PendaftaranExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pendaftaran::orderBy('id', 'desc')->get();
    }

    public function map($pendaftaran): array
    {
        // Sesuaikan dengan cara Anda ingin memetakan data
        return [
            $pendaftaran->kode_pendaftaran,
            $pendaftaran->nama_anak,
            $pendaftaran->asal_sekolah,
            $pendaftaran->program->bidang,
            $pendaftaran->program->nama_program,
            $pendaftaran->program->jeniskelas->nama_jenis_kelas,
            $pendaftaran->tgl_daftar,
            $pendaftaran->orangtua->nama,
            $pendaftaran->orangtua->email,
            $pendaftaran->bukti_pembayaran,
            $pendaftaran->status_pembayaran,
            $pendaftaran->catatan,
            $pendaftaran->created_at,
            // Tambahkan kolom lainnya sesuai kebutuhan
        ];
    }

    public function headings(): array
    {
        // Sesuaikan dengan nama kolom yang ingin Anda tampilkan
        return [
            'Kode Pendaftaran',
            'Nama Anak',
            'Asal Sekolah',
            'Bidang Program',
            'Program',
            'Jenis Program',
            'Tanggal Pendaftaran',
            'Nama Orangtua',
            'Email Orangtua',
            'Bukti Pembayaran',
            'Status Pembayaran',
            'Catatan',
            'Detail Waktu Pendaftaran',
            // Tambahkan kolom lainnya sesuai kebutuhan
        ];
    }
}

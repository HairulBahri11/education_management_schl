<?php

namespace App\Repositories;

use App\Models\Program;
use Illuminate\Support\Facades\Storage;


class ProgramRepository
{
    public function getAllData()
    {
        $data = Program::orderby('nama_program', 'asc')->with('jeniskelas')->get();
        if (empty($data)) {
            return [];
        } else {
            return $data;
        }
    }



    public function getData($id)
    {
        $data = Program::find($id)->with('jeniskelas')->get();
        if (empty($data)) {
            return [];
        } else {
            return $data;
        }
    }

    public function save($data)
    {
        $program = new Program();
        $program->nama_program = $data['nama_program'];
        $program->kategori_program = $data['kategori_program'];
        $program->deskripsi = $data['deskripsi'];


        // Memeriksa apakah ada file gambar yang diunggah
        if (isset($data['gambar'])) {
            $gambar = $data['gambar'];
            $nama_gambar = time() . $gambar->getClientOriginalName();

            // Menyimpan gambar ke direktori tertentu
            $gambar->storeAs('public/images', $nama_gambar);
            // Menyimpan nama gambar ke dalam atribut program
            $program->gambar = $nama_gambar;
        }

        $program->harga = $data['harga'];
        $program->active = 1;

        // Menyimpan objek Program ke dalam database
        $program->save();

        return $program;
    }

    public function update($data, $id){
        $program = Program::find($id)->with('jeniskelas')->get();
        $program->nama_program = $data['nama_program'];
        $program->kategori_program = $data['kategori_program'];
        $program->deskripsi = $data['deskripsi'];

        if (isset($data['gambar'])) {
            $gambar = $data['gambar'];
            $nama_gambar = time() . $gambar->getClientOriginalName();

            // Menyimpan gambar ke direktori tertentu
            $gambar->storeAs('public/images', $nama_gambar);
            // Menyimpan nama gambar ke dalam atribut program
            $program->gambar = $nama_gambar;
        }

        $program->harga = $data['harga'];
        $program->active = 1;

        // Menyimpan objek Program ke dalam database
        $program->save();

        return $program;
    }


    public function hapus($id){
        $program = Program::find($id);

        $path = 'public/images/produk/';
        Storage::delete($path . $program->foto_produk);
            //destroy from storage to

        $program->delete();
        return $program;
    }
}

<?php


namespace App\Repositories;

use App\Models\Jenis_Kelas;


class Jenis_KelasRepository{


    public function getAllData()
    {
        $data = Jenis_Kelas::all();
        if (empty($data)) {
            return [];
        } else {
            return $data;
        }
    }

    public function getData($id){
        $data = Jenis_Kelas::find($id);
        if (empty($data)) {
            return [];
        } else {
            return $data;
        }
    }

    public function save($data){
        $jeniskelas = new Jenis_Kelas();
        $jeniskelas->nama_jenis_kelas = $data['nama_jenis_kelas'];
        $jeniskelas->deskripsi = $data['deskripsi'];

        $jeniskelas->save();
        return $jeniskelas;
    }

    public function update($data, $id){
        $jeniskelas =jenis_Kelas::find($id);
        $jeniskelas->nama_jenis_kelas = $data['nama_jenis_kelas'];
        $jeniskelas->deskripsi = $data['deskripsi'];

        $jeniskelas->save();

        return $jeniskelas;
    }

    public function hapus($id){
        $jeniskelas =jenis_Kelas::find($id);
        $jeniskelas->delete();

        return $jeniskelas;
    }

}

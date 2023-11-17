<?php


namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Repositories\Jenis_KelasRepository;

class Jenis_KelasService
{
    protected $Jenis_KelasRepository;

    public function __construct(Jenis_KelasRepository $Jenis_KelasRepository){

        $this->Jenis_KelasRepository = $Jenis_KelasRepository;

    }

    public function getAllData()
    {
        return $this->Jenis_KelasRepository->getAllData();
    }

    public function getData($id){
        return $this->Jenis_KelasRepository->getData($id);
    }

    public function save($data){

        $validasi = Validator::make($data, [
            'nama_jenis_kelas' => 'required',
        ]);

        if ($validasi->fails()) {
            return $validasi->errors();
        }
        return $this->Jenis_KelasRepository->save($data);
    }

    public function update($data, $id){
        $validasi = Validator::make($data, [
            'nama_jenis_kelas' => 'required',
        ]);
        if ($validasi->fails()) {
            return $validasi->errors();
        }
        return $this->Jenis_KelasRepository->update($data, $id);
    }

    public function hapus($id){

        return $this->Jenis_KelasRepository->hapus($id);
    }


}

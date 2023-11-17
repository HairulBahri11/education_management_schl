<?php

namespace App\Services;

use App\Repositories\ProgramRepository;
use Illuminate\Support\Facades\Validator;

class ProgramService
{

    protected $ProgramRepository;

    public function __construct(ProgramRepository $ProgramRepository)
    {
        $this->ProgramRepository = $ProgramRepository;
    }

    public function getAllData()
    {
        return $this->ProgramRepository->getAllData();
    }

    public function getData($id)
    {
        return $this->ProgramRepository->getData($id);
    }

    public function save($data)
    {
        $validasi = Validator::make($data, [
            'nama_program' => 'required',
            'kategori_program' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required |mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required',
        ]);
        if ($validasi->fails()) {
            return $validasi->errors();
        }

        $result = $this->ProgramRepository->save($data);
        return $result;
    }

    public function update($data, $id){
        $validasi = Validator::make($data, [
            'nama_program' => 'required',
            'kategori_program' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required',
        ]);
        if ($validasi->fails()) {
            return $validasi->errors();
        }

        $result = $this->ProgramRepository->update($data, $id);
        return $result;
    }

    public function delete($id){
        $result = $this->ProgramRepository->hapus($id);
        return $result;
    }
}

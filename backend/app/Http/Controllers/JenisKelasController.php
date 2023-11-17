<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use App\Services\Jenis_KelasService;

class JenisKelasController extends Controller
{
    protected $JenisKelasService;

    public function __construct(Jenis_KelasService $JenisKelasService)
    {
        $this->JenisKelasService = $JenisKelasService;
    }



    public function index()
    {
        $data = $this->JenisKelasService->getAllData();
        return response()->json([
            'data' => $data
        ]);

    }

    public function show($id)
    {
        $data = $this->JenisKelasService->getData($id);
        return response()->json([
            'data' => $data
        ]);

    }

    public function store(Request $request){

        try {
            $data = $request->all();
            $data = $this->JenisKelasService->save($data);
            return response()->json([
                'message' => 'Data berhasil disimpan',
                'data' => $data
            ], 201);
        } catch (Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id){

        try {
            $data = $request->all();
            $data = $this->JenisKelasService->update($data, $id);
            return response()->json([
                'message' => 'Data berhasil diubah',
                'data' => $data
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($id){

        try {
            $data = $this->JenisKelasService->hapus($id);
            return response()->json([
                'message' => 'Data berhasil dihapus',
                'data' => $data
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Jenis_Kelas;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ProgramControllerFix extends Controller
{
    public function index()
    {
        //ambil data program where id tidak sama dengan id_program di tabel kelas
        $data = Program::orderby('id', 'desc')->get();


        return view('dashboard.program.program', compact('data'));
    }

    public function show($id)
    {

        $kelas = Jenis_Kelas::all();
        //ambil data program where id tidak sama dengan id_program di tabel kelas
        $data = Program::with('jeniskelas')->find($id);
        return response()->json($data);
    }

    public function create()
    {

        $jeniskelas = Jenis_Kelas::all();

        return view('dashboard.program.program_create', compact('jeniskelas'));
    }

    public function store(Request $request)
    {

        $validasi = Validator::make($request->all(), [
            'nama_program' => 'required',
            'kategori_program' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required |mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required',
            'durasi' => 'required',
            'bidang' => 'required',
        ]);
        if ($validasi->fails()) {
            return $validasi->errors();
        }

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalName();
            $filename = time() . '.' . $extension;
            $file = $file->storeAs('public/images', $filename);
        }

        $data = Program::create([
            'nama_program' => $request->get('nama_program'),
            'kategori_program' => $request->get('kategori_program'),
            'deskripsi' => $request->get('deskripsi'),
            'gambar' => $filename,
            'harga' => $request->get('harga'),
            'active' => 1,
            'jeniskelas_id' => $request->get('jeniskelas_id'),
            'durasi' => $request->get('durasi'),
            'bidang' => $request->get('bidang'),
        ]);

        if ($data) {
            return redirect('/program')->with('success', 'Data Berhasil Disimpan');
        } else {
            return redirect('/program')->with('error', 'Data Gagal');
        }
    }

    public function edit($id)
    {
        $data = Program::find($id);
        $jeniskelas = Jenis_Kelas::all();
        return view('dashboard.program.program_edit', compact('data', 'jeniskelas'));
    }

    public function update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'nama_program' => 'required',
            'kategori_program' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
        ]);
        if ($validasi->fails()) {
            return $validasi->errors();
        }




        $data = Program::find($id);
        $data->nama_program = $request->get('nama_program');
        $data->kategori_program = $request->get('kategori_program');
        $data->deskripsi = $request->get('deskripsi');
        $data->harga = $request->get('harga');
        $data->active = 1;
        $data->jeniskelas_id = $request->get('jeniskelas_id');
        $data->durasi = $request->get('durasi');
        $data->bidang = $request->get('bidang');



        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalName();
            $filename = $extension;
            $file = $file->storeAs('public/images', $filename);
            $data->gambar = $filename;
        }

        $data->save();

        if ($data) {
            return redirect('/program')->with('success', 'Data Berhasil Disimpan');
        } else {
            return redirect('/program')->with('error', 'Data Gagal');
        }
    }


    public function destroy($id)
    {
        $data = Program::find($id);
        $path = 'public/images/';
        Storage::delete($path . $data->gambar);
        $data->delete();
        if ($data) {
            return redirect('/program')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect('/program')->with('error', 'Data Gagal');
        }
    }

    public function getkategori(string $id)
    {
        $data = Program::find($id);
        return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class pengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('role', 'pengajar')->get();
        return view('dashboard/pengajar/pengajar', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard/pengajar/pengajar_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        if ($validasi->fails()) {
            return $validasi->errors();
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalName();
            $filename = time() . '-' . $extension;
            $file = $file->storeAs('public/images', $filename);
        } else {
            $filename = '7309681.jpg';
        }

        $data = User::create([
            'nama' => $request->get('nama'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role' => 'pengajar',
            'alamat' => $request->get('alamat'),
            'active' => 1,
            'foto' => $filename,
            'no_hp' => $request->get('no_hp')

        ]);

        $data->assignRole('pengajar');

        if ($data) {
            return redirect('/pengajar')->with('success', 'Data Berhasil Ditambahkan');
        } else {
            return redirect('/pengajar')->with('error', 'Data Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::find($id);
        return view('dashboard/pengajar/pengajar_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        if ($validasi->fails()) {
            return $validasi->errors();
        }

        $data = User::find($id);
        $data->nama = $request->get('nama');
        $data->email = $request->get('email');
        $data->alamat = $request->get('alamat');
        $data->no_hp = $request->get('no_hp');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalName();
            $filename = time() . '.' . $extension;
            $file = $file->storeAs('public/images', $filename);
            $data->foto = $filename;
        }

        // // jika request mengisi form input password
        // if ($request->has('password')) {
        //     $data->password = bcrypt($request->get('password'));
        // } else {
        //     dd($request->get('password'));
        // }
        // jika request mengisi form input password
        if ($request->filled('password')) {
            // Menggunakan bcrypt untuk menghash password sebelum disimpan
            $data->password = bcrypt($request->get('password'));
        }


        $data->assignRole('pengajar');

        $data->save();

        if ($data) {
            return redirect('/pengajar')->with('success', 'Data Berhasil Diubah');
        } else {
            return redirect('/pengajar')->with('error', 'Data Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function wa($nohp)
    {
        $nohp = $nohp;
        return redirect()->away('https://api.whatsapp.com/send?phone=' . $nohp);
    }

    public function setnonActive($id)
    {
        $data = User::find($id);

        if ($data->active == 1) {
            $data->active = 0;
            $status = "Status Pengajar Di Non Active";
        } else {
            $data->active = 1;
            $status = "Status Pengajar Di Active";
        }



        $data->save();

        return redirect('/pengajar')->with('success', $status);
    }
}

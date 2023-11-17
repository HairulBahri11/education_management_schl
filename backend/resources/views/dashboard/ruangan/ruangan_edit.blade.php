@extends('dashboard/index')
@section('active_ruangan', 'active')
@section('content')
    <div class="dashboard-content px-3 pt-5">
        <div class="container">
            <div class="row mb-3">
                <div class="container">
                    <div class="col-md-5">
                        <h2 class="ms-4" style="font-weight: bold">Edit Ruangan</h2>
                    </div>
                    <div class="col-md-5 float-end">
                        <form action="{{ route('ruangan.update' , $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="float-end">
                                <button type="submit" class="btn custom-btn-primary hover-btn text-white"> <i
                                        class="fa-solid fa-floppy-disk text-white"></i> Simpan</button>
                            </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="box-content">
                    <div class="col bg-white">
                        <div class="p-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Ruangan</label>
                                        <input type="text" name="nama_ruangan" class="form-control"
                                            id="exampleFormControlInput1" placeholder="Ex. Melati" required value="{{ $data->nama_ruangan }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Kapasitas</label>

                                        <input type="number" class="form-control" name="kapasitas" id="harga"
                                            placeholder="Ex. 10 orang" required value="{{ $data->kapasitas }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Petugas Ruangan</label>
                                        <select name="petugas_id" class="form-control" id="petugas_id"
                                            onchange="getKategori()" required>
                                            <option class="form-control" value="{{ $data->petugas_id }}"> {{ $data->petugas->nama_petugas  }}</option>
                                            @foreach ($petugas as $item)
                                                <option value="{{ $item->id }}">{{ $item->id }} - {{ $item->nama_petugas }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection


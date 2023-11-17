@extends('dashboard/index')
@section('active_petugas', 'active')
@section('content')
    <div class="dashboard-content px-3 pt-5">
        <div class="container">
            <div class="row mb-3">
                <div class="container">
                    <div class="col-md-5">
                        <h4 style="font-weight: bold">Edit Petugas</h4>
                    </div>
                    <div class="col-md-5 float-end">
                        <form action="{{ route('petugas.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="float-end">
                                <button type="submit" class="btn custom-btn-primary hover-btn text-white"> <i
                                        class="fa-solid fa-floppy-disk text-white"></i> Simpan</button>
                            </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mb-3">
                    <div class="box-content">
                        <div class="col bg-white">
                            <div class="p-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Nama Petugas</label>
                                            <input type="text" name="nama_petugas" class="form-control"
                                                id="exampleFormControlInput1" placeholder="Ex. Joghardi" required
                                                value="{{ $data->nama_petugas }}">
                                        </div>


                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Whatsapp</label>

                                            <input type="number" class="form-control" name="no_hp" id="harga"
                                                placeholder="6285123456789" required value="{{ $data->no_hp }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Foto</label>
                                            <input type="file" name="photo" class="form-control"
                                                id="exampleFormControlTextarea1" rows="3">
                                            <img src="{{ asset('storage/images/' . $data->photo) }}" class="mt-2"
                                                width="100" alt="">
                                            <span>{{ $data->photo }}</span>
                                        </div>


                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Alamat </label>
                                            <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="8"
                                                placeholder="Alamat lengkap" required>{{ $data->alamat }}</textarea>
                                        </div>


                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

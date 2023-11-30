@extends('dashboard/index')
@section('active_pengajar', 'active')
@section('content')
    <div class="dashboard-content px-3 pt-5">
        <div class="container">
            <div class="row mb-3">
                <div class="container">
                    <div class="col-md-5" data-aos="fade-right" data-aos-duration="1000">
                        <h2 class="ms-4" style="font-weight: bold">Edit pengajar</h2>
                    </div>
                    <div class="col-md-5 float-end" data-aos="fade-left" data-aos-duration="1000">
                        <form action="{{ route('pengajar.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="float-end">
                                <button type="submit" class="btn custom-btn-primary hover-btn text-white"> <i
                                        class="fa-solid fa-floppy-disk text-white"></i> Simpan</button>
                            </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3" data-aos="fade-left" data-aos-duration="1500">
                <div class="box-content">
                    <div class="col bg-white">
                        <div class="p-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama pengajar</label>
                                        <input type="text" name="nama" class="form-control"
                                            id="exampleFormControlInput1" placeholder="Ex. Joghardi" required
                                            value="{{ $data->nama }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            id="exampleFormControlInput1" placeholder="Ex. Joghardi" required
                                            value="{{ $data->email }}">

                                    </div>
                                    <div class="password-edit" onchange="editPassword()">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="exampleFormControlInput1" placeholder="Password awal">
                                            <span style="font-size: 12px; color: red"> isi jika ingin mengubah
                                                password</span>

                                        </div>
                                        {{-- <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Password Baru</label>
                                            <input type="password" name="passwordbaru" class="form-control"
                                                id="exampleFormControlInput1" placeholder="Password baru">
                                        </div> --}}
                                    </div>
                                </div>




                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Whatsapp</label>

                                        <input type="number" class="form-control" name="no_hp" id="harga"
                                            placeholder="6285123456789" required value="{{ $data->no_hp }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Foto</label>
                                        <input type="file" name="foto" class="form-control"
                                            id="exampleFormControlTextarea1" rows="3">
                                        <p style="font-size: 12px; color: red"> isi jika ingin mengubah foto</p>
                                        <img src="{{ asset('storage/images/' . $data->foto) }}" class="mt-2"
                                            width="100" alt="">
                                        <span>{{ $data->foto }}</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Alamat </label>
                                    <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3"
                                        placeholder="Alamat lengkap" required>{{ $data->alamat }}</textarea>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        @endsection

        <script>
            // ini buat dari sisi petugas atau orang tua aja
            function editPassword() {
                $(document).ready(function() {
                    $('.password-edit').keyup(function() {
                        if ($('.password-database').val() == $('.passwordbaru').val()) {
                            $('.passwordbaru').attr('required', true);
                        } else {
                            $('.passwordbaru').attr('required', false);
                        }
                    });
                })
            }
        </script>

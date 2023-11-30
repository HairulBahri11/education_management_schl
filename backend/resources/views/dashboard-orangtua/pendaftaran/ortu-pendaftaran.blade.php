@extends('dashboard-orangtua/index')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('pendaftaran.index.ortu') }}">Pendaftaran</a></li>
@endsection
{{-- @section('active_pendaftaran', 'active') --}}
{{-- @section('show_manajemensiswa', 'show') --}}
@section('content')
    <section class="py-2">
        <div class="container">
            <div class="row">
                <h4 class=" mt-2 fw-bold"> Data Pendaftaran</h4>
            </div>
            <div class="row">
                @foreach ($data as $data)
                    <div class="col-md-4 mb-4">
                        <div class="box-card-custom bg-white p-3" style="border-radius: 10px">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card border-1 ">
                                        <div class="card-body ">

                                            <div class="row">
                                                <div class="col-md-12">

                                                    <div class="prfil d-flex justify-content-center align-items-center">
                                                        <img src="{{ asset('storage/images/' . $data->foto) }}"
                                                            class="img-fluid rounded-circle d-flex justify-content-center align-items-center"
                                                            style="width: 60px; height: 60px; object-fit: cover; object-position: center  }}"
                                                            alt="">
                                                    </div>


                                                    <p class="card-text text-secondary text-center fw-bold mt-2">
                                                        {{ $data->nama_siswa }}</p>
                                                    </p>

                                                    <div class="qr d-flex justify-content-center align-items-center ">
                                                        <p>{!! QrCode::size(70)->generate($data->kode_siswa) !!}</p>
                                                    </div>
                                                    <p class=" text-secondary text-center">
                                                        <img src="{{ asset('logo.png') }}" class="img-fluid"
                                                            style="width: 40px; height: 30px" alt="">
                                                        Student Center
                                                    </p>
                                                    <p class="text-secondary text-center" style="font-size: 12px">Jln.
                                                        Manggasari Probolinggo Jawa Timur </p>
                                                    <a href="{{ route('pendaftaran.detail', $data->id) }}"
                                                        class="btn btn-success form-control btn-sm mt-2">
                                                        Detail Siswa
                                                    </a>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </section>



    </div>
@endsection

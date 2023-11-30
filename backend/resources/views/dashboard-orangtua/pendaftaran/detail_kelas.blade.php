@extends('dashboard-orangtua/index')
{{-- @section('active_pendaftaran', 'active') --}}
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ route('pendaftaran.index.ortu') }}">Pendaftaran</a></li>
    <li class="breadcrumb-item "><a href="{{ route('pendaftaran.detail', $data_siswa->pendaftaran->id) }}">Detail
            Pendaftaran</a></li>
    <li class="breadcrumb-item active">Detail Kelas</li>
@endsection
@section('content')
    <style>
        #table-program,
        #example {
            font-size: 12px;
        }
    </style>

    @if (session('success'))
        <script>
            swal({
                title: "Good job!",
                text: "{{ session('success') }}!",
                icon: "success",
                button: "OK",
            });
        </script>
    @elseif (session('error'))
        <script>
            swal({
                title: "Oops!",
                text: "{{ session('error') }}!",
                icon: "error",
                button: "OK",
            });
        </script>
    @endif



    <div class="dashboard-content px-3 pt-5">
        <div class="container">
            <div class="row mb-2 d-flex justify-content-between">

                <div class="col-md-6 " data-aos="fade-left" data-aos-duration="1000">
                    <h4 class="fw-bold">Detail Kelas</h4>
                </div>
                <div class="col-md-6 text-end" data-aos="fade-left" data-aos-duration="1000">

                    @if ($raport != null)
                        <a href="{{ route('pendaftaran.cetak-raport', $raport->id) }}"
                            class="btn btn-primary hover-btn btn-sm mt-2 " target="_blank">
                            <i class="fa fa-print text-white p-2"></i>
                            Raport</a>
                    @endif


                </div>

            </div>
            <div class="row">
                {{-- buat tingginya sesuai ukuran data --}}
                <div class="col-md-4 mb-4" data-aos="fade-right" data-aos-duration="1500">
                    <div class="box-card-custom bg-white p-3" style="border-radius: 10px">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-1 ">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="prfil d-flex justify-content-center align-items-center">
                                                    <img src="{{ asset('storage/images/' . $data_siswa->foto) }}"
                                                        class="img-fluid rounded-circle d-flex justify-content-center align-items-center"
                                                        style="width: 60px; height: 60px; object-fit: cover; object-position: center  }}"
                                                        alt="">
                                                </div>
                                                <p class="card-text text-secondary text-center fw-bold mt-2">
                                                    {{ $data_siswa->nama_siswa }}</p>
                                                </p>

                                                <div class="qr d-flex justify-content-center align-items-center ">
                                                    <p>{!! QrCode::size(70)->generate($data_siswa->kode_siswa) !!}</p>
                                                </div>
                                                <p class=" text-secondary text-center">
                                                    <img src="{{ asset('logo.png') }}" class="img-fluid"
                                                        style="width: 40px; height: 30px" alt="">
                                                    Student Center
                                                </p>
                                                <p class="text-secondary text-center" style="font-size: 12px">Jln.
                                                    Manggasari Probolinggo Jawa Timur </p>
                                                <a href="" class="btn btn-success form-control btn-sm mt-2">
                                                    Profil Siswa
                                                </a>
                                                <a href="{{ route('halaman_cetak_kartu', $data_siswa->id) }}"
                                                    class="btn btn-primary form-control btn-sm mt-2">
                                                    Cetak Identitas
                                                </a>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 mb-4 " data-aos="fade-left" data-aos-duration="1500">

                    <div class="box-card-custom bg-light p-2" style="border-radius: 10px">

                        <div class="container">
                            <span class=" border-3 rounded-3 mb-3 border-1">
                                <div class="row">

                                    <div class="col-md-8 mb-2 mt-2">
                                        <div class=" border-1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span id="kategori_program_detail"
                                                        class="bg-white rounded p-2 text-primary category me-auto">
                                                        {{ $data_kelas->program->kategori_program }} -
                                                        {{ $data_kelas->program->jeniskelas->nama_jenis_kelas }}</span>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <span id="harga_detail" class="text-primary fw-bold">
                                                        @if ($data_kelas->program->harga == 0)
                                                            <span class="text-primary me-auto fw-bold">Gratis</span>
                                                        @else
                                                            <span class="text-primary me-auto fw-bold">Rp.
                                                                {{ number_format($data_kelas->program->harga, 0, ',', '.') }}
                                                                /
                                                                {{ $data_kelas->program->durasi }}</span>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <h4 id="namaprogram_detail"
                                                class="card-post-title text-primary text-capitalize mt-4">
                                                {{ $data_kelas->kelas->nama_kelas }} -
                                                {{ $data_kelas->program->nama_program }}
                                            </h4>
                                            <div class="text-right text-secondary " id="deskripsi_detail"
                                                style=" text-align: justify; max-height: 150px; overflow: hidden; text-overflow: ellipsis;">
                                                {!! $data_kelas->program->deskripsi !!}
                                            </div>
                                            <div class="profile-pengajar mt-3">
                                                <div class="row">

                                                    <div class="col-md-8 d-flex align-items-center">
                                                        <img src="{{ asset('storage/images/' . $data_kelas->kelas->pengajar->foto) }}"
                                                            alt="" class="img-fluid rounded-circle"
                                                            style="width: 70px; height: 70px;">

                                                        <p class="text-primary fw-bold ms-3">
                                                            {{ $data_kelas->kelas->pengajar->nama }}

                                                            <br>
                                                            <span class="text-secondary" style="font-size: 11px">
                                                                Pengajar
                                                            </span>


                                                        </p>
                                                        <br>
                                                    </div>




                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{ asset('storage/images/' . $data_kelas->program->gambar) }}"
                                            id="gambar_detail" alt="" class="img-fluid"
                                            style=" width: 100%; max-height: 500px;">

                                        @foreach ($data_jadwal as $jadwal)
                                            <div class="jadwal mt-4 bg-light p-2">
                                                <p class=" text-primary">
                                                    <i class="fa fa-calendar text-primary"></i>
                                                    {{ $jadwal->hari }}
                                                </p>
                                                <span class=" text-primary">
                                                    <i class="fa fa-clock text-primary"></i>
                                                    {{ $jadwal->jam_mulai }} -
                                                    {{ $jadwal->jam_selesai }}
                                                </span>
                                            </div>
                                            <hr>
                                        @endforeach

                                    </div>
                                </div>
                            </span>



                            {{-- daftar program --}}

                        </div>
                    </div>

                </div>
            </div>








            <div class="row mb-2">
                <div class="container">
                    <div class="col-md-8 " data-aos="fade-right" data-aos-duration="1000">
                        <h5 class="fw-bold">Laporan Absensi</h5>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12" data-aos="fade-up" data-aos-duration="1500">
                    <div class="box-content bg-white p-4">
                        <div class="table-responsive">
                            <table class="table table-hover mb-4 mt-2" id="example">
                                <thead>
                                    <tr style="bg-color: black" class="mt-2">
                                        <th class="text-xs ">Kelas</th>
                                        <th class="text-xs ">Jadwal</th>
                                        <th class="text-xs ">Hari</th>
                                        <th class="text-xs ">Nama Siswa</th>
                                        <th class="text-xs ">Kode Siswa</th>
                                        <th class="text-xs ">Tgl. Absen</th>
                                        <th class="text-xs ">Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absensi as $item)
                                        <tr>
                                            <td class="">
                                                <div class="user-info fw-bold">
                                                    <p>{{ $item->absensi->kelas->nama_kelas }}
                                                        -{{ $item->absensi->kelas->program->nama_program }} </p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="user-info fw-bold">
                                                    <p>{{ $item->absensi->tgl_absen }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="user-info fw-bold">
                                                    <p>{{ $item->absensi->jadwal->hari }}
                                                    </p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class="user-name">{{ $item->siswa->nama_siswa }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class=" ">
                                                <div class="user-info">
                                                    <p>{{ $item->siswa->kode_siswa }}</p>

                                                </div>
                                            </td>
                                            <td class="text-xs  ">

                                                {{ $item->tgl_absen }}
                                            </td>
                                            @if ($item->kehadiran == 'Hadir')
                                                <td class="text-xs text-success opacity-7  fw-bold">
                                                    Hadir
                                                </td>
                                            @elseif ($item->kehadiran == 'Ijin')
                                                <td class="text-xs   fw-bold">
                                                    Ijin
                                                </td>
                                            @elseif ($item->kehadiran == 'Sakit')
                                                <td class="text-xs text-warning opacity-7  fw-bold">
                                                    Sakit
                                                </td>
                                            @else
                                                <td class="text-xs text-danger opacity-7  fw-bold">
                                                    Alpa
                                                </td>
                                            @endif


                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

</script>

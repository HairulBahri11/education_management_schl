@extends('dashboard-orangtua/index')
{{-- @section('active_pendaftaran', 'active') --}}
{{-- @section('show_manajemensiswa', 'show') --}}
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
            <div class="row mb-2">
                <div class="container">
                    <div class="col-md-8 ">
                        <h4 class="fw-bold">Detail Pendaftaran</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- buat tingginya sesuai ukuran data --}}
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
                                                <a href="" class="btn btn-success form-control btn-sm mt-2">
                                                    Profil Siswa
                                                </a>
                                                <a href="{{ route('halaman_cetak_kartu', $data->id) }}"
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

                <div class="col-md-8 mb-4">
                    <div class="row">

                        <div class="col-md-12 text-end mb-4">
                            <span data-bs-toggle="modal" data-bs-target="#myModal-all-program"
                                class="btn btn-primary hover-btn btn-sm mt-2 " style="width: 100px">Daftar
                                Baru</span>
                        </div>
                    </div>

                    <div class="box-card-custom bg-white p-2" style="border-radius: 10px">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-4 mt-2" id="table-program">
                                        <thead>
                                            <tr>
                                                <th scope="col">Kode Pendaftaran</th>
                                                <th scope="col">Nama Program</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Tanggal Pendaftaran</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_program as $item)
                                                <tr>

                                                    <td class="align-middle">{{ $item->kode_pendaftaran }}</td>
                                                    <td class="align-middle">{{ $item->program->nama_program }}</td>
                                                    <td class="align-middle">{{ $item->program->kategori_program }} -
                                                        {{ $item->program->jeniskelas->nama_jenis_kelas }}</td>
                                                    <td class="align-middle">{{ $item->tgl_daftar }}</td>
                                                    <td class="align-middle">{{ $item->status }}</td>
                                                    <td
                                                        class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                        <ul class="navbar-nav gap-3">
                                                            <li class="nav-item dropdown">
                                                                <a class="nav-link dropdown-toggle" href="#"
                                                                    id="userDropdown" role="button"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <i class="fa-solid fa-ellipsis"></i>
                                                                    <!-- Ikon yang lebih jelas, seperti ikon roda gigi -->
                                                                </a>
                                                                <div class="dropdown-menu" aria-labelledby="userDropdown">
                                                                    @if ($item->program->kategori_program == 'Premium')
                                                                        <small class="dropdown-item"
                                                                            onclick="lihat({{ $item->id }} , '{{ $item->program->nama_program }}' , '{{ $item->program->jeniskelas->nama_jenis_kelas }}' , '{{ $item->bukti_pembayaran }}' , '{{ $item->status_pembayaran }}' , '{{ $item->program->harga }}')";
                                                                            style="color: black;" title="View"><i
                                                                                class="fa-solid fa-dollar-sign text-dark"></i>
                                                                            Bukti Pembayaran</small>
                                                                    @endif

                                                                    <small class="dropdown-item"
                                                                        onclick="detail(
                                                                            {{ $item->program->id }},
                                                                        '{{ $item->program->nama_program }}',
                                                                        '{{ $item->program->deskripsi }}',
                                                                        '{{ $item->program->gambar }}',
                                                                        '{{ $item->program->harga }}',
                                                                        '{{ $item->program->durasi }}',
                                                                        '{{ $item->program->kategori_program }}',
                                                                        '{{ $item->program->jeniskelas->nama_jenis_kelas }}')"
                                                                        style="color: black;" title="Detail">
                                                                        <i class="fa-solid fa-eye text-dark"></i>
                                                                        Detail Program
                                                                        <!-- Ubah teks "Delete" menjadi "Detail" di sini -->
                                                                    </small>


                                                                    {{-- <form action="{{ route('pendaftaran.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i class="fa-solid fa-trash"></i> Hapus
                                                                    </button>
                                                                </form> --}}
                                                                </div>
                                                            </li>

                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row mb-4">
                        <div class="container mt-4">
                            <div class="box-card-custom flex-fill  bg-white ">
                                <div class="col-md-12">
                                    <div class="card-body  align-items-center justify-content-center">
                                        <span> </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>



            </div>
            <div class="row mb-2">
                <div class="container">
                    <div class="col-md-8 ">
                        <h5 class="fw-bold">Program Jadwal</h5>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="box-content bg-white p-4">
                        <div class="table-responsive">
                            <table class="table table-hover mb-4 mt-2" id="example">
                                <thead>
                                    <tr style="bg-color: black" class="mt-2">
                                        <th class="text-xs ">Kelas</th>
                                        <th class="text-xs ">Jadwal</th>
                                        <th class="text-xs ">Nama Siswa</th>
                                        <th class="text-xs ">Kode Siswa</th>
                                        <th class="text-xs ">Tgl. Absen</th>
                                        <th class="text-xs ">Kehadiran</th>
                                        {{-- <th class="text-xs ">Action</th> --}}
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

        <!-- Modal Bukti Pembayaran -->
        <div class="modal fade" id="myModal-show">
            <div class="modal-dialog modal-lg" id="myModal-show">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <a href="" data-lightbox="gambar">
                                            <img src="" id="gambarLihat" data-lightbox="gambar"
                                                class="card-img-top" alt="gambar" width="20%" height="auto">
                                        </a>
                                    </div>
                                </div>
                                {{-- card footer --}}
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>


                                    <form action="" method="POST" id="konfirmasi_form">
                                        @csrf
                                        <button type="submit" id="btnKonfirmasi"
                                            class="btn btn-primary">Konfirmasi</button>
                                    </form>


                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>

        {{-- modal detail program --}}
        {{-- detailprogram --}}
        <section>
            <div class="modal fade" id="myModal-detail">
                <div class="modal-dialog modal-xl" id="myModal-detail">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Program</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                id="close"></button>
                        </div>
                        <div class="modal-body mt-3">
                            <div class="container">


                                <span class="card card-post border-3 rounded-3 mb-3 border-1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="" id="gambar_detail" alt="" class="img-fluid"
                                                style=" width: 100%; max-height: 500px;">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-body border-1">
                                                <div class="row">
                                                    <div class="col">
                                                        <span id="kategori_program_detail"
                                                            class="bg-light rounded p-2 text-primary category me-auto"></span>
                                                    </div>
                                                    <div class="col text-end">
                                                        <span id="harga_detail" class="text-primary fw-bold"></span>
                                                    </div>
                                                </div>
                                                <h2 id="namaprogram_detail"
                                                    class="card-post-title text-primary text-capitalize mt-3">

                                                </h2>
                                                <div class="text-right text-secondary" id="deskripsi_detail"
                                                    style=" text-align: justify">
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </span>



                                {{-- daftar program --}}

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

        {{-- modal daftar baru pendaftaran --}}
        <section>
            <div class="modal fade" id="myModal-all-program">
                <div class="modal-dialog modal-xl" id="myModal-all-program">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Semua Program</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                id="close-all-program"></button>
                        </div>
                        <div class="modal-body mt-3">
                            <div class="container">

                                <div class="row ">
                                    @foreach ($data_all_program as $ap)
                                        <div class="col-md-4">
                                            <a href="#" class="card card-post border-0 rounded-3 mb-3"
                                                style="text-decoration: none">
                                                <img src="{{ asset('storage/images/' . $ap->gambar) }}" alt=""
                                                    class="card-img-top" width="100%" height="250">
                                                <div class="card-body">
                                                    <span class="bg-light rounded p-2 text-primary category me-auto ">
                                                        {{ $ap->kategori_program }} |
                                                        {{ $ap->jeniskelas->nama_jenis_kelas }}</span>

                                                    <h2 class="card-post-title text-primary text-capitalize mt-3">
                                                        {{ $ap->nama_program }}
                                                    </h2>
                                                    <div class="text-right text-secondary"
                                                        style="max-height: 50px; overflow: hidden; text-overflow: ellipsis; text-align: justify">
                                                        {!! $ap->deskripsi !!}
                                                    </div>
                                                    <div class="price mt-1">
                                                        @if ($ap->harga == 0)
                                                            <span class="text-primary me-auto fw-bold">Gratis</span>
                                                        @else
                                                            <span class="text-primary me-auto fw-bold">Rp.
                                                                {{ number_format($ap->harga, 0, ',', '.') }} /
                                                                {{ $ap->durasi }}</span>
                                                        @endif

                                                    </div>

                                                    <div class="btn btn-primary form-control mt-2"
                                                        onclick="detailprogram({{ $ap->id }},
                                           '{{ $ap->nama_program }}',
                                           '{{ $ap->deskripsi }}',
                                           '{{ $ap->gambar }}',
                                           '{{ $ap->harga }}',
                                           '{{ $ap->durasi }}',
                                           '{{ $ap->kategori_program }}',
                                           '{{ $ap->jeniskelas->nama_jenis_kelas }}')";
                                                        title="View"> Detail Program</div>

                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        {{-- modal detail --}}
        <section>
            <div class="modal fade" id="myModal-detail-program">
                <div class="modal-dialog modal-xl" id="myModal-detail-program">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Program</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                id="close"></button>
                        </div>
                        <div class="modal-body mt-3">
                            <div class="container">
                                <span class="card card-post border-0 rounded-3 mb-3" style="text-decoration: none">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="" id="gambar_detail_program" alt=""
                                                class="img-fluid" style=" width: 100%; max-height: 500px;">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <span id="kategori_program_detail_program"
                                                            class="bg-light rounded p-2 text-primary category me-auto"></span>
                                                    </div>
                                                    <div class="col text-end">
                                                        <span id="harga_detail_program"
                                                            class="text-primary fw-bold"></span>
                                                    </div>
                                                </div>
                                                <h2 id="namaprogram_detail_program"
                                                    class="card-post-title text-primary text-capitalize mt-3">

                                                </h2>
                                                <div class="text-right text-secondary" id="deskripsi_detail_program"
                                                    style=" text-align: justify">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>



                                {{-- daftar program --}}
                                <section>
                                    <div class="row mb-3" id="daftar_program_program" style="display: none">

                                        <div class="box-content">
                                            <div class="col bg-white">
                                                <div class="p-5">
                                                    <form action="{{ route('pendaftaran.siswa-daftar-program-baru') }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="div-left">
                                                                        <h2
                                                                            class="card-post-title text-primary text-capitalize mt-3 fw-bold">
                                                                            Form Pendaftaran
                                                                        </h2>
                                                                        <p>Periksa dan isilah data dengan benar

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col text-end">
                                                                    <div class="div-right">
                                                                        <h2
                                                                            class="card-post-title text-primary text-capitalize mt-3 fw-bold">
                                                                            Informasi Pembayaran
                                                                        </h2>
                                                                        <p>Pilih salah satu jenis pembayaran</p>
                                                                    </div>

                                                                </div>
                                                            </div>



                                                            <div class="col-md-6">
                                                                @if (Auth::check())
                                                                    <input type="text" value="{{ Auth::user()->id }}"
                                                                        name="id_orangtua" hidden>
                                                                @endif
                                                                <input type="text" name="id_program"
                                                                    id="id_programnya_daftar" hidden>
                                                                <div class="mb-3">
                                                                    <label for="exampleFormControlTextarea1"
                                                                        class="form-label">Nama Anak</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nama_anak" id="harga"
                                                                        placeholder="joko"
                                                                        value="{{ $data->nama_siswa }}" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleFormControlTextarea1"
                                                                        class="form-label">Asal Sekolah</label>
                                                                    <input type="text" class="form-control"
                                                                        name="asal_sekolah" id="harga"
                                                                        placeholder="Smpn 1 kertosono"
                                                                        value="{{ $data->pendaftaran->asal_sekolah }}"
                                                                        readonly>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="exampleFormControlTextarea1"
                                                                        id="label_bp_premium_program"
                                                                        class="form-label">Bukti
                                                                        Pembayaran</label>
                                                                    <input type="file" name="bukti_pembayaran"
                                                                        class="form-control"
                                                                        id="bukti_pembayaran_premium_program">
                                                                </div>



                                                                <button type="submit" class="btn btn-primary mt-3"
                                                                    id="btn_daftar"> Daftar
                                                                    Sekarang</button>

                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="mb-3 d-none">
                                                                    <label for="exampleFormControlInput1"
                                                                        id="label_sp_premium" class="form-label">Status
                                                                        Pembayaran</label>
                                                                    <select name="status_pembayaran" class="form-control"
                                                                        id="status_pembayaran_program">
                                                                        <option value="Menunggu-Konfirmasi"
                                                                            class="form-control">Menunggu Konfirmasi
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                                {{-- Informasi Pembayaran --}}
                                                                <div class="row">
                                                                    <div class="card border-0">
                                                                        <div class="card-body border-0">
                                                                            <div
                                                                                class="d-flex justify-content-center align-items-center">
                                                                                <div class="col text-end">
                                                                                    <img src="{{ asset('storage/images/bri.png') }}"
                                                                                        id="" alt=""
                                                                                        style="width: auto; height: 80px">
                                                                                </div>
                                                                                <div class="col text-center">
                                                                                    <h5
                                                                                        class="text-primary text-capitalize fw-bold">
                                                                                        No Rek. 123456789</h5>
                                                                                    <p class="text-secondary">Admin Center
                                                                                        Bejay</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card border-0">
                                                                        <div class="card-body border-0">
                                                                            <div
                                                                                class="d-flex justify-content-center align-items-center">
                                                                                <div class="col text-end">
                                                                                    <img src="{{ asset('storage/images/mandiri.png') }}"
                                                                                        id="" alt=""
                                                                                        style="width: auto; height: 80px">
                                                                                </div>
                                                                                <div class="col text-center">
                                                                                    <h5
                                                                                        class="text-primary text-capitalize fw-bold">
                                                                                        No Rek. 123456789</h5>
                                                                                    <p class="text-secondary">Admin Center
                                                                                        Bejay</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card border-0">
                                                                        <div class="card-body border-0">
                                                                            <div
                                                                                class="d-flex justify-content-center align-items-center">
                                                                                <div class="col text-end">
                                                                                    <img src="{{ asset('storage/images/bca.png') }}"
                                                                                        id="" alt=""
                                                                                        style="width: auto; height: 80px">
                                                                                </div>
                                                                                <div class="col text-center">
                                                                                    <h5
                                                                                        class="text-primary text-capitalize fw-bold">
                                                                                        No Rek. 123456789</h5>
                                                                                    <p class="text-secondary">Admin Center
                                                                                        Bejay</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                            </div>
                                                        </div>
                                                    </form>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </section>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection

<script>
    function lihat(id, nama_program, jenis_kelas, bukti_pembayaran, status_pembayaran, harga) {
        // buka modal
        $('#myModal-show').modal('show');
        // image url
        let imageUrl = "{{ asset('storage/images') }}" + "/" + bukti_pembayaran;
        $('#gambarLihat').attr('src', imageUrl);
        // nama program
        $('#ProgramLihat').text(nama_program);
        // kategori kelas
        $('#kategoriKelas').text(jenis_kelas);
        // deskripsi
        $('#deskripsiLihat').text(status_pembayaran);
        // harga with number_format

        let hargaFormat = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(harga);
        $('#hargaLihat').text(hargaFormat);
        // $('#hargaLihat').text(harga);

        if (status_pembayaran == "Sudah-Bayar") {
            $('#btnKonfirmasi').css('display', 'none');
        } else {
            $('#btnKonfirmasi').css('display', 'block');

            // konfirmasi form kirim attribute src
            let konfirmasiUrl = "{{ route('pendaftaran.konfirmasi', ['id' => ':id']) }}";
            konfirmasiUrl = konfirmasiUrl.replace(':id', id);
            $('#konfirmasi_form').attr('action', konfirmasiUrl);

        }

    }

    function detail(id, namaprogram, deskripsi, gambar, harga, durasi, kategori_program, jeniskelas) {
        $('#close-all-premium').click();
        $('#close-all-trial').click();

        $('#myModal-detail').modal('show');
        $('#namaprogram_detail').text(namaprogram);
        // Assuming deskripsi contains HTML content
        let deskripsiText = deskripsi.replace(/^(<p>)+|(<p>)+$/g, '');
        deskripsiText = deskripsiText.replace(/(?:\r\n|\r|\n)/g, '<br>');

        $('#deskripsi_detail').html(deskripsiText);
        // $('#id_programnya').text(id);
        let id_program = id;
        $('#id_programnya').val(id_program);


        // $('#deskripsi_detail').text(deskripsiText);
        let src = "{{ asset('storage/images') }}" + "/" + gambar;
        $('#gambar_detail').attr('src', src);
        let hargaFormat = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(harga);
        $('#harga_detail').text(hargaFormat);

        $('#durasi_detail').text(durasi);
        $('#kategori_program_detail').text(kategori_program + "|" + jeniskelas);

        // if (kategori_program == "Trial") {

        //     $('#status_pembayaran_program').css('display', 'none');
        //     $('#bukti_pembayaran_premium').css('display', 'none');
        //     $('#label_bp_premium').css('display', 'none');
        //     $('#label_sp_premium').css('display', 'none');
        // } else {
        //     $('#status_pembayaran_program').css('display', 'block');
        //     $('#bukti_pembayaran_premium').css('display', 'block');
        //     $('#label_bp_premium').css('display', 'block');
        //     $('#label_sp_premium').css('display', 'block');
        // }
    }

    function detailprogram(id, namaprogram, deskripsi, gambar, harga, durasi, kategori_program, jeniskelas) {
        $('#close-all-program').click();
        $('#myModal-detail-program').modal('show');
        $('#namaprogram_detail_program').text(namaprogram);
        // Assuming deskripsi contains HTML content
        let deskripsiText = deskripsi.replace(/^(<p>)+|(<p>)+$/g, '');
        deskripsiText = deskripsiText.replace(/(?:\r\n|\r|\n)/g, '<br>');

        $('#deskripsi_detail_program').html(deskripsiText);
        // $('#id_programnya').text(id);
        let id_program = id;
        $('#id_programnya_daftar').val(id_program);


        // $('#deskripsi_detail_program').text(deskripsiText);
        let src = "{{ asset('storage/images') }}" + "/" + gambar;
        $('#gambar_detail_program').attr('src', src);
        let hargaFormat = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(harga);
        $('#harga_detail_program').text(hargaFormat);

        $('#durasi_detail_program').text(durasi);
        $('#kategori_program_detail_program').text(kategori_program + "|" + jeniskelas);
        $('#daftar_program_program').css('display', 'block');

        if (kategori_program == "Trial") {

            $('#status_pembayaran_program').css('display', 'none');
            $('#status_pembayaran_program').val('-');
            $('#bukti_pembayaran_premium_program').css('display', 'none');
            $('#label_bp_premium_program').css('display', 'none');
            $('#label_sp_premium_program').css('display', 'none');
        } else {
            $('#status_pembayaran_program').css('display', 'block');
            $('#status_pembayaran_program').val('Menunggu-Konfirmasi');
            $('#bukti_pembayaran_premium_program').css('display', 'block');
            $('#label_bp_premium_program').css('display', 'block');
            $('#label_sp_premium_program').css('display', 'block');
        }


    }

    // jika close modal diklik
    $('#close-program').click(function() {
        $('#myModal-detail-program').modal('hide');
        $('#daftar_program_program').css('display', 'none');

    });
</script>

@extends('dashboard/index')
@section('active_pendaftaran', 'active')
@section('show_manajemensiswa', 'show')
@section('content')

    <style>
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
    @endif



    <div class="dashboard-content px-3 pt-5">
        <div class="container">
            <div class="row mb-3">
                <div class="container">
                    <div class="col-md-5" data-aos="fade-right" data-aos-duration="1000">
                        <h4 style="font-weight: bold">Pendaftaran</h4>

                    </div>
                    <div class="col-md-5 d-flex justify-content-end ms-auto" data-aos="fade-left" data-aos-duration="1000">
                        <a href="{{ route('pendaftaran.export_excel') }}"
                            class="btn btn-sm custom-btn-edit text-white hover-btn me-2" target="_blank"><i
                                class="fa-solid fa-print text-white"></i>Excel</a>
                        <div class="float-end">
                            <a href="{{ route('pendaftaran.create') }}"
                                class="btn btn-sm custom-btn-primary text-white hover-btn"><i
                                    class="fa-solid fa-circle-plus text-white"></i>Tambah</a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="container" data-aos="fade-left" data-aos-duration="1500">

                <div class="row">
                    <div class="box-content">
                        <div class="col">
                            <div class="p-3">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="example">
                                        <thead class="bg-gray-100 p-1">
                                            <tr style="bg-color: black" class="mt-2">
                                                <th class="text-xs text-secondary font-weight-bolder opacity-7">Kode</th>
                                                <th class="text-xs text-secondary font-weight-bolder opacity-7">Orangtua
                                                </th>
                                                <th class="text-xs text-secondary font-weight-bolder opacity-7">Nama
                                                    Pendaftar
                                                </th>
                                                <th class="text-xs text-secondary font-weight-bolder opacity-7">Asal Sekolah
                                                </th>
                                                <th class="text-xs text-secondary font-weight-bolder opacity-7">Program</th>
                                                <th class="text-xs text-secondary font-weight-bolder opacity-7">Tanggal
                                                    Pendaftaran</th>
                                                <th class="text-xs text-secondary font-weight-bolder opacity-7">Status</th>
                                                <th class="text-xs text-secondary font-weight-bolder opacity-7">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td
                                                        class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                        <span>
                                                            {{ $item->kode_pendaftaran }}
                                                        </span>

                                                    </td>
                                                    <td
                                                        class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                        <span>
                                                            {{ $item->orangtua->nama }}
                                                        </span>
                                                    </td>

                                                    <td
                                                        class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                        <span>
                                                            {{ $item->nama_anak }}
                                                        </span>
                                                    </td>

                                                    <td
                                                        class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                        <span>
                                                            {{ $item->asal_sekolah }}
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                        <span>
                                                            {{ $item->program->nama_program }} -
                                                            {{ $item->program->jeniskelas->nama_jenis_kelas }}
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                        <span>
                                                            {{ $item->tgl_daftar }}
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                        @php
                                                            $background = '';
                                                            if ($item->status_pembayaran == 'Menunggu-Konfirmasi') {
                                                                $background = 'bg-warning';
                                                                $status = 'Menunggu Konfirmasi';
                                                            } elseif ($item->status_pembayaran == 'Belum-Bayar') {
                                                                $background = 'bg-danger';
                                                                $status = 'Belum Bayar';
                                                            } elseif ($item->status_pembayaran == 'Sudah-Bayar') {
                                                                $background = 'bg-success';
                                                                $status = 'Sudah Bayar';
                                                            } else {
                                                                $background = 'bg-primary';
                                                                $status = 'Trial Program';
                                                            }
                                                        @endphp
                                                        <span
                                                            class="{{ $background }} text-white shadow px-2 me-2 py-1 align-middle">
                                                            {{ $status }}
                                                        </span>
                                                    </td>

                                                    <td
                                                        class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                        <ul class="navbar-nav gap-3">
                                                            <li class="nav-item dropdown">
                                                                <a class="nav-link dropdown-toggle" href="#"
                                                                    id="userDropdown" role="button"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <i class="fa-solid fa-cog"></i>
                                                                    <!-- Ikon yang lebih jelas, seperti ikon roda gigi -->
                                                                </a>
                                                                <div class="dropdown-menu" aria-labelledby="userDropdown">
                                                                    {{-- <a class="dropdown-item"
                                                                    href="{{ route('pendaftaran.hal_tambahbaru', $item->id) }}">
                                                                    <i class="fa-solid fa-plus"></i> Daftar Program Lain
                                                                </a> --}}
                                                                    {{-- <a class="dropdown-item" href="{{ route('pendaftaran.show', $item->id) }}">
                                                                    <i class="fa-solid fa-eye"></i> Bukti Pembayaran
                                                                </a> --}}
                                                                    <small class="dropdown-item"
                                                                        onclick="lihat({{ $item->id }} , '{{ $item->program->nama_program }}' , '{{ $item->program->jeniskelas->nama_jenis_kelas }}' , '{{ $item->bukti_pembayaran }}' , '{{ $item->status_pembayaran }}' , '{{ $item->program->harga }}')";
                                                                        style="color: black;" title="View"><i
                                                                            class="fa-solid fa-eye text-dark"></i>
                                                                        Konfirmasi
                                                                        Pembayaran</small>

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




                                <!-- Modal -->
                                <div class="modal fade" id="myModal-show">
                                    <div class="modal-dialog modal-lg" id="myModal-show">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail pendaftaran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">


                                                <div class="row">
                                                    {{-- <div class="col-md-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><span id="ProgramLihat"
                                                                        style="font-weight: bold; text-align: center"></span>
                                                                </h5>
                                                                <p class="card-text">
                                                                    <strong>Harga Program:</strong>
                                                                    <span id="hargaLihat" class="text-secondary"></span>
                                                                </p>
                                                                <p class="card-text">
                                                                    <strong>Kategori:</strong>
                                                                    <span id="kategoriKelas" class="text-secondary"></span>
                                                                </p>
                                                                <p class="card-text">
                                                                    <strong>Status Pembayaran:</strong>
                                                                    <span id="deskripsiLihat" class="text-secondary"></span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <a href="" data-lightbox="gambar">
                                                                <img src="" id="gambarLihat" data-lightbox="gambar"
                                                                    class="card-img-top" alt="gambar"
                                                                    style="max-height: 500px">
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
                        </div>
                    </div>
                </div>

                </dir>
            </div>


        @endsection
    </div>
</div>
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
</script>

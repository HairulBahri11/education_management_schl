@extends('dashboard/index')
@section('active_orangtua', 'active')
@section('show_manajemensiswa', 'show')
@section('content')

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
                    <div class="col-md-5">
                        <h2 class="ms-4" style="font-weight: bold">Orang Tua</h2>

                    </div>
                    <div class="col-md-5 float-end">
                        <div class="float-end">
                            <a href="{{ route('orangtua.create') }}"
                                class="btn btn-sm custom-btn-primary text-white hover-btn"><i
                                    class="fa-solid fa-circle-plus text-white"></i>Tambah</a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="box-content">
                    <div class="col">
                        <div class="p-3">
                            <div class="table-responsive">
                                <h5>Daftar Orang Tua</h5>
                                <table class="table table-hover" id="example">
                                    <thead class="bg-gray-100 p-1">
                                        <tr style="bg-color: black" class="mt-2">
                                            <th class="text-xs text-secondary font-weight-bolder opacity-7">Foto</th>
                                            <th class="text-xs text-secondary font-weight-bolder opacity-7">Nama orangtua
                                            </th>
                                            <th class="text-xs text-secondary font-weight-bolder opacity-7">Whatsapp</th>
                                            <th class="text-xs text-secondary font-weight-bolder opacity-7">alamat</th>


                                            <th class="text-xs text-secondary font-weight-bolder opacity-7">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td align-middle>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <img src="{{ asset('storage/images/' . $item->foto) }}"
                                                                width="100" height="100" alt="gambar">
                                                        </div>

                                                    </div>
                                                </td>
                                                <td class="text-secondary opacity-7 align-middle">
                                                    <div class="user-info">
                                                        <p class="user-name">{{ $item->nama }}</p>
                                                        <p class="user-email">{{ $item->email }}</p>
                                                        @if ($item->active == 1)
                                                            <i class="fas fa-check text-success"></i>Aktif
                                                        @else
                                                            <i class="fas fa-times text-danger"></i> Nonaktif
                                                        @endif
                                                    </div>
                                                </td>

                                                <td class="text-xs text-secondary opacity-7 align-middle">
                                                    {{ $item->no_hp }}
                                                </td>

                                                <td class="text-xs text-secondary opacity-7 align-middle">
                                                    <span>
                                                        <i class="fa-solid fa-location-dot"> </i>
                                                        {{ $item->alamat }}
                                                    </span>

                                                </td>



                                                <td class="text-xs text-secondary opacity-7 align-middle">

                                                    <a href="{{ route('orangtua.wa', $item->no_hp) }}"
                                                        class="btn btn-sm custom-btn-green hover-btn" title="Chat Whatsapp">
                                                        <i class="fa-brands fa-whatsapp text-white fs-10"> </i></a>

                                                    <a href="{{ route('orangtua.edit', $item->id) }}"
                                                        class="btn btn-sm custom-btn-edit hover-btn" title="Edit"><i
                                                            class="fa-solid fa-pen-to-square text-white"></i></a>
                                                    <form action="{{ route('orangtua.setnonactive', $item->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @method('POST')
                                                        @csrf

                                                        <button type="submit" class="btn btn-sm custom-btn-hapus hover-btn"
                                                            title="Ubah Status" data-id="{{ $item->id }}"><i
                                                                class="fa-solid fa-trash text-white fs-10"
                                                                onclick="return confirm('apakah kamu yakin ingin mengubah status orangtua?')"></i></button>
                                                    </form>



                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>



                            <!-- Modal -->
                            {{-- <div class="modal fade" id="myModal-show">
                                <div class="modal-dialog" id="myModal-show">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Program</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span style="font-weight: bold" id="nama_programLihat"></span> <br>
                                                    <label for="" class="form-label">Kategori:</label>
                                                    <span id="kategori_programLihat" class="text-secondary"></span><br>
                                                    <label for="" class="form-label">Deskripsi:</label>
                                                    <p id="deskripsiLihat" class="text-secondary"></p>
                                                </div>
                                                <div class="col-md-5">
                                                    <img src="{{ asset('storage/images/') }}" id="gambarLihat" width="250" height="250" alt="gambar">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> --}}


                        </div>
                    </div>
                </div>
            </div>


        </div>



        <script>
            function lihat(id, nama_program, kategori_program, jeniskelas, harga, gambar, deskripsi) {

                $('#nama_programLihat').text(nama_program);
                // image url
                let imageUrl = "{{ asset('storage/images') }}" + "/" + gambar;
                $('#gambarLihat').attr('src', imageUrl);
                $('#kategori_programLihat').text(kategori_program);
                $('#jeniskelasLihat').text(jeniskelas);
                $('#hargaLihat').text(harga);
                $('#deskripsiLihat').text(deskripsi);
                $('#myModal-show').modal('show');

            }
        </script>

    @endsection

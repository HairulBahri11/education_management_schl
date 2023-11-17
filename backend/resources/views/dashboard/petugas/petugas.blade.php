@extends('dashboard/index')
@section('active_petugas', 'active')
@section('show_manajemenprogram', 'show')
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
                        <h4 style="font-weight: bold">Petugas</h4>

                    </div>
                    <div class="col-md-5 float-end">
                        <div class="float-end">
                            <a href="{{ route('petugas.create') }}"
                                class="btn btn-sm custom-btn-primary text-white hover-btn"><i
                                    class="fa-solid fa-circle-plus text-white"></i>Tambah</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="box-content">
                        <div class="col">
                            <div class="p-3">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="example">
                                        <thead class="bg-gray-100 p-1">
                                            <tr style="bg-color: black" class="mt-2">
                                                <th class="text-xs text-secondary font-weight-bolder opacity-7">Foto</th>
                                                <th class="text-xs text-secondary font-weight-bolder opacity-7">Nama petugas
                                                </th>
                                                <th class="text-xs text-secondary font-weight-bolder opacity-7">Whatsapp
                                                </th>
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
                                                                <img src="{{ asset('storage/images/' . $item->photo) }}"
                                                                    width="100" height="100" alt="gambar">
                                                            </div>

                                                        </div>
                                                    </td>

                                                    <td
                                                        class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                        {{ $item->nama_petugas }}
                                                    </td>
                                                    <td
                                                        class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                        {{ $item->no_hp }}
                                                    </td>

                                                    <td
                                                        class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                        <span>
                                                            <i class="fa-solid fa-location-dot"> </i>
                                                            {{ $item->alamat }}
                                                        </span>

                                                    </td>
                                                    <td
                                                        class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                        <a href="{{ route('petugas.wa', $item->no_hp) }}"
                                                            class="btn btn-sm custom-btn-green hover-btn"
                                                            title="Chat Whatsapp">
                                                            <i class="fa-brands fa-whatsapp text-white fs-10"> </i></a>
                                                        <a href="{{ route('petugas.edit', $item->id) }}"
                                                            class="btn btn-sm custom-btn-edit hover-btn" title="Edit"><i
                                                                class="fa-solid fa-pen-to-square text-white"></i></a>
                                                        <form action="{{ route('petugas.destroy', $item->id) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm custom-btn-hapus hover-btn"
                                                                title="Hapus"><i
                                                                    class="fa-solid fa-trash text-white fs-10"></i></button>
                                                        </form>
                                                    </td>
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

@extends('dashboard/index')
@section('active_program', 'active')
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
                        <h4 style="font-weight: bold">Program</h4>

                    </div>
                    <div class="col-md-5 float-end">
                        <div class="float-end">
                            <a href="{{ route('program.create') }}"
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
                                                <th class="text-xs text-secondary font-weight-bolder opacity-7">Program</th>
                                                <th class="text-xs text-secondary font-weight-bolder opacity-7">Kategori
                                                    Kelas
                                                </th>
                                                <th class="text-xs text-secondary font-weight-bolder opacity-7">Harga Paket
                                                </th>
                                                <th class="text-xs text-secondary font-weight-bolder opacity-7">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <img src="{{ asset('storage/images/' . $item->gambar) }}"
                                                                    width="100" height="100" alt="gambar">
                                                            </div>
                                                            <div class="col-md-5 ">
                                                                <span style="font-weight: bold" class="align-middle">
                                                                    {{ $item->nama_program }}</span> <br>
                                                                <span class="align-middle">Kategori:
                                                                    {{ $item->kategori_program }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                        @php
                                                            $background = '';
                                                            if ($item->jeniskelas->nama_jenis_kelas == 'Bersama') {
                                                                $background = 'bg-success';
                                                            } elseif ($item->jeniskelas->nama_jenis_kelas == 'Semi Private') {
                                                                $background = 'bg-warning';
                                                            } elseif ($item->jeniskelas->nama_jenis_kelas == 'Private') {
                                                                $background = 'bg-danger';
                                                            } else {
                                                                $background = 'bg-primary';
                                                            }
                                                        @endphp
                                                        <span
                                                            class="{{ $background }} text-white rounded shadow px-2 me-2 py-1 align-middle"
                                                            style="font-size: 11px">{{ $item->jeniskelas->nama_jenis_kelas }}</span>
                                                    </td>
                                                    <td
                                                        class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                        Rp.
                                                        {{ number_format($item->harga, 0, ',', '.') }}</td>



                                                    <td
                                                        class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                        <small class="btn btn-sm btn-info hover-btn"
                                                            onclick="lihat({{ $item->id }} , '{{ $item->nama_program }}' , '{{ $item->kategori_program }}', '{{ $item->jeniskelas->nama_jenis_kelas }}', '{{ $item->harga }}', '{{ $item->gambar }}', '{{ $item->deskripsi }}')";
                                                            style="border-radius: 8px; border: none" title="View"><i
                                                                class="fa-solid fa-eye text-white"></i></small>

                                                        <a href="{{ route('program.edit', $item->id) }}"
                                                            class="btn btn-sm custom-btn-edit hover-btn" title="Edit"><i
                                                                class="fa-solid fa-pen-to-square text-white"></i></a>
                                                        <form action="{{ route('program.destroy', $item->id) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm custom-btn-hapus hover-btn" title="Hapus"
                                                                onclick="return confirm('apakah kamu yakin ingin menghapus program?')"><i
                                                                    class="fa-solid fa-trash text-white fs-10"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>



                                <!-- Modal -->
                                <div class="modal fade" id="myModal-show">
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
                                                        <img src="{{ asset('storage/images/') }}" id="gambarLihat"
                                                            width="250" height="250" alt="gambar">
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
            </div>
        </div>


    </div>


@endsection
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

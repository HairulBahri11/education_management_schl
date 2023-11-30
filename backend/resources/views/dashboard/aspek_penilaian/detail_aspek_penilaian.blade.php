@extends('dashboard/index')
@section('active_aspekpenilaian', 'active')
@section('show_manajemennilai', 'show')
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
                    <div class="col-md-5" data-aos="fade-right" data-aos-duration="1000">
                        <h4 style="font-weight: bold">Detail Aspek Penilaian</h4>
                    </div>
                    <div class="col-md-5 ms-auto" data-aos="fade-left" data-aos-duration="1000">
                        <div class="float-end">
                            <small data-bs-toggle="modal" data-bs-target="#exampleModal"
                                class="btn btn-sm custom-btn-primary text-white hover-btn"><i
                                    class="fa-solid fa-circle-plus text-white"></i>Tambah Aspek</small>
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
                                                <th class="text-xs text-secondary opacity-7">Bidang Program</th>
                                                <th class="text-xs text-secondary opacity-7 align-middle">Aspek Penilaian
                                                </th>
                                                <th class="text-xs text-secondary opacity-7 align-middle">
                                                    Detail Aspek Penilaian
                                                </th>
                                                <th class="text-xs text-secondary opacity-7 align-middle">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        {{ $item->aspek_penilaian->bidang }}
                                                    </td>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        {{ $item->aspek_penilaian->aspek_penilaian }}</td>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        {{ $item->nama_detail_aspek_penilaian }}</td>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">

                                                        <form
                                                            action="{{ route('aspekpenilaian_detail.destroy', $item->id) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm custom-btn-hapus hover-btn" title="Hapus"
                                                                data-id="{{ $item->id }}"
                                                                onclick="return confirm('apakah kamu yakin ingin menghapus data?')"><i
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

    {{-- modal --}}
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
        data-bs-whatever="@mdo">Open modal for @mdo</button> --}}


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Detail Aspek Penilaian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('aspekpenilaian_detail.store', $aspek_penilaian_id) }}" method="POST">
                        @csrf
                        <input type="text" name="aspek_penilaian_id" value="{{ $aspek_penilaian_id }}" hidden>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nama Detail Aspek Penilaian</label>
                            <input type="text" class="form-control" id="nama_detail_aspek_penilaian"
                                name="nama_detail_aspek_penilaian" required>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

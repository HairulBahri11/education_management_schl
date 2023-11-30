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
                        <h4 style="font-weight: bold">Aspek Penilaian</h4>
                    </div>
                    <div class="col-md-5 ms-auto" data-aos="fade-left" data-aos-duration="1000">
                        <div class="float-end">
                            <a href="{{ route('aspekpenilaian.create') }}"
                                class="btn btn-sm custom-btn-primary text-white hover-btn"><i
                                    class="fa-solid fa-circle-plus text-white"></i>Tambah Aspek</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container" data-aos="fade-left" data-aos-duration="1000">
                <div class="row">
                    <div class="box-content">
                        <div class="col">
                            <div class="p-3">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="example">
                                        <thead class="bg-gray-100 p-1">
                                            <tr style="bg-color: black" class="mt-2">
                                                <th class="text-xs text-secondary opacity-7 align-middle">Bidang Program
                                                <th class="text-xs text-secondary opacity-7 align-middle">Aspek Penilaian
                                                </th>
                                                <th class="text-xs text-secondary opacity-7 align-middle">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        {{ $item->bidang }}
                                                    </td>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        {{ $item->aspek_penilaian }}</td>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        <a href="{{ route('aspekpenilaian_detail.show', $item->id) }}"
                                                            class="btn btn-sm custom-btn-edit text-white hover-btn"
                                                            style="font-weight: bold" title="Detail">
                                                            <i class="fa-solid fa-eye text-white fs-10"></i>
                                                        </a>

                                                        <form action="{{ route('aspekpenilaian.destroy', $item->id) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-sm custom-btn-hapus hover-btn"
                                                                title="Hapus Aspek" data-id="{{ $item->id }}"
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
@endsection

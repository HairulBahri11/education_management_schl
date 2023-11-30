@extends('dashboard/index')
@section('active_ruangan', 'active')
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
                    <div class="col-md-5" data-aos="fade-right" data-aos-duration="1000">
                        <h2 class="ms-4" style="font-weight: bold">Ruangan</h2>

                    </div>
                    <div class="col-md-5 float-end" data-aos="fade-left" data-aos-duration="1000">
                        <div class="float-end">
                            <a href="{{ route('ruangan.create') }}"
                                class="btn btn-sm custom-btn-primary text-white hover-btn"><i
                                    class="fa-solid fa-circle-plus text-white"></i>Tambah</a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row" data-aos="fade-left" data-aos-duration="1500">
                <div class="box-content">
                    <div class="col">
                        <div class="p-3">
                            <div class="table-responsive">
                                <h5>Daftar Ruangan</h5>
                                <table class="table table-hover" id="example">
                                    <thead class="bg-gray-100 p-1">
                                        <tr style="bg-color: black" class="mt-2">
                                            <th class="text-xs text-secondary font-weight-bolder opacity-7"></th>
                                            <th class="text-xs text-secondary font-weight-bolder opacity-7">Nama ruangan
                                            </th>
                                            <th class="text-xs text-secondary font-weight-bolder opacity-7">Kapasitas</th>
                                            <th class="text-xs text-secondary font-weight-bolder opacity-7">Petugas</th>


                                            <th class="text-xs text-secondary font-weight-bolder opacity-7">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td align-middle>
                                                </td>

                                                <td
                                                    class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                    {{ $item->nama_ruangan }}
                                                </td>
                                                <td
                                                    class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                    {{ $item->kapasitas }} orang
                                                </td>

                                                <td
                                                    class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                    <span>
                                                        <i class="fa-solid fa-user"> </i>
                                                        {{ $item->petugas->nama_petugas }}
                                                    </span>
                                                </td>
                                                <td
                                                    class="text-xs text-secondary font-weight-bolder opacity-7 align-middle">
                                                    <a href="{{ route('ruangan.wa', $item->petugas->no_hp) }}"
                                                        class="btn btn-sm custom-btn-green hover-btn" title="Chat Whatsapp">
                                                        <i class="fa-brands fa-whatsapp text-white fs-10"> </i></a>
                                                    <a href="{{ route('ruangan.edit', $item->id) }}"
                                                        class="btn btn-sm custom-btn-edit hover-btn" title="Edit"><i
                                                            class="fa-solid fa-pen-to-square text-white"></i></a>
                                                    <form action="{{ route('ruangan.destroy', $item->id) }}" method="POST"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm custom-btn-hapus hover-btn"
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


    @endsection

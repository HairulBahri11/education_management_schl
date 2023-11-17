@extends('dashboard/index')
@section('active_kelas', 'active')
@section('show_manajemenkelas', 'show')
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
                    <div class="col-md-5">
                        <h4 style="font-weight: bold">Data Kelas</h4>
                    </div>
                    <div class="col-md-5 ms-auto">
                        <div class="float-end">
                            <a href="{{ route('kelas.create') }}"
                                class="btn btn-sm custom-btn-primary text-white hover-btn"><i
                                    class="fa-solid fa-circle-plus text-white"></i>Tambah Kelas</a>
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
                                                <th class="text-xs text-secondary opacity-7">Kelas</th>
                                                <th class="text-xs text-secondary opacity-7">Program
                                                </th>
                                                <th class="text-xs text-secondary opacity-7">Durasi</th>
                                                <th class="text-xs text-secondary opacity-7">Jumlah Siswa</th>
                                                <th class="text-xs text-secondary opacity-7">Status</th>
                                                <th class="text-xs text-secondary opacity-7">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_kelas as $item)
                                                <tr>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        {{ $item->nama_kelas }}
                                                    </td>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        {{ $item->program->nama_program }} -
                                                        {{ $item->program->jeniskelas->nama_jenis_kelas }}
                                                    </td>
                                                    {{-- jumlah siswa konfigurasi --}}
                                                    {{-- cek jumlah siswa berdasarkan program yang dipilih --}}
                                                    @php
                                                        $siswa = App\Models\Manajemen_Kelas::where('kelas_id', $item->id)->count();
                                                        $data_siswa = App\Models\Manajemen_Kelas::where('kelas_id', $item->id)->first();

                                                        $status = $item->status;
                                                        if ($status == 'aktif') {
                                                            $icon = 'fa fa-check-circle text-success';
                                                        } else {
                                                            $icon = 'fa fa-times-circle text-danger';
                                                        }
                                                    @endphp
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        <span>
                                                            <i class="fa-solid fa-calendar-days"> </i>
                                                            {{ $data_siswa->tgl_mulai }} | {{ $data_siswa->tgl_selesai }}
                                                        </span>
                                                    </td>


                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        <span>
                                                            <i class="fa-solid fa-users"> </i>
                                                            {{ $siswa }} Siswa
                                                        </span>
                                                    </td>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        <span>

                                                            <i class="{{ $icon }}"></i>
                                                            {{ $item->status }}
                                                        </span>
                                                    </td>


                                                    <td>
                                                        <a href="{{ route('kelas.detail', $item->id) }}"
                                                            class="btn btn-sm custom-btn-edit text-white hover-btn"><i
                                                                class="fa-solid fa-eye text-white"></i></a>

                                                        <form action="{{ route('kelas.setnonactive', $item->id) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @method('POST')
                                                            @csrf

                                                            <button type="submit"
                                                                class="btn btn-sm custom-btn-hapus hover-btn"
                                                                title="Ubah Status" data-id="{{ $item->id }}"
                                                                onclick="return confirm('apakah kamu yakin ingin mengubah status kelas?')"><i
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

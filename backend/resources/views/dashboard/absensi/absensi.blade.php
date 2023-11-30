@extends('dashboard/index')
@section('active_absensi', 'active')
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
                        <h4 style="font-weight: bold">Absensi Kelas

                        </h4>
                    </div>
                    <div class="col-md-5 ms-auto" data-aos="fade-left" data-aos-duration="1000">
                        <div class="float-end">
                            @if (Auth::user()->role == 'admin')
                                <a href="{{ route('absensi.create') }}"
                                    class="btn btn-sm custom-btn-primary text-white hover-btn"><i
                                        class="fa-solid fa-circle-plus text-white"></i>Tambah Absensi</a>
                            @else
                                <a href="{{ route('absensi.create.pengajar') }}"
                                    class="btn btn-sm custom-btn-primary text-white hover-btn"><i
                                        class="fa-solid fa-circle-plus text-white"></i>Tambah Absensi</a>
                            @endif

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
                                                <th class="text-xs text-secondary opacity-7">Tanggal</th>
                                                <th class="text-xs text-secondary opacity-7">Pengajar</th>
                                                <th class="text-xs text-secondary opacity-7">Hari</th>
                                                <th class="text-xs text-secondary opacity-7">Jam</th>
                                                <th class="text-xs text-secondary opacity-7">Kelas</th>
                                                <th class="text-xs text-secondary opacity-7">Program
                                                </th>
                                                {{-- <th class="text-xs text-secondary opacity-7">Status</th> --}}
                                                <th class="text-xs text-secondary opacity-7">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        {{ $item->tgl_absen }}
                                                    </td>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        {{ $item->pengajar->nama }}
                                                    </td>

                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        {{ $item->jadwal->hari }}</td>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        {{ \Illuminate\Support\Carbon::parse($item->jadwal->jam_mulai)->format('H:i') }}
                                                        -
                                                        {{ \Illuminate\Support\Carbon::parse($item->jadwal->jam_selesai)->format('H:i') }}
                                                    </td>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        {{ $item->kelas->nama_kelas }}
                                                    </td>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">

                                                        {{ $item->kelas->program->nama_program }} -
                                                        {{ $item->kelas->program->jeniskelas->nama_jenis_kelas }}
                                                    </td>
                                                    {{-- <td class="text-xs text-secondary opacity-7 align-middle">
                                                        <span>


                                                            {{ $item->status }}
                                                        </span>
                                                    </td> --}}


                                                    <td class="text-xs text-secondary opacity-7 align-middle">

                                                        {{-- melihat absensi_detail berdasarkan id tertentu --}}
                                                        @php
                                                            $id_absensi = $item->id;
                                                            $data_absensi_detail = \App\Models\Absensi_Detail::where('absensi_id', $id_absensi)->get();
                                                            if ($data_absensi_detail->count() > 0) {
                                                                $show_detail = 'd-blok';
                                                                $create_detail = 'd-none';
                                                            } else {
                                                                $show_detail = 'd-none';
                                                                $create_detail = 'd-blok';
                                                            }

                                                        @endphp
                                                        @if (Auth::user()->role == 'admin')
                                                            <form action="{{ route('absensi_detail.store', $item->id) }}"
                                                                method="POST" style="display: inline-block;">
                                                                @method('POST')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-sm custom-btn-green hover-btn {{ $create_detail }}"
                                                                    title="Kelola Absen" data-id="{{ $item->id }}"><i
                                                                        class="fa-solid fa-pencil text-white fs-10"></i></button>
                                                            </form>
                                                            <a href="{{ route('absensi_detail.edit', $item->id) }}"
                                                                class="btn btn-sm custom-btn-edit hover-btn {{ $show_detail }}"
                                                                title="Edit"><i
                                                                    class="fa-solid fa-pen-to-square text-white"></i></a>
                                                        @else
                                                            <form
                                                                action="{{ route('absensi_detail.store.pengajar', $item->id) }}"
                                                                method="POST" style="display: inline-block;">
                                                                @method('POST')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-sm custom-btn-green hover-btn {{ $create_detail }}"
                                                                    title="Kelola Absen" data-id="{{ $item->id }}"><i
                                                                        class="fa-solid fa-pencil text-white fs-10"></i></button>
                                                            </form>
                                                            <a href="{{ route('absensi_detail.edit.pengajar', $item->id) }}"
                                                                class="btn btn-sm custom-btn-edit hover-btn {{ $show_detail }}"
                                                                title="Edit"><i
                                                                    class="fa-solid fa-pen-to-square text-white"></i></a>.
                                                        @endif

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

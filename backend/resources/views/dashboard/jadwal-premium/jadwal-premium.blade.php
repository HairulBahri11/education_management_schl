@extends('dashboard/index')
@section('active_jadwalkelas', 'active')
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
                    <div class="col-md-5" data-aos="fade-right" data-aos-duration="1000">
                        <h4 style="font-weight: bold">Jadwal Kelas
                            @if (Auth::user()->role == 'admin')
                                <span class="text-white"
                                    style="background-color: gold; padding: 5px; border-radius:8px; margin-left: 10px;font-size: 12px">
                                    <i>Premium</i></span>
                            @endif

                        </h4>
                    </div>
                    <div class="col-md-5 ms-auto" data-aos="fade-left" data-aos-duration="1000">
                        <div class="float-end">
                            @if (Auth::user()->role == 'admin')
                                <a href="{{ route('jadwalpremium.create') }}"
                                    class="btn btn-sm custom-btn-primary text-white hover-btn"><i
                                        class="fa-solid fa-circle-plus text-white"></i>Tambah Jadwal</a>
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
                                                <th class="text-xs text-secondary opacity-7">Pengajar</th>
                                                <th class="text-xs text-secondary opacity-7">Hari</th>
                                                <th class="text-xs text-secondary opacity-7">Jam</th>
                                                <th class="text-xs text-secondary opacity-7">Kelas</th>
                                                <th class="text-xs text-secondary opacity-7">Program
                                                </th>
                                                <th class="text-xs text-secondary opacity-7">Status</th>
                                                @if (Auth::user()->role == 'admin')
                                                    <th class="text-xs text-secondary opacity-7">Action</th>
                                                @endif

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        <span>
                                                            <img src="{{ asset('storage/images/' . $item->pengajar->foto) }}"
                                                                class="img-fluid" width="100px" height="100px"
                                                                alt="foto">
                                                        </span>
                                                        {{ $item->pengajar->nama }}
                                                    </td>

                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        {{ $item->hari }}</td>

                                                    @php

                                                        $status = $item->status;
                                                        if ($status == 'Aktif') {
                                                            $icon = 'fa fa-check-circle text-success';
                                                        } else {
                                                            $icon = 'fa fa-times-circle text-danger';
                                                        }
                                                    @endphp
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        {{ \Illuminate\Support\Carbon::parse($item->jam_mulai)->format('H:i') }}
                                                        -
                                                        {{ \Illuminate\Support\Carbon::parse($item->jam_selesai)->format('H:i') }}
                                                    </td>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        {{ $item->kelas->nama_kelas }}
                                                    </td>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">

                                                        {{ $item->program->nama_program }} -
                                                        {{ $item->program->jeniskelas->nama_jenis_kelas }}
                                                    </td>
                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        <span>

                                                            <i class="{{ $icon }}"></i>
                                                            {{ $item->status }}
                                                        </span>
                                                    </td>

                                                    @if (Auth::user()->role == 'admin')
                                                        <td class="text-xs text-secondary opacity-7 align-middle">


                                                            <form
                                                                action="{{ route('jadwalpremium.setnonactive', $item->id) }}"
                                                                method="POST" style="display: inline-block;">
                                                                @method('POST')
                                                                @csrf

                                                                <button type="submit"
                                                                    class="btn btn-sm custom-btn-hapus hover-btn"
                                                                    title="Ubah Status" data-id="{{ $item->id }}"><i
                                                                        class="fa-solid fa-trash text-white fs-10"
                                                                        onclick="return confirm('apakah kamu yakin ingin mengubah status jadwalpremium?')"></i></button>
                                                            </form>


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
            </div>
        </div>
    </div>
@endsection

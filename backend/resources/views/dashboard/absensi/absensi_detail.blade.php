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
                    <div class="col-md-5">
                        <h4 style="font-weight: bold"> Detail Absensi

                        </h4>
                    </div>
                    <div class="col-md-5 ms-auto">
                        {{-- <div class="float-end">
                            <a href="{{ route('absensi.create') }}"
                                class="btn btn-sm custom-btn-primary text-white hover-btn"><i
                                    class="fa-solid fa-circle-plus text-white"></i>Tambah Absensi</a>
                        </div> --}}
                    </div>
                </div>
            </div>
            {{-- tab menu --}}

            <div class="container">
                <div class="row">
                    <div class="col-md-9 bg-white p-2">
                        <div class="p-3">
                            <div class="table-responsive">
                                <table class="table table-hover" id="example">
                                    <thead class="bg-gray-100 p-1">
                                        <tr style="bg-color: black" class="mt-2">
                                            <th class="text-xs text-secondary opacity-7">Foto</th>
                                            <th class="text-xs text-secondary opacity-7">Kode Siswa</th>
                                            <th class="text-xs text-secondary opacity-7">Tgl. Absen</th>
                                            <th class="text-xs text-secondary opacity-7">Kehadiran</th>
                                            <th class="text-xs text-secondary opacity-7">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($item as $item)
                                            <tr>
                                                <td align-middle>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <img src="{{ asset('storage/images/' . $item->siswa->foto) }}"
                                                                width="100" height="100" alt="gambar">
                                                            <br>
                                                            <p class="user-name">{{ $item->siswa->nama_siswa }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-secondary opacity-7 align-middle">
                                                    <div class="user-info">
                                                        <p>{{ $item->siswa->kode_siswa }}</p>

                                                    </div>
                                                </td>
                                                <td class="text-xs text-secondary opacity-7 align-middle">

                                                    {{ $item->tgl_absen }}
                                                </td>
                                                @if ($item->kehadiran == 'Hadir')
                                                    <td class="text-xs text-success opacity-7 align-middle fw-bold">
                                                        Hadir
                                                    </td>
                                                @elseif ($item->kehadiran == 'Izin')
                                                    <td class="text-xs text-secondary opacity-7 align-middle fw-bold">
                                                        Izin
                                                    </td>
                                                @elseif ($item->kehadiran == 'Sakit')
                                                    <td class="text-xs text-warning opacity-7 align-middle fw-bold">
                                                        Sakit
                                                    </td>
                                                @else
                                                    <td class="text-xs text-danger opacity-7 align-middle fw-bold">
                                                        Alpa
                                                    </td>
                                                @endif
                                                <td class="text-xs text-secondary opacity-7 align-middle">
                                                    <form action="{{ route('absensi_detail.setHadir', $item->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @method('POST')
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            title="Kelola Absen"
                                                            data-id="{{ $item->id }}">Hadir</button>
                                                    </form>
                                                    <form action="{{ route('absensi_detail.setIzin', $item->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @method('POST')
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-secondary"
                                                            title="Kelola Absen" data-id="{{ $item->id }}">Izin</button>
                                                    </form>
                                                    <form action="{{ route('absensi_detail.setSakit', $item->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @method('POST')
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-warning text-center"
                                                            title="Kelola Absen"
                                                            data-id="{{ $item->id }}">Sakit</button>
                                                    </form>
                                                    <form action="{{ route('absensi_detail.setAlpa', $item->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @method('POST')
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger text-center"
                                                            title="Kelola Absen"
                                                            data-id="{{ $item->id }}">Alpa</button>
                                                    </form>


                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-3 text-center ">
                        <span class="span bg-white py-2 border border-1 p-3">Scan QR Code</span>
                        <video id="video" class="mt-5" width="100%" autoplay></video>

                        <form id="form" action="{{ route('absen.siswa') }}" method="POST">
                            @csrf
                            <input type="text" name="kode_siswa" id="kode_siswa" hidden>
                            <input type="text" name="absensi_id" id="absensi_id" value="{{ $absensi_id }}" hidden>

                        </form>
                    </div>
                </div>
            </div>

            {{-- end tab menu --}}

        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script></script>
    <script type="text/javascript">
        let scanner = new Instascan.Scanner({
            video: document.getElementById('video')
        });
        scanner.addListener('scan', function(content) {
            console.log(content);
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan', function(c) {
            document.getElementById('kode_siswa').value = c;
            document.getElementById('form').submit();
        })
    </script>
@endpush

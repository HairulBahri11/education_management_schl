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
                        <h4 style="font-weight: bold">Tambah Absensi

                        </h4>
                    </div>
                    <div class="col-md-5 ms-auto" data-aos="fade-left" data-aos-duration="1000">
                        @if (Auth::user()->role == 'admin')
                            <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="float-end">
                                    <button type="submit" class="btn custom-btn-primary hover-btn text-white"> <i
                                            class="fa-solid fa-floppy-disk text-white"></i> Simpan</button>
                                </div>
                            @else
                                <form action="{{ route('absensi.store.pengajar') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="float-end">
                                        <button type="submit" class="btn custom-btn-primary hover-btn text-white"> <i
                                                class="fa-solid fa-floppy-disk text-white"></i> Simpan</button>
                                    </div>
                        @endif

                    </div>
                </div>
            </div>
            <div class="container" data-aos="fade-left" data-aos-duration="1500">

                <div class="row mb-3">
                    <div class="box-content">
                        <div class="col-md-12 p-4">
                            {{-- <div class="mb-1">
                                <div class="col text-end">
                                    <span id="btn-add" class="btn btn-info btn-sm text-white">Tambah</span>
                                    <span id="btn-remove" class="btn btn-danger btn-sm text-white d-none"
                                        onclick="removeJadwal()">Hapus</span>
                                </div>
                            </div> --}}
                            <div class="absent-data mb-3">
                                <label for="exampleInputEmail1" class="form-label">Jadwal</label>
                                <select name="jadwal_id" id="jadwal_id" class="form-control" onchange="getJadwal()">
                                    <option value=""> --Pilih Jadwal--</option>
                                    @foreach ($jadwal as $jadwal)
                                        <option class="form-control" value="{{ $jadwal->id }}">
                                            {{ $jadwal->kelas->nama_kelas }} - {{ $jadwal->pengajar->nama }} -
                                            {{ $jadwal->kelas->program->nama_program }} - {{ $jadwal->hari }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tanggal</label>
                                <input type="date" name="tgl_absen" id="date" class="form-control">

                            </div>

                            <div class="absent-baru">

                            </div>
                        </div>

                        <input type="text" name="value_all_jadwal[]" id="value_all_jadwal" hidden>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        function getJadwal() {
            var jadwal_id = $('#jadwal_id').val();
            url = "{{ route('absensi.getjadwal', ':id') }}".replace(':id', jadwal_id);
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(response) {
                    $('#value_all_jadwal').val(response.data.id);
                    console.log(response.data.id);
                }

            })
        }

        $(document).on('click', '#btn-add', function() {
            var jadwal_id = $('#value_all_jadwal').val();
            url = "{{ route('newgetdatajadwal', ':id') }}".replace(':id', jadwal_id);
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $('.absent-baru').append(response);
                    $('#btn-add').addClass('d-none');
                }
            })
        })
    </script>
@endpush

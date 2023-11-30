@extends('dashboard/index')
@section('active_jadwalkelas', 'active')
@section('show_manajemenkelas', 'show')
@section('content')
    <div class="dashboard-content px-3 pt-5">
        <div class="container">
            <div class="row mb-3">
                <div class="container">
                    <div class="col-md-5" data-aos="fade-right" data-aos-duration="1000">
                        <h4 style="font-weight: bold">Tambah Jadwal
                            <span class="text-white"
                                style="background-color: gold; padding: 5px; border-radius:8px; margin-left: 10px;font-size: 12px">
                                <i>Premium</i></span>
                        </h4>
                    </div>
                    <div class="col-md-5 float-end" data-aos="fade-left" data-aos-duration="1000">
                        <form action="{{ route('jadwalpremium.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="float-end">
                                <button type="submit" class="btn custom-btn-primary hover-btn text-white"> <i
                                        class="fa-solid fa-floppy-disk text-white"></i> Simpan</button>
                            </div>
                    </div>
                </div>
            </div>
            <div class="container" data-aos="fade-left" data-aos-duration="1500">

                <div class="row mb-3">
                    <div class="box-content">
                        <div class="col-md-12 p-4">
                            {{-- <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Pengajar</label>
                                <select name="pengajar_id" id="pengajar_id" class="form-control">
                                    <option value=""> --Pilih Pengajar--</option>
                                    @foreach ($pengajar as $pengajar)
                                        <option class="form-control" value="{{ $pengajar->id }}">
                                            {{ $pengajar->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kelas</label>
                                <select name="kelas_id" id="kelas_id" class="form-control" onchange="getKelas()">
                                    <option value=""> --Pilih Kelas--</option>
                                    @foreach ($kelas as $kelas)
                                        <option class="form-control" value="{{ $kelas->id }}">
                                            {{ $kelas->nama_kelas }} -
                                            {{ $kelas->program->nama_program }} - {{ $kelas->pengajar->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-1">
                                <div class="col text-end">
                                    <span id="btn-add" class="btn btn-info btn-sm text-white">Tambah</span>
                                    <span id="btn-remove" class="btn btn-danger btn-sm text-white d-none"
                                        onclick="removeJadwal()">Hapus</span>
                                </div>
                            </div>
                            <div class="jadwal-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                            <input type="time" name="jam_mulai[]" class="form-control"
                                                id="jam_mulai"required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                            <input type="time" name="jam_selesai[]" class="form-control"
                                                id="jam_selesai"required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="hari" class="form-label">Hari</label>
                                            <select name="hari[]" class="form-control" id="hari">
                                                <option value="">---Pilih Hari---</option>
                                                <option value="senin" class="form-control">Senin</option>
                                                <option value="selasa" class="form-control">Selasa</option>
                                                <option value="rabu" class="form-control">Rabu</option>
                                                <option value="kamis" class="form-control">Kamis</option>
                                                <option value="jumat" class="form-control">Jumat</option>
                                                <option value="sabtu" class="form-control">Sabtu</option>
                                                <option value="minggu" class="form-control">Minggu</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jadwal-baru">

                            </div>
                        </div>

                        <input type="text" name="value_all_hari[]" id="value_all_hari" hidden>
                        <input type="text" name="value_all_jam_mulai[]" id="value_all_jam_mulai" hidden>
                        <input type="text" name="value_all_jam_selesai[]" id="value_all_jam_selesai" hidden>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        var i = 0;
        $('#btn-add').click(function() {
            ++i;
            $('.jadwal-baru').append(`
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time" name="jam_mulai[]" class="form-control"
                                id="jam_mulai"required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" name="jam_selesai[]" class="form-control"
                                id="jam_selesai" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="hari" class="form-label">Hari</label>
                            <select name="hari[]" class="form-control" id="hari">
                                <option value="">---Pilih Hari---</option>
                                <option value="senin" class="
                                            form-control">Senin</option>
                                <option value="selasa" class="
                                            form-control">Selasa</option>
                                <option value="rabu" class="
                                            form-control">Rabu</option>
                                <option value="kamis" class="
                                            form-control">Kamis</option>
                                <option value="jumat" class="
                                            form-control">Jumat</option>
                                <option value="sabtu" class="
                                            form-control">Sabtu</option>
                                <option value="minggu" class="
                                            form-control">Minggu</option>
                            </select>
                        </div>
                    </div>
                </div>
                `);
            $('#btn-remove').removeClass('d-none');
            console.log(i);

        });

        let allhari = []
        let alljam_mulai = []
        let alljam_selesai = []

        $(document).on('change', 'input[name="jam_mulai[]"]', function() {
            alljam_mulai = $('input[name="jam_mulai[]"]').map(function() {
                return $(this).val();
            }).get();
            $('#value_all_jam_mulai').val(alljam_mulai);
        })
        $(document).on('change', 'input[name="jam_selesai[]"]', function() {
            alljam_selesai = $('input[name="jam_selesai[]"]').map(function() {
                return $(this).val();
            }).get();
            $('#value_all_jam_selesai').val(alljam_selesai);
        })
        $(document).on('change', 'select[name="hari[]"]', function() {
            allhari = $('select[name="hari[]"]').map(function() {
                return $(this).val();
            }).get();
            console.log(allhari);
            $('#value_all_hari').val(allhari);
        })


        function removeJadwal() {
            $('.jadwal-baru').children().last().remove();
        }
    </script>
@endpush

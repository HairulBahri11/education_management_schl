@extends('dashboard/index')
@section('active_raport', 'active')
@section('show_manajemennilai', 'show')
@section('content')
    <div class="dashboard-content px-3 pt-5">
        <div class="container">
            <div class="row mb-3">
                <div class="container">
                    <div class="col-md-5" data-aos="fade-right" data-aos-duration="1000">
                        <h4 style="font-weight: bold">Form Penilaian Siswa</h4>
                    </div>
                    <div class="col-md-5 float-end" data-aos="fade-left" data-aos-duration="1000">
                        @if (Auth::user()->role == 'admin')
                            <form action="{{ route('raport.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="float-end">
                                    <button type="submit" class="btn custom-btn-primary hover-btn text-white"> <i
                                            class="fa-solid fa-floppy-disk text-white"></i> Simpan</button>
                                </div>
                            @else
                                <form action="{{ route('raport.store.pengajar') }}" method="POST"
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

                <div class="row">
                    <div class="col-md-8">
                        <div class="row box-content mb-3 p-2">
                            <div class="card border-0 box-content mb-3 ">
                                <div class="card-body ">
                                    <div class="prfil d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('storage/images/' . $siswa->foto) }}"
                                            class="img-fluid rounded-circle d-flex justify-content-center align-items-center"
                                            style="width: 100px; height: 100px; object-fit: cover; object-position: center  }}"
                                            alt="">
                                    </div>
                                    <input type="text" value="{{ $siswa->id }}" name="siswa_id" hidden>
                                    <p class="card-text text-secondary text-center fw-bold mt-2">
                                        {{ $siswa->nama_siswa }}</p>
                                    </p>
                                    <p class=" text-secondary text-center mt-2 fs-9">
                                        {{ $siswa->kode_siswa }}</p>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row box-content p-4 mb-3">
                            <div class="col-md-2 ">
                                <div class="mb-3">
                                    <label for="aspek_penilaian" class="form-label">
                                        Kelas
                                    </label>
                                    <input type="text" value="{{ $kelas->nama_kelas }}" class="form-control" readonly>
                                    <input type="text" name="kelas_id" class="form-control" value="{{ $kelas->id }}"
                                        hidden>
                                </div>
                            </div>
                            <div class="col-md-6   mb-3">
                                <div class="mb-3">
                                    <label for="aspek_penilaian" class="form-label">
                                        Program
                                    </label>
                                    <input type="text"
                                        value="{{ $kelas->program->jeniskelas->nama_jenis_kelas }} - {{ $kelas->program->nama_program }}"
                                        class="form-control" readonly>
                                    <input type="text" name="program_id" value="{{ $kelas->program->id }}" hidden>

                                </div>
                            </div>
                            <div class="col-md-4   mb-3">
                                <div class="mb-3">
                                    <label for="aspek_penilaian" class="form-label">
                                        Pengajar
                                    </label>
                                    <input type="text" value="{{ $kelas->pengajar->nama }}" class="form-control"
                                        readonly>
                                    <input type="text" name="pengajar_id" class="form-control" readonly
                                        value="{{ $kelas->pengajar->id }}" hidden>
                                </div>
                            </div>
                        </div>
                        <div class="row box-content mb-3">
                            <label for="tahun_ajaran" class="form-label text-center pt-4">Tahun Ajaran</label>
                            <div class="col-md-6 p-4">
                                <div class="mb-3">
                                    <input type="number" name="awal_tahun_ajaran" class="form-control"
                                        placeholder="Ex.2021">
                                </div>
                            </div>
                            <div class="col-md-6 p-4">
                                <div class="mb-3">
                                    <input type="number" name="akhir_tahun_ajaran" class="form-control"
                                        placeholder="Ex. 2022">
                                </div>
                            </div>
                        </div>

                        <div class="row box-content p-4 mb-3">
                            <div class="col-md-12">
                                <div class="mb-3 ">
                                    <label for="aspek_penilaian" class="form-label">
                                        Topik Aktifitas Pembelajaran
                                    </label>
                                    <textarea type="text" name="topik_aktifitas" class="form-control" rows="5" cols="5"> Ex. Mempelajari bagaimana menggunakan bahasa C dan implementasi bahasa C pada program robotic
                                    </textarea>
                                </div>

                            </div>
                        </div>
                        <div class="row box-content p-4 mb-3">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="catatan_akhir" class="form-label">
                                        Catatan Akhir
                                    </label>
                                    <textarea name="catatan" class="form-control" id="catatan_akhir" rows="5" cols="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 ">
                        <div class="box-content p-4 ms-2">
                            @foreach ($detail_aspek as $ar_1)
                                @foreach ($ar_1 as $detail)
                                    <div class="lab d-flex justify-content-between">
                                        <label for="aspek_penilaian" class="form-label">
                                            {{ $detail->nama_detail_aspek_penilaian }}
                                        </label>
                                        <p for="aspek_penilaian" class="form-label text-end fw-bold">
                                            {{ $detail->aspek_penilaian->aspek_penilaian }}
                                        </p>

                                    </div>

                                    <div class="mb-3">
                                        <div class="mb-2">

                                            <input type="text" name="aspek_id[]" class="form-control"
                                                id="aspek_penilaian" value="{{ $detail->aspek_penilaian_id }}" hidden>
                                            <input type="text" name="detail_aspek_id[]" class="form-control"
                                                id="aspek_penilaian" value="{{ $detail->id }}" hidden>
                                            <input type="number" name="nilai[]" class="form-control"
                                                id="aspek_penilaian">
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                        {{-- @foreach ($detail_aspek as $ar_1)
                                    <p for="aspek_penilaian" class="form-label text-end fw-bold">
                                        {{ $ar_1->aspek_penilaian->aspek_penilaian }}
                                    </p>
                                    <div class="mb-3">
                                        <div class="mb-2">
                                            <label for="aspek_penilaian" class="form-label">
                                                {{ $ar_1->nama_detail_aspek_penilaian }}
                                            </label>
                                            <input type="text" name="aspek_id[]" class="form-control"
                                                id="aspek_penilaian" value="{{ $ar_1->aspek_penilaian_id }}" hidden>
                                            <input type="text" name="detail_aspek_id[]" class="form-control"
                                                id="aspek_penilaian" value="{{ $ar_1->id }}" hidden>
                                            <input type="number" name="nilai[]" class="form-control" id="aspek_penilaian">
                                        </div>
                                    </div>
                                @endforeach --}}

                        {{-- <div class="mb-3">
                                    <p for="aspek_penilaian" class="form-label text-end fw-bold">
                                        Behavior
                                    </p>
                                    <input type="text" name="aspek_id[]" class="form-control" id="aspek_penilaian" hidden
                                        value="">
                                    <div class="mb-2">
                                        <label for="aspek_penilaian" class="form-label">
                                            Attends on time
                                        </label>
                                        <input type="text" name="nama_detail_aspek[]" class="form-control"
                                            id="aspek_penilaian">
                                    </div>
                                    <div class="mb-2">
                                        <label for="aspek_penilaian" class="form-label">
                                            Don't leave class early
                                        </label>
                                        <input type="text" name="nama_detail_aspek[]" class="form-control"
                                            id="aspek_penilaian">
                                    </div>
                                    <div class="mb-2">
                                        <label for="aspek_penilaian" class="form-label">
                                            Communication
                                        </label>
                                        <input type="text" name="nama_detail_aspek[]" class="form-control"
                                            id="aspek_penilaian">
                                    </div>
                                    <div class="mb-2">
                                        <label for="aspek_penilaian" class="form-label">
                                            Responsibility
                                        </label>
                                        <input type="text" name="nama_detail_aspek[]" class="form-control"
                                            id="aspek_penilaian">
                                    </div>
                                </div> --}}


                        {{-- <div class="card border-0 ">
                            <div class="card-body ">
                                <div class="prfil d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('storage/images/' . $siswa->foto) }}"
                                        class="img-fluid rounded-circle d-flex justify-content-center align-items-center"
                                        style="width: 60px; height: 60px; object-fit: cover; object-position: center  }}"
                                        alt="">
                                </div>
                                <input type="text" value="{{ $siswa->id }}" name="siswa_id" hidden>
                                <p class="card-text text-secondary text-center fw-bold mt-2">
                                    {{ $siswa->nama_siswa }}</p>
                                </p>

                                <div class="qr d-flex justify-content-center align-items-center ">
                                    <p>{!! QrCode::size(70)->generate($siswa->kode_siswa) !!}</p>
                                </div>
                                <p class=" text-secondary text-center">
                                    <img src="{{ asset('logo.png') }}" class="img-fluid"
                                        style="width: 40px; height: 30px" alt="">
                                    Student Center
                                </p>
                                <p class="text-secondary text-center" style="font-size: 12px">Jln.
                                    Manggasari Probolinggo Jawa Timur </p>
                            </div>
                        </div> --}}

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    {{-- FIX kan yak  --}}
    {{-- <script>
        function getProgram(id) {
            let id_program = id;
            console.log(id_program);

            // Mendapatkan siswa dengan data pendaftaran programid = id
            let url = "{{ route('pendaftaran.show', ':id') }}";
            url = url.replace(':id', id_program);

            let selectedSiswaIds = [];

            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(response) {
                    let $data_siswa = document.getElementById('datasiswa');
                    // jika response berupa array dan panjangnya > 0
                    console.log(response);
                    if (response.data.length > 0) {
                        $data_siswa.innerHTML = '';
                        for (let i = 0; i < response.data.length; i++) {
                            $data_siswa.innerHTML += `
                                <div class="mb-3">

                                    <div class="form-check">
                                        <input type="checkbox" name="siswa_id[]" id="siswa_id[]" class="form-check-input" value="${response.data[i].id}">
                                        <div class="row">
                                            <div class="col-md-4 justify-content-center align-items-center d-flex">
                                                <img src="{{ asset('storage/images/') }}/${response.data[i].foto}" class="img-fluid rounded rounded-circle" alt="" style="width: 60px; height: 60px">
                                            </div>
                                            <div class="col-md-8 justify-content-center align-items-center">
                                                <p class="text-secondary">${response.data[i].kode_siswa}</p>
                                                <p>${response.data[i].nama_siswa}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                            // Tambahkan siswa_id yang dipilih ke dalam array
                            selectedSiswaIds.push(response.data[i].id);

                        }
                    } else {
                        $data_siswa.innerHTML =
                            '<h5 class="text-danger text-justify">Tidak Ada Data Siswa Dengan Program Ini</h5>';
                    }

                }
            });
            // tampilkan hanya just selected id yang ddipilih pada inputan checkbox
            // Tampilkan hanya yang dipilih
            let selectedIds = [];
            $(document).on('change', 'input[name="siswa_id[]"]', function() {

                selectedIds = $('input[name="siswa_id[]"]:checked').map(function() {
                    return $(this).val();
                }).get();

                let siswa_idvalue = document.getElementById('siswa_idvalue');
                siswa_idvalue.value = selectedIds;
                console.log(selectedIds);

                // Mengisi elemen-elemen input teks sesuai dengan nilai-nilai yang dipilih
            });

            $(document).ready(function() {
                // Ketika tombol "Check All" diklik
                $('#checkAll').click(function() {
                    // Cek atau lepaskan semua checkbox dengan nama "siswa_id[]"
                    $('input[name="siswa_id[]"]').prop('checked', true).trigger('change');
                    console.log(selectedIds);
                });
            });




        }
    </script> --}}

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
                    <div class="col-md-5 d-flex justify-content-end ms-auto" data-aos="fade-left" data-aos-duration="1000">
                        {{-- cetak raport --}}
                        @if (Auth::user()->role == 'admin')
                            <form action="{{ route('raport.cetak', $raport[0]->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="btn custom-btn-edit hover-btn text-white me-2"><i
                                        class="fa-solid fa-print text-white"></i> Cetak</button>
                            </form>
                            <form action="{{ route('raport.update', $raport[0]->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="float-end">
                                    <button type="submit" class="btn custom-btn-primary hover-btn text-white"> <i
                                            class="fa-solid fa-floppy-disk text-white"></i> Update</button>
                                </div>
                            @else
                                <form action="{{ route('raport.cetak.pengajar', $raport[0]->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn custom-btn-edit hover-btn text-white me-2"><i
                                            class="fa-solid fa-print text-white"></i> Cetak</button>
                                </form>
                                <form action="{{ route('raport.update.pengajar', $raport[0]->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="float-end">
                                        <button type="submit" class="btn custom-btn-primary hover-btn text-white"> <i
                                                class="fa-solid fa-floppy-disk text-white"></i> Update</button>
                                    </div>
                        @endif



                    </div>
                </div>
            </div>
            <div class="container" data-aos="fade-left" data-aos-duration="1500">

                <div class="row">
                    <div class="col-md-7">
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
                                        placeholder="Ex.2021" value="{{ $raport[0]->awal_tahun_ajaran }}">
                                </div>
                            </div>
                            <div class="col-md-6 p-4">
                                <div class="mb-3">
                                    <input type="number" name="akhir_tahun_ajaran" class="form-control"
                                        placeholder="Ex. 2022" value="{{ $raport[0]->akhir_tahun_ajaran }}">
                                </div>
                            </div>
                        </div>

                        <div class="row box-content p-4 mb-3">
                            <div class="col-md-12">
                                <div class="mb-3 ">
                                    <label for="aspek_penilaian" class="form-label">
                                        Topik Aktifitas Pembelajaran
                                    </label>
                                    <textarea type="text" name="topik_aktifitas" class="form-control" rows="5" cols="5">{{ $raport[0]->topik_aktifitas }}
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
                                    <textarea name="catatan" class="form-control" id="catatan_akhir" rows="5" cols="5"> {{ $raport[0]->catatan }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 mb-4 ">
                        <div class="box-content p-4 ms-2">

                            @foreach ($detail_raport as $detail)
                                <div class="lab d-flex justify-content-between">
                                    <label for="aspek_penilaian" class="form-label">
                                        {{ $detail->detail_aspek->nama_detail_aspek_penilaian }}
                                    </label>
                                    @php
                                        if ($detail->nilai >= 90) {
                                            $bg = 'bg-success text-white';
                                        } elseif ($detail->nilai >= 80) {
                                            $bg = 'bg-warning text-white';
                                        } elseif ($detail->nilai >= 70) {
                                            $bg = 'bg-info text-white';
                                        } elseif ($detail->nilai >= 60) {
                                            $bg = 'bg-secondary text-white';
                                        } elseif ($detail->nilai >= 50) {
                                            $bg = 'bg-danger text-white';
                                        } elseif ($detail->nilai >= 40) {
                                            $bg = 'bg-danger text-white';
                                        } else {
                                            $bg = 'bg-danger text-white';
                                        }
                                    @endphp

                                    <p for="aspek_penilaian" class="form-label text-end fw-bold">
                                        {{ $detail->detail_aspek->aspek_penilaian->aspek_penilaian }}
                                    </p>

                                </div>

                                <div class="mb-3">
                                    <div class="mb-2">

                                        <input type="text" name="aspek_id[]" class="form-control"
                                            id="aspek_penilaian" value="{{ $detail->aspek_id }}" hidden>
                                        <input type="text" name="detail_aspek_id[]" class="form-control"
                                            id="aspek_penilaian" value="{{ $detail->detail_aspek_id }}" hidden>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <input type="number" name="nilai[]" class="form-control"
                                                        id="aspek_penilaian" value="{{ $detail->nilai }}">
                                                </div>
                                                <span
                                                    class="input-group-text form-control justify-content-center {{ $bg }}">{{ $detail->simbol_mutu }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

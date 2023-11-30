@extends('dashboard/index')
@section('active_aspekpenilaian', 'active')
@section('show_manajemennilai', 'show')
@section('content')
    <div class="dashboard-content px-3 pt-5">
        <div class="container">
            <div class="row mb-3">
                <div class="container">
                    <div class="col-md-5" data-aos="fade-right" data-aos-duration="1000">
                        <h4 style="font-weight: bold">Tambah Aspek Penilaian
                        </h4>
                    </div>
                    <div class="col-md-5 float-end" data-aos="fade-left" data-aos-duration="1000">
                        <form action="{{ route('aspekpenilaian.store') }}" method="POST" enctype="multipart/form-data">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Bidang
                                            Program</label>
                                        <select name="bidang" class="form-control" id="bidang" required>
                                            <option class="form-control">--Pilih Bidang--</option>
                                            <option value="Robotik" class="form-control">Robotik</option>
                                            <option value="BahasaMandarin" class="form-control">Bahasa Mandarin
                                            </option>
                                            <option value="BahasaMandarin" class="form-control">Bahasa Mandarin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="aspek_penilaian" class="form-label">Aspek Penilaian</label>
                                        <input type="text" name="aspek_penilaian" class="form-control"
                                            id="aspek_penilaian" required>
                                    </div>
                                </div>
                            </div>



                            <div class="mb-3">
                                <div class="row d-flex">
                                    <div class="col">
                                        <span class="fw-bold">Detail Aspek Penilain</span>
                                    </div>
                                    <div class="col text-end">
                                        <span id="btn-add" class="btn btn-info btn-sm text-white">Tambah</span>
                                        <span id="btn-remove" class="btn btn-danger btn-sm text-white d-none"
                                            onclick="removeJadwal()">Hapus</span>
                                    </div>
                                </div>
                            </div>
                            <div class="jadwal-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="nama_detail_aspek_penilaian" class="form-label">Nama
                                                Penialian</label>
                                            <input type="text" name="nama_detail_aspek_penilaian[]" class="form-control"
                                                id="nama_detail_aspek_penilaian"required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="jadwal-baru">

                            </div>
                        </div>

                        <input type="text" name="value_all_detail_aspek_penilaian[]"
                            id="value_all_detail_aspek_penilaian" hidden>

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
            <div class="mb-3">
                                    <input type="text" name="nama_detail_aspek_penilaian[]" class="form-control"
                                        id="nama_detail_aspek_penilaian"required>
                                </div>
                `);
            $('#btn-remove').removeClass('d-none');
            console.log(i);

        });

        let alldetail_aspek_penilaian = []

        $(document).on('change', 'input[name="nama_detail_aspek_penilaian[]"]', function() {
            alldetail_aspek_penilaian = $('input[name="nama_detail_aspek_penilaian[]"]').map(function() {
                return $(this).val();
            }).get();
            $('#value_all_detail_aspek_penilaian').val(alldetail_aspek_penilaian);
        })


        function removeJadwal() {
            $('.jadwal-baru').children().last().remove();
        }
    </script>
@endpush

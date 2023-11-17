@extends('dashboard/index')
@section('active_kelas', 'active')
@section('show_manajemenkelas', 'show')
@section('content')
    <div class="dashboard-content px-3 pt-5">
        <div class="container">
            <div class="row mb-3">
                <div class="container">
                    <div class="col-md-5">
                        <h2 class="ms-4" style="font-weight: bold">Tambah kelas</h2>
                    </div>
                    <div class="col-md-5 float-end">
                        <form action="{{ route('kelas.update-tambahsiswa', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="float-end">
                                <button type="submit" class="btn custom-btn-primary hover-btn text-white"> <i
                                        class="fa-solid fa-floppy-disk text-white"></i> Simpan</button>
                            </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <div class="p-5">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nama kelas</label>
                                    <input type="text" name="nama_kelas" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Ex. Joghardi"
                                        value="{{ $data->nama_kelas }}" required readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Program </label>
                                    <select name="program_id" id="program" class="form-control"
                                        onchange="getProgram(this.value)">
                                        <option value=""> --Pilih Program--</option>
                                        <option value="{{ $data->program_id }}"> {{ $data->program->nama_program }}</option>
                                    </select>
                                </div>
                            </div>

                            <input type="text" name="siswa_idnya[]" id="siswa_idvalue" hidden>


                            <div class="col-md-6 bg-white p-4">

                                <div class="check d-flex justify-content-between align-items-center mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Data Siswa</label>
                                    <span id="checkAll" class="btn btn-primary">Pilih Semua</span>
                                </div>


                                <div class="datasiswa" id="datasiswa">

                                </div>
                            </div>
                            </form>

                        </div>

                    </div>
                </div>

            </div>


        </div>

    @endsection

    {{-- FIX kan yak  --}}
    <script>
        function getProgram(id) {
            let id_program = id;
            console.log(id_program);

            // Mendapatkan siswa dengan data pendaftaran programid = id
            let url = "{{ route('pendaftaran.show.tambah', ':id') }}";
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
    </script>

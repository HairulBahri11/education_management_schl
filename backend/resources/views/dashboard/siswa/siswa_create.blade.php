@extends('dashboard/index')
@section('active_siswa', 'active')
@section('show_manajemensiswa', 'show')
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
                title: "Opps!",
                text: "{{ session('error') }}!",
                icon: "error",
                button: "OK",
            });
        </script>
    @endif
    <div class="dashboard-content px-3 pt-5">
        <div class="container">
            <div class="row mb-3">
                <div class="container">
                    <div class="col-md-5">
                        <h2 class="ms-4" style="font-weight: bold">Tambah siswa</h2>
                    </div>
                    <div class="col-md-5 float-end">
                        <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="float-end">
                                <button type="submit" class="btn custom-btn-primary hover-btn text-white"> <i
                                        class="fa-solid fa-floppy-disk text-white"></i> Simpan</button>
                            </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="box-content">
                    <div class="col bg-white">
                        <div class="p-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Kode Pendaftaran</label>
                                        <select name="pendaftaran_id" class="form-control"  id="pendaftaran_id"
                                            onchange="getPendaftaran()" required>
                                            <option class="form-control">--Data Pendaftaran--</option>
                                            @foreach ($pendaftaran as $pf)
                                            {{-- tidak boleh ada spasi --}}
                                                <option value="{{ $pf->id }}" class="form-control">{{ $pf->kode_pendaftaran }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama siswa</label>
                                        <input type="text" name="nama_siswa" class="form-control" id="nama_anak"
                                            placeholder="Ex. Joghardi" required>
                                    </div>
                                    <div>
                                        <label for="exampleFormControlTextarea1" class="form-label">Jenis Kelamin</label>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="jenis_kelamin1" value="L">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Laki Laki
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="flexRadioDefault2" value="P">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Foto</label>
                                        <input type="file" name="foto" class="form-control"
                                            id="exampleFormControlTextarea1" rows="3" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Tempat Lahir </label>
                                        <input type="text" class="form-control" name="tempat_lahir"
                                            id="exampleFormControlTextarea1" rows="3" placeholder="Alamat lengkap"
                                            required></input>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Tanggal Lahir </label>
                                        <input type="date" class="form-control" name="tgl_lahir"
                                            id="exampleFormControlTextarea1" rows="3">
                                    </div>

                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    @endsection

    <script>
        function getPendaftaran() {
            //    ambil pendaftaran_id berdasarkan isi selected option
            var selectedOption = $('#pendaftaran_id').find('option:selected');
            var pendaftaran_id = selectedOption.text(); // Mengambil teks yang dipilih
            console.log(pendaftaran_id);

            // / Membuat URL dengan parameter pendaftaran_id
            var url = "{{ route('pendaftaran.show', ['id' => ':id']) }}";
            url = url.replace(':id', pendaftaran_id);

            $.ajax({
                type: "GET",
                url: url, // Sesuaikan dengan nama rute Anda
                dataType: "json", // Jika Anda mengharapkan respons dalam format JSON
                success: function(response) {
                    console.log(response);
                    if (response.status == true) {
                        $('#nama_anak').val(response.data.nama_anak);
                    } else {
                        // buat pendaftaran_id valuenya kosong
                        $('#pendaftaran_id').val('');
                        alert('Data Pedaftaran Telah Digunakan');
                    }

                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
        }
    </script>

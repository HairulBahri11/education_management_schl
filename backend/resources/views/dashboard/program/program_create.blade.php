@extends('dashboard/index')
@section('active_program', 'active')
@section('show_manajemenprogram', 'show')
@section('content')
    <div class="dashboard-content px-3 pt-5">
        <div class="container">
            <div class="row mb-3">
                <div class="container">
                    <div class="col-md-5" data-aos="fade-right" data-aos-duration="1000">
                        <h4 style="font-weight: bold">Tambah Program</h4>
                    </div>
                    <div class="col-md-5 float-end" data-aos="fade-left" data-aos-duration="1000">
                        <form action="{{ route('program.store') }}" method="POST" enctype="multipart/form-data">
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
                        <div class="col bg-white">
                            <div class="p-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Bidang
                                                Program</label>
                                            <select name="bidang" class="form-control" id="bidang" required>
                                                <option class="form-control">--Pilih Bidang--</option>
                                                <option value="Robotik" class="form-control">Robotik</option>
                                                <option value="BahasaInggris" class="form-control">Bahasa Inggris
                                                </option>
                                                <option value="BahasaMandarin" class="form-control">Bahasa Mandarin</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Program</label>
                                            <input type="text" name="nama_program" class="form-control"
                                                id="exampleFormControlInput1" placeholder="Judul Program" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Kategori
                                                Program</label>
                                            <select name="kategori_program" class="form-control" id="kategori_program"
                                                onchange="getKategori()" required>
                                                <option class="form-control">--Pilih Kategori--</option>
                                                <option value="Trial" class="form-control">Trial</option>
                                                <option value="Premium" class="form-control">Premium</option>
                                            </select>
                                        </div>
                                        <div class="mb-3" id="jp_for_premium">
                                            <label for="exampleFormControlInput1" class="form-label" id="label_jeniskelas">
                                                Jenis Program</label>
                                            <select class="form-control" id="jenis_kelas" onchange="getJenisKelas()">
                                                <option class="form-control">--Pilih Jenis Program--</option>
                                                <option value="1" class="form-control"> Private</option>
                                                <option value="2" class="form-control"> Semi Private</option>
                                                <option value="3" class="form-control">Reguler</option>
                                            </select>
                                        </div>
                                        {{-- <input type="text" name="jeniskelas_id" id="jeniskelas_value" hidden> --}}
                                        <div class="mb-3" id="jp_for_trial">
                                            <label for="exampleFormControlInput1" class="form-label">Jenis Program</label>
                                            <input type="text" name="jeniskelas_id" class="form-control"
                                                id="jeniskelas-value">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Durasi</label>
                                            <input type="text" class="form-control" name="durasi" id="durasi"
                                                placeholder="Ex. 3 bulan" required>
                                        </div>

                                        <div class="mb-3" id="harganya">
                                            <label for="exampleFormControlTextarea1" class="form-label">Harga</label>
                                            <input type="text" class="form-control" name="harga" id="harga"
                                                placeholder="Harga" required>
                                        </div>


                                    </div>

                                    <div class="col-md-6">


                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Gambar</label>
                                            <input type="file" name="gambar" class="form-control"
                                                id="exampleFormControlTextarea1" rows="3" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                            {{-- <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3" placeholder="Deskripsi"
                                            required></textarea> --}}
                                            <textarea id="editor" name="deskripsi" class="form-control" rows="3"></textarea>


                                        </div>
                                        <script>
                                            ClassicEditor
                                                .create(document.querySelector('#editor'))
                                                .catch(error => {
                                                    console.error(error);
                                                });
                                        </script>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('js')
    <script>
        // ambil data kategori
        document.addEventListener('DOMContentLoaded', function() {

            getKategori();
            getJenisKelas();

        });

        function getKategori() {
            var kategori = document.getElementById('kategori_program').value;
            var jenis_kelas = document.getElementById('jenis_kelas');
            var label_jeniskelas = document.getElementById('label_jeniskelas');
            var harganya = document.getElementById('harga_lihat');
            var label_jos = document.getElementById('label-jos');

            console.log(kategori);

            if (kategori === 'Trial') {
                $('#jp_for_premium').hide();
                $('#harga').val('0');
                $('#jeniskelas-value').val('15');
                $('#harganya').hide();
            } else {
                getJenisKelas();
                $('#jp_for_trial').hide();
                $('#jp_for_premium').show();

                $('#harganya').show();

            }
        }

        function getJenisKelas() {
            var jenis_kelas = document.getElementById('jenis_kelas').value;
            var jenis_kelas_value = document.getElementById('jeniskelas-value');
            jenis_kelas_value.value = jenis_kelas;
            console.log(jenis_kelas);
        }
    </script>
@endpush
{{-- <script>
        // ambil data kategori
        document.addEventListener('DOMContentLoaded', function() {

            getKategori();

        });







        function getKategori() {
            var kategori = document.getElementById('kategori_program').value;
            var jenis_kelas = document.getElementById('jenis_kelas');
            var label_jeniskelas = document.getElementById('label_jeniskelas');
            var harganya = document.getElementById('harga');
            var label_jos = document.getElementById('label-jos');
            // var harganya_name = document.getElementById('harga_name');
            // get element by name
            var harganya_name = document.getElementsByName('harga')[0];

            console.log(kategori);

            if (kategori === 'Trial') {
                // Hide the "jenis_kelas" element
                jenis_kelas.style.display = 'none';
                label_jeniskelas.style.display = 'none';
                harganya.disabled = true;
                harganya.value = '0';
                harganya_name.value = 0;

                // console.log('harga', harganya.value);

                // Set the value of "jenis_kelas" to 15

                console.log(harganya.value);
                jenis_kelas.value = 15;
                console.log(jenis_kelas.value);
                label_jos.style.display = 'none';
            } else {
                // If the dropdown value is not "Trial," show the "jenis_kelas" element
                jenis_kelas.style.display = 'block';
                label_jeniskelas.style.display = 'block';
                harganya.disabled = false; // You can set this to 'block' or 'initial' based on your needs

                // Enable the dropdown
                jenis_kelas.disabled = false;
                label_jos.style.display = 'none';
            }
        }
    </script> --}}

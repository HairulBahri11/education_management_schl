@extends('dashboard/index')
@section('active_pendaftaran', 'active')
@section('show_manajemensiswa', 'show')
@section('content')
    <div class="dashboard-content px-3 pt-5">
        <div class="container">
            <div class="row mb-3">
                <div class="container">
                    <div class="col-md-5" data-aos="fade-right" data-aos-duration="1000">
                        <h4 style="font-weight: bold">Tambah Pendaftaran</h4>
                    </div>
                    <div class="col-md-5 float-end" data-aos="fade-left" data-aos-duration="1000">
                        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
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
                                            <label for="exampleFormControlInput1" class="form-label">Orang Tua</label>
                                            <select name="id_orangtua" class="form-control" id="">
                                                <option class="form-control">-- Akun Orang Tua--</option>
                                                @foreach ($orangtua as $data)
                                                    <option value="{{ $data->id }}" class="form-control">
                                                        {{ $data->nama }} - {{ $data->email }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Program</label>
                                            <select name="id_program" class="form-control" id="kategori_program"
                                                onchange="getKategori()" required>
                                                <option class="form-control">--Pilih Progaram</option>
                                                @foreach ($program as $item)
                                                    <option value="{{ $item->id }}" class="form-control">
                                                        {{ $item->nama_program }} - {{ $item->kategori_program }} -
                                                        {{ $item->jeniskelas->nama_jenis_kelas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Nama Anak</label>
                                            <input type="text" class="form-control" name="nama_anak" id="harga"
                                                placeholder="joko" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Asal Sekolah</label>
                                            <input type="text" class="form-control" name="asal_sekolah" id="harga"
                                                placeholder="Smpn 1 kertosono" required>
                                        </div>


                                    </div>

                                    <div class="col-md-6">


                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" id="label_bp" class="form-label">Bukti
                                                Pembayaran</label>
                                            <input type="file" name="bukti_pembayaran" class="form-control"
                                                id="bukti_pembayaran">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" id="label_sp" class="form-label">Status
                                                Pembayaran</label>
                                            <select name="status_pembayaran" class="form-control" id="status_pembayaran">
                                                <option class="form-control">--Status Pembayaran--</option>
                                                <option value="Sudah-Bayar" class="form-control">Sudah Bayar</option>
                                                <option value="Belum-Bayar" class="form-control">Belum Bayar</option>
                                                <option value="Menunggu-Konfirmasi" class="form-control">Menunggu Konfirmasi
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Catatan</label>
                                            <textarea type="text" name="catatan" class="form-control" id="exampleFormControlTextarea1" rows="3" required> </textarea>
                                        </div>


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

<script>
    // ambil data kategori
    function getKategori() {
        var id_program = document.getElementById('kategori_program').value;

        // ajax untuk mendapatkan data kategori program
        let url = "{{ route('program.getkategori', ['id' => ':id']) }}";
        url = url.replace(':id', id_program);

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(response) {
                console.log(response.kategori_program);
                if (response.kategori_program == 'Trial') {
                    // hide status pembayaran dan bukti pembayaran
                    document.getElementById('label_sp').style.display = 'none';
                    document.getElementById('label_bp').style.display = 'none';
                    document.getElementById('status_pembayaran').style.display = 'none';
                    document.getElementById('bukti_pembayaran').style.display = 'none';

                } else {
                    document.getElementById('label_sp').style.display = 'block';
                    document.getElementById('label_bp').style.display = 'block';
                    document.getElementById('status_pembayaran').style.display = 'block';
                    document.getElementById('bukti_pembayaran').style.display = 'block';

                }
            }
        })
    }
</script>



{{-- <script>
        // ambil data kategori
        document.addEventListener('DOMContentLoaded', function() {

            getKategori();

        });

        function getKategori() {
            var kategori = document.getElementById('kategori_program').value;
            var jenis_kelas = document.getElementById('jenis_kelas');
            var label_jeniskelas = document.getElementById('label_jeniskelas');
            var harganya = document.getElementById('harga_lihat');
            var label_jos = document.getElementById('label-jos');

            console.log(kategori);

            if (kategori === 'Trial') {
                // Hide the "jenis_kelas" element
                jenis_kelas.style.display = 'none';
                label_jeniskelas.style.display = 'none';
                harganya.disabled = true;
                harganya.value = 0;

                // console.log('harga', harganya.value);

                // Set the value of "jenis_kelas" to 15
                jenis_kelas.value = 15;
                console.log(harganya.value);
                console.log(jenis_kelas.value);
                label_jos.style.display = 'none';
            } else {
                // If the dropdown value is not "Trial," show the "jenis_kelas" element
                jenis_kelas.style.display = 'block';
                label_jeniskelas.style.display = 'block';
                harganya.disabled = false; // You can set this to 'block' or 'initial' based on your needs

                // Enable the dropdown
                jenis_kelas.disabled = false;
            }
        }
    </script> --}}

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

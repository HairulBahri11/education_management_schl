@extends('dashboard/index')
@section('active_siswa', 'active')
@section('show_manajemensiswa', 'show')
@section('content')
    <div class="dashboard-content px-3 pt-5">
        <div class="container">
            <div class="row mb-3">
                <div class="container">
                    <div class="col-md-5">
                        <h4 style="font-weight: bold">Tambah Pendaftaran</h4>
                    </div>
                    <div class="col-md-5 float-end">
                        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="float-end">
                                <button type="submit" class="btn custom-btn-primary hover-btn text-white"> <i
                                        class="fa-solid fa-floppy-disk text-white"></i> Simpan</button>
                            </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mb-3">
                    <div class="box-content">
                        <div class="col bg-white">
                            <div class="p-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Orang Tua</label>
                                            {{-- only see --}}
                                            <select name="id_orangtua" class="form-control" @readonly(true)>
                                                <option class="form-control" value="{{ $data->pendaftaran->id_orangtua }}"
                                                    readonly>{{ $data->pendaftaran->orangtua->nama }}
                                                    -{{ $data->pendaftaran->orangtua->email }}</option>
                                            </select>
                                            {{-- <input type="text" class="form-control" name="id_orangtua" id=""  readonly> --}}

                                        </div>


                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Nama Anak</label>
                                            <input type="text" class="form-control" name="nama_anak" id="harga"
                                                value="{{ $data->nama_siswa }}" readonly placeholder="joko" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Asal Sekolah</label>
                                            <input type="text" class="form-control" name="asal_sekolah" id="harga"
                                                placeholder="Smpn 1 kertosono" required
                                                value="{{ $data->pendaftaran->asal_sekolah }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Program</label>
                                            <select name="id_program" class="form-control" id="kategori_program"
                                                onchange="getKategori()" required>
                                                <option class="form-control">--Pilih Program</option>
                                                @foreach ($program as $item)
                                                    <option value="{{ $item->id }}" class="form-control">
                                                        {{ $item->nama_program }} - {{ $item->kategori_program }} -
                                                        {{ $item->jeniskelas->nama_jenis_kelas }}
                                                    </option>
                                                @endforeach
                                            </select>
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
                                            <label for="exampleFormControlInput1" id="label_sp" class="form-label"
                                                hidden>Status Pembayaran</label>
                                            <input type="text" name="status_pembayaran" id="status_pembayaran"
                                                value="Sudah-Bayar" hidden>
                                            {{-- <select name="status_pembayaran" class="form-control" id="status_pembayaran"
                                          >
                                            <option class="form-control">--Status Pembayaran--</option>
                                            <option value="Sudah-Bayar" class="form-control">Sudah Bayar</option>
                                            <option value="Belum-Bayar" class="form-control">Belum Bayar</option>
                                            <option value="Menunggu-Konfirmasi" class="form-control">Menunggu Konfirmasi</option>
                                        </select> --}}
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

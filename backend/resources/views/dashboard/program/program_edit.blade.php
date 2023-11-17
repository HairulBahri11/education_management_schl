@extends('dashboard/index')
@section('active_program', 'active')
@section('show_manajemenprogram', 'show')
@section('content')
    <div class="dashboard-content px-3 pt-5">
        <div class="container">
            <div class="row mb-3">
                <div class="container">
                    <div class="col-md-5">
                        <h4 style="font-weight: bold">Edit Program</h4>
                    </div>
                    <div class="col-md-5 float-end">
                        <form action="{{ route('program.update', $data->id) }}" method="POST" enctype="multipart/form-data">
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
                                            <label for="exampleFormControlInput1" class="form-label">Program</label>
                                            <input type="text" name="nama_program" class="form-control"
                                                id="exampleFormControlInput1" placeholder="Program" required
                                                value="{{ $data->nama_program }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Kategori
                                                Program</label>
                                            <select name="kategori_program" class="form-control" id="kategori_program"
                                                onchange="getKategori()" required>
                                                <option class="form-control" value="{{ $data->kategori_program }}">
                                                    {{ $data->kategori_program }}</option>
                                                <option value="Trial" class="form-control">Trial</option>
                                                <option value="Premium" class="form-control">Premium</option>
                                            </select>
                                        </div>
                                        <div class="mb-3" id="jp_for_premium">
                                            <label for="exampleFormControlInput1" class="form-label" id="label_jeniskelas">
                                                Jenis Program</label>
                                            @php
                                                if ($data->jeniskelas_id == '15') {
                                                    $value = 'Bersama';
                                                } elseif ($data->jeniskelas_id == '1') {
                                                    $value = 'Private';
                                                } elseif ($data->jeniskelas_id == '2') {
                                                    $value = 'Semi Private';
                                                } elseif ($data->jeniskelas_id == '3') {
                                                    $value = 'Reguler';
                                                }

                                            @endphp
                                            <select class="form-control" id="jenis_kelas" onchange="getJenisKelas()">
                                                <option class="form-control" value="{{ $data->jeniskelas_id }}">
                                                    {{ $value }}</option>
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
                                        {{-- <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Kategori Program</label>
                                        <select name="kategori_program" class="form-control" id="kategori_program"
                                            onchange="getKategori()" required>
                                            <option class="form-control" value="{{ $data->kategori_program }}">
                                                {{ $data->kategori_program }}</option>
                                            <option value="Trial" class="form-control">Trial</option>
                                            <option value="Premium" class="form-control">Premium</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label" id="label_jeniskelas">Jenis
                                            Program</label>
                                        <select name="jeniskelas_id" class="form-control" id="jenis_kelas"
                                            onchange="getKategori()">
                                            @if ($jeniskelas[3]->id == 15)
                                                <option value="{{ $jeniskelas[3]->id }}" class="form-control">
                                                    {{ $jeniskelas[3]->nama_jenis_kelas }}</option>
                                            @else
                                                <option value="{{ $jeniskelas[0]->id }}" class="form-control">
                                                    {{ $jeniskelas[0]->nama_jenis_kelas }}</option>
                                                <option value="{{ $jeniskelas[1]->id }}" class="form-control">
                                                    {{ $jeniskelas[1]->nama_jenis_kelas }}</option>
                                                <option value="{{ $jeniskelas[2]->id }}" class="form-control">
                                                    {{ $jeniskelas[2]->nama_jenis_kelas }}</option>
                                            @endif



                                        </select>
                                    </div> --}}
                                        {{-- <p id="label-jos">{{ $data->jeniskelas->nama_jenis_kelas }}</p> --}}
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Harga</label>
                                            <input type="number" class="form-control" name="harga" id="hargaJos"
                                                placeholder="Harga" value="{{ $data->harga }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Durasi</label>
                                            <input type="text" class="form-control" name="durasi" id="durasi"
                                                placeholder="Ex. 3 bulan" required value="{{ $data->durasi }}">
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                            {{-- <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3" placeholder="Deskripsi"
                                            required></textarea> --}}
                                            <textarea id="editor" name="deskripsi" class="form-control" rows="3">{{ $data->deskripsi }}</textarea>


                                        </div>
                                        <script>
                                            ClassicEditor
                                                .create(document.querySelector('#editor'))
                                                .catch(error => {
                                                    console.error(error);
                                                });
                                        </script>

                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Gambar</label>
                                            <input type="file" name="gambar" class="form-control"
                                                id="exampleFormControlTextarea1" rows="3"
                                                {{ $data->gambar ? 'value=' . $data->gambar : '' }}>
                                            <img src="{{ asset('storage/images/' . $data->gambar) }}" class="mt-2"
                                                width="100" alt="">
                                            <span>{{ $data->gambar }}</span>
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
                $('#harnyanya').hide();
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
            var harganya = document.getElementById('hargaJos');
            var label_jos = document.getElementById('label-jos');

            console.log(kategori);

            if (kategori === 'Trial') {
                // Hide the "jenis_kelas" element
                jenis_kelas.style.display = 'none';
                label_jeniskelas.style.display = 'none';
                harganya.value = 0;
                harganya.disabled = true;


                // console.log('harga', harganya.value);

                // Set the value of "jenis_kelas" to 15

                jenis_kelas.value = 15;
                console.log(jenis_kelas.value);
                console.log(harganya.value);

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

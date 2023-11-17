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
                        <h4 style="font-weight: bold">Siswa</h4>

                    </div>
                    {{-- <div class="col-md-5 float-end">
                        <div class="float-end">
                            <a href="{{ route('siswa.create') }}"
                                class="btn btn-sm custom-btn-primary text-white hover-btn"><i
                                    class="fa-solid fa-circle-plus text-white"></i>Tambah</a>

                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="box-content">
                        <div class="col">
                            <div class="p-3">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="example">
                                        <thead class="bg-gray-100 p-1">
                                            <tr style="bg-color: black" class="mt-2">
                                                <th class="text-xs text-secondary opacity-7">Foto</th>
                                                <th class="text-xs text-secondary opacity-7">Kode Siswa</th>
                                                <th class="text-xs text-secondary opacity-7">Nama Siswa
                                                </th>
                                                <th class="text-xs text-secondary opacity-7">Gender</th>
                                                {{-- <th class="text-xs text-secondary opacity-7">Program</th> --}}
                                                <th class="text-xs text-secondary opacity-7">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td align-middle>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <img src="{{ asset('storage/images/' . $item->foto) }}"
                                                                    width="100" height="100" alt="gambar">
                                                            </div>

                                                        </div>
                                                    </td>
                                                    <td class="text-secondary opacity-7 align-middle">
                                                        <div class="user-info " align="center">
                                                            <p>{{ $item->kode_siswa }}</p>
                                                            {!! QrCode::size(50)->generate($item->kode_siswa) !!}
                                                        </div>
                                                    </td>
                                                    <td class="text-secondary opacity-7 align-middle">
                                                        <div class="user-info">
                                                            <p class="user-name">{{ $item->nama_siswa }}</p>

                                                        </div>
                                                    </td>

                                                    <td class="text-xs text-secondary opacity-7 align-middle">
                                                        @if ($item->jenis_kelamin == 'L')
                                                            Laki Laki
                                                        @else
                                                            Perempuan
                                                        @endif
                                                    </td>

                                                    {{-- <td class="text-xs text-secondary opacity-7 align-middle">
                                                    <span>
                                                        <i class="fa-solid fa-location-dot"> </i>
                                                        {{ $item->pendaftaran->program->nama_program }} -
                                                        {{ $item->pendaftaran->program->jeniskelas->nama_jenis_kelas }}
                                                    </span>

                                                </td> --}}



                                                    <td class="text-xs text-secondary opacity-7 align-middle">

                                                        <small class="btn btn-sm btn-info hover-btn"
                                                            onclick="detail({{ $item->id }})";
                                                            style="border-radius: 8px; border: none" title="View"><i
                                                                class="fa-solid fa-eye text-white"></i></small>

                                                        <a href="{{ route('siswa.edit', $item->id) }}"
                                                            class="btn btn-sm custom-btn-edit hover-btn" title="Edit"><i
                                                                class="fa-solid fa-pen-to-square text-white"></i></a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal-show">
            <div class="modal-dialog modal-lg" id="myModal-show">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mt-3">
                        <div class="container">

                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="card-box-shadow">
                                        <b>
                                            <sPan id="nama_siswa"></sPan>
                                        </b>
                                        <br>
                                        <img src="" id="gambarLihat" alt="gambar" width="100" height="100">

                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="card-box-shadow">
                                        <div class="col">
                                            <img class="img-icon" src="" id="gambarOrangTua" alt="">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Orang Tua</label>
                                            <b>
                                                <p id="nama_orangtua"></p>
                                            </b>
                                        </div>
                                        <div class="col-md-10">
                                            <label for="">No Telp</label>
                                            <b>
                                                <a href="" id="waUrl"
                                                    class="btn btn-sm custom-btn-green hover-btn form-control"
                                                    title="Chat Whatsapp">
                                                    <i class="fa-brands fa-whatsapp text-white fs-10"> </i></a>
                                            </b>
                                        </div>


                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <a href="" id="gotoTambah"
                                                        class="btn btn-sm custom-btn-primary text-white hover-btn"><i
                                                            class="fa-solid fa-circle-plus text-white"></i>Tambah</a>
                                                </div>
                                                <h5 class="card-title">Daftar Program</h5>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Kode Pendaftaran</th>
                                                                <th scope="col">Nama Program</th>
                                                                <th scope="col">Kategori</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tableBody">

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

<script>
    function detail(id) {
        $('#myModal-show').modal('show');
        var url = "{{ route('siswa.show', ['id' => ':id']) }}";
        url = url.replace(':id', id);
        //membuat url dengan parameter id untuk mengarahkan ke pendaftaran_create_datas
        var url_adds = "{{ route('pendaftaran.hal_tambahbarunew', ['id' => ':id']) }}";
        url_adds = url_adds.replace(':id', id);
        // ganti attribut href pada id = gotoTambah
        $('#gotoTambah').attr('href', url_adds);
        $.ajax({
            url: url,
            type: 'GET',
            dataType: "json",
            success: function(data) {
                console.log(data);
                $('#nama_siswa').text(data.data.nama_siswa);
                $('#nama_orangtua').text(data.orangtua.nama);
                let imageUrl = "{{ asset('storage/images') }}" + "/" + data.data.foto;
                $('#gambarLihat').attr('src', imageUrl);
                let waUrl = "{{ route('siswa.wa', ['nohp' => ':id']) }}";
                waUrl = waUrl.replace(':id', data.orangtua.no_hp);
                $('#waUrl').attr('href', waUrl);
                let imageOrtua = "{{ asset('storage/images') }}" + "/" + data.orangtua.foto;
                $('#gambarOrangTua').attr('src', imageOrtua);

                // Membersihkan tabel sebelum mengisi ulang
                $('#tableBody').empty();

                for (let i = 0; i < data.program.length; i++) {
                    let row = "<tr>";
                    row += "<td>" + data.program[i].kode_pendaftaran + "</td>";
                    row += "<td>" + data.program[i].program.nama_program + "</td>";
                    row += "<td>" + data.program[i].program.kategori_program + "</td>";
                    row += "</tr>";
                    $('#tableBody').append(row);
                }






            }
        });


    }
</script>

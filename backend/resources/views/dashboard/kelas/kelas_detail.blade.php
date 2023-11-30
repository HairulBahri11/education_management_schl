@extends('dashboard/index')
@section('active_kelas', 'active')
@section('show_manajemenkelas', 'show')
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
                title: "Oops!",
                text: "{{ session('error') }}!",
                icon: "error",
                button: "OK",
            });
        </script>
    @endif



    <div class="dashboard-content px-3 pt-5">
        <div class="container">
            <div class="row mb-2">
                <div class="container">
                    <div class="col-md-5" data-aos="fade-right" data-aos-duration="1000">
                        <h2 style="font-weight: bold">{{ $data->nama_kelas }} </h2>
                        <h5>{{ $data->program->nama_program }}</h5>
                    </div>
                    <div class="col-md-5 ms-auto" data-aos="fade-left" data-aos-duration="1000">
                        <div class="float-end">
                            <a href="{{ route('kelas.hal_tambahsiswa', $data->id) }}"
                                class="btn btn-sm custom-btn-primary text-white hover-btn"><i
                                    class="fa-solid fa-circle-plus text-white"></i>Tambah Siswa</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" data-aos="fade-left" data-aos-duration="1500">
                <div class="box-content">
                    <div class="col">
                        <div class="p-3">
                            <div class="table-responsive">
                                {{-- <h5 class="fw-bold">{{ $data->nama_kelas }}</h5>
                                <h5>{{ $data->program->nama_program }}</h5> --}}
                                <table class="table table-hover" id="example">
                                    <thead class="bg-gray-100 p-1">
                                        <tr style="bg-color: black" class="mt-2">
                                            <th class="text-xs text-secondary opacity-7">Foto</th>
                                            <th class="text-xs text-secondary opacity-7">Kode Siswa</th>
                                            <th class="text-xs text-secondary opacity-7">Nama Siswa
                                            </th>
                                            <th class="text-xs text-secondary opacity-7">Gender</th>
                                            <th class="text-xs text-secondary opacity-7">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_siswa as $item)
                                            <tr>
                                                <td align-middle>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <img src="{{ asset('storage/images/' . $item->siswa->foto) }}"
                                                                width="100" height="100" alt="gambar">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-secondary opacity-7 align-middle">
                                                    <div class="user-info " align="center">
                                                        <p>{{ $item->siswa->kode_siswa }}</p>
                                                        {!! QrCode::size(50)->generate($item->siswa->kode_siswa) !!}
                                                    </div>
                                                </td>
                                                <td class="text-secondary opacity-7 align-middle">
                                                    <div class="user-info">
                                                        <p class="user-name">{{ $item->siswa->nama_siswa }}</p>
                                                    </div>
                                                </td>

                                                <td class="text-xs text-secondary opacity-7 align-middle">
                                                    @if ($item->siswa->jenis_kelamin == 'L')
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

                                                    <form
                                                        action="{{ route('kelas.siswa.destroy', ['idkelas' => $data->id, 'idsiswa' => $item->siswa->id]) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @method('DELETE')
                                                        @csrf


                                                        <button type="submit" class="btn btn-sm custom-btn-hapus hover-btn"
                                                            title="Delete" title="Hapus" data-id="{{ $item->id }}"
                                                            onclick="return confirm('apakah kamu yakin ingin menghapus data formulir?')"><i
                                                                class="fa-solid fa-trash text-white fs-10"></i></button>
                                                    </form>

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

    @endsection

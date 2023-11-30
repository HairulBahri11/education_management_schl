<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS with cdn -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Cetak Kartu</title>
    <style>
        @page {
            size: auto;
            margin: 0mm;
        }

        body {
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="container bg-light border-bottom border-end border-start">
        <div class="row p-2 " style="background-color: #122D5A">
            <div class="col-md-12" data-aos="fade-right" data-aos-duration="1000">
                <div class="text-center">
                    <h5 style="font-weight: bold" class="text-white">REPORT CARD
                    </h5>
                </div>
            </div>
        </div>

        <div class="row bg-light d-flex justify-content-between p-2" data-aos="fade-left" data-aos-duration="1500">
            <div class="col-md-6 ">
                <table>
                    <tr>
                        <td class="fw-bold">SCHOOL</td>
                        <td class="px-1">:</td>
                        <td>{{ $siswa->pendaftaran->asal_sekolah }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">STUDENT NAME</td>
                        <td class="px-1">:</td>
                        <td>{{ $siswa->nama_siswa }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">SISWA ID</td>
                        <td class="px-1">:</td>
                        <td>{{ $siswa->kode_siswa }}
                        </td>
                    </tr>

                </table>
            </div>
            <div class="col-md-6">
                <table>
                    <tr>
                        <td class="fw-bold">KELAS</td>
                        <td class="px-1">:</td>
                        <td>{{ $kelas->nama_kelas }}

                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">PROGRAM</td>
                        <td class="px-1">:</td>
                        <td>{{ $kelas->program->nama_program }} -
                            {{ $kelas->program->jeniskelas->nama_jenis_kelas }}
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">SEMESTER/YEAR</td>
                        <td class="px-1">:</td>
                        <td>{{ $raport->awal_tahun_ajaran }}/ {{ $raport->akhir_tahun_ajaran }}</td>
                    </tr>

                </table>
            </div>

        </div>
        <div class="row fw-bold text-white" style="background-color: #2F4570">
            <div class="col">
                <p class="text-center">REPORT RATING KEY</p>
            </div>
        </div>
        <div class="container  p-2">
            <table class="d-flex justify-content-between ">
                <tr>
                    <td class="fw-bold">A &nbsp: &nbsp</td>
                    <td>&nbsp Very Good &nbsp</td>
                    <td class="fw-bold">B &nbsp: &nbsp</td>
                    <td>&nbsp Good &nbsp</td>

                    <td class="fw-bold">C &nbsp: &nbsp</td>
                    <td>&nbsp Normal &nbsp</td>

                    <td class="fw-bold">D &nbsp: &nbsp</td>
                    <td>&nbsp Bad &nbsp</td>

                    <td class="fw-bold">E &nbsp : &nbsp</td>
                    <td>&nbsp Very Bad &nbsp</td>
                </tr>
            </table>
        </div>
        <div class="row fw-bold text-white" style="background-color: #2F4570">
            <div class="col">
                <p class="text-center">TOPICS AND ACTIVITIES</p>
            </div>
        </div>

        <div class="row p-1 bg-light">
            <div class="col">
                <p class="text-center">{{ $raport->topik_aktifitas }}</p>
            </div>
        </div>


        <div class="row mb-5">
            <div class="col-md-3">
                <div class=" box border-end border-bottom border-start p-2">
                    <p class="text-center fw-bold  text-white" style="background-color: #2F4570">
                        {{-- ambil detail_raport paling terakhir --}}
                        @php
                            $last_data = count($detail_raport) - 1;
                        @endphp

                        {{ $detail_raport[$last_data]->aspek->aspek_penilaian }}
                    </p>
                    <table>
                        @foreach ($data_detail_raport_index1 as $item)
                            <tr>
                                <td class="fw-bold">{{ $item->detail_aspek->nama_detail_aspek_penilaian }}</td>
                                <td class="px-1">:</td>
                                <td>{{ $item->nilai }}</td>
                                <td class="px-1">/</td>
                                <td>{{ $item->simbol_mutu }}</td>
                            </tr>
                        @endforeach

                    </table>

                </div>
            </div>
            <div class="col-md-3">
                <div class=" box border-end border-bottom border-start p-2">
                    <p class="text-center fw-bold text-white" style="background-color: #2F4570">
                        {{ $detail_raport[0]->aspek->aspek_penilaian }}</p>
                    <table>
                        @foreach ($data_detail_raport_index2 as $item)
                            <tr border = "1">
                                <td class="fw-bold">{{ $item->detail_aspek->nama_detail_aspek_penilaian }}</td>
                                <td class="px-1">:</td>
                                <td>{{ $item->nilai }}</td>
                                <td class="px-1">/</td>
                                <td>{{ $item->simbol_mutu }}</td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box border-end border-bottom border-start p-2">
                    <p class="text-center fw-bold text-white" style="background-color: #2F4570"> Comments</p>
                    <p class="justify-content-center align-items-center">
                        {{ $raport->catatan }}
                    </p>
                </div>

            </div>



        </div>

        <div class="row mb-5">
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
                <div class="text-center fw-bold">
                    <p>
                        Bejayy Center
                    </p>
                    <p>
                        Probolinggo,
                        {{ date('d M Y') }}
                    </p>

                </div>


            </div>

        </div>

        <div class="row mt-5 fw-bold">
            <div class="col-md-6">
                <p class="text-center" style="text-decoration: underline">
                    {{ $raport->pengajar->nama }} <br>
                </p>
                <p class="text-center">
                    Trainer
                </p>

            </div>
            <div class="col-md-6">
                <p class="text-center" style="text-decoration: underline">
                    Dennias Tri
                </p>
                <p class="text-center">
                    Direktur
                </p>
            </div>
        </div>
    </div>

</body>

</html>
<script>
    window.print();
</script>

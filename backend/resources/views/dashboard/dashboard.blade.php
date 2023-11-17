@extends('dashboard/index')
@section('active_dashboard', 'active')
@section('js')
    <script src="{{ $kirim['chart']->cdn() }}"></script>
    {{ $kirim['chart']->script() }}
@endsection
@section('content')

    <div class="dashboard-content px-3 pt-5">
        <div class="container">
            <div class="row mb-2">
                <div class="container">
                    <div class="col-md-8 ">
                        <h4 class="fw-bold"> Dashboard</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- buat tingginya sesuai ukuran data --}}
                <div class="col-md-8">

                    <div class="box-card-custom bg-white p-3" style="border-radius: 10px">
                        <div class="row">
                            <div class="col">
                                <div class="card border-top-0 border-start-0 border-bottom-0">
                                    <div class="card-body">
                                        <p class="card-title custom-card-title text-secondary">
                                            Total Pendapatan
                                        </p>
                                        <h5 class="card-text">Rp.
                                            {{ number_format($kirim['total_harga_bayar'], 0, ',', '.') }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card border-top-0 border-start-0 border-bottom-0">
                                    <div class="card-body">
                                        <p class="card-title custom-card-title text-secondary">
                                            Total Pengajar
                                        </p>
                                        <h5 class="card-text">{{ $kirim['frekuensi_pengajar'] }} orang</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card border-0 custom-card">
                                    <div class="card-body">
                                        <p class="card-title custom-card-title text-secondary">
                                            Total Pelajar
                                        </p>
                                        <h5 class="card-text">{{ $kirim['frekuensi_siswa'] }} orang</h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="container mt-4">
                            <div class="box-card-custom flex-fill  bg-white ">
                                <div class="col-md-12">
                                    <div class="card-body  align-items-center justify-content-center">
                                        <span> {!! $kirim['chart']->container() !!}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="box-card-custom bg-white p-2">
                        <b>
                            <p class="card-title ms-3">Pendaftaran</p>
                        </b>
                        <div class="card  border-top-0 border-start-0 border-end-0  custom-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <i class="fa fa-money-bill text-success" style="font-size: 30px"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <p class="card-title custom-card-title text-secondary" style="font-size: 12px">
                                            Sudah Bayar
                                        </p>
                                        <p class="card-text" style="font-size: 12px; font-weight: bold">
                                            {{ $kirim['frekuensi_sudahbayar'] }} orang</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card  border-top-0 border-start-0 border-end-0  custom-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <i class="fa fa-money-bill text-warning" style="font-size: 30px"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <p class="card-title custom-card-title text-secondary" style="font-size: 12px">
                                            Menunggu Konfirmasi
                                        </p>
                                        <p class="card-text" style="font-size: 12px; font-weight: bold">
                                            {{ $kirim['frekuensi_menunggukonfirmasi'] }} orang</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card  border-top-0 border-start-0 border-end-0  custom-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <i class="fa fa-money-bill text-danger" style="font-size: 30px"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <p class="card-title custom-card-title text-secondary" style="font-size: 12px">
                                            Belum Bayar
                                        </p>
                                        <p class="card-text" style="font-size: 12px; font-weight: bold">
                                            {{ $kirim['frekuensi_belumbayar'] }} orang </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card  border-top-0 border-start-0 border-end-0  custom-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <i class="fa-solid fa-crown text-info" style="font-size: 30px"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <p class="card-title custom-card-title text-secondary" style="font-size: 12px">
                                            Program Trial
                                        </p>
                                        <p class="card-text" style="font-size: 12px; font-weight: bold">
                                            {{ $kirim['trialCount'] }} orang </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card  border-top-0 border-start-0 border-end-0 border-bottom-0  custom-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <i class="fa fa-crown " style="font-size: 30px"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <p class="card-title custom-card-title text-secondary" style="font-size: 12px">
                                            Program Premium
                                        </p>
                                        <p class="card-text" style="font-size: 12px; font-weight: bold">
                                            {{ $kirim['premiumCount'] }} orang </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Other dashboard content goes here -->
            </div>
        </div>




    </div>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    {{-- sweetalert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link rel="stylesheet" href="{{ asset('landing.css') }}" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300&family=Open+Sans:ital,wght@0,400;0,600;0,700;1,600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Landing Page</title>
</head>
<style>
    .box {
        max-width: 500px;
        /* Sesuaikan dengan lebar maksimal yang Anda inginkan */
        margin: 0 auto;
        /* Untuk meletakkan elemen di tengah halaman */
    }
</style>

<body>

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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md bg-white py-3 animate__animated animate__fadeIn animate__delay-500ms">
        <div class="container">
            <a href="#" class="navbar-brand text-uppercase navbar-text-truncate">
                <img src="{{ asset('logo.png') }}" width="67" height="67" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon">
                    <i class="fas fa-bars text-primary"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav gap-3 mx-auto ">
                    <li class="nav-item"><a href="." class="nav-link active">Home</a></li>
                    <li class="nav-item"><a href="." class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="." class="nav-link">Services</a></li>
                    <li class="nav-item"><a href="." class="nav-link">About Us</a></li>
                </ul>
                <ul class="navbar-nav gap-3">
                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('storage/images/' . Auth::user()->foto) }}"
                                    class="img-thumbnail rounded-circle" width="30" height="30"
                                    alt="{{ Auth::user()->nama }}">
                                {{ Auth::user()->nama }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="userDropdown">
                                @if (Auth::user()->role == 'admin')
                                    <a class="dropdown-item" href="{{ route('dashboard') }}"> <i
                                            class="fa-solid fa-house"></i> My Dashboard</a>
                                @elseif (Auth::user()->role == 'pengajar')
                                    <a class="dropdown-item" href="{{ route('dashboard-pengajar') }}"> <i
                                            class="fa-solid fa-house"></i> My Dashboard</a>
                                @else
                                    <a class="dropdown-item" href="{{ route('pendaftaran.index.ortu') }}"> <i
                                            class="fa-solid fa-house"></i> My Dashboard</a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    @else
                        <li class="nav-item"><a href="{{ route('login') }}"
                                class="nav-link btn btn-outline-primary text-primary" style="width:100px">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}"
                                class="btn btn-primary fw-medium px-4 py-2">Register</a></li>
                    @endif
                </ul>

            </div>
        </div>
    </nav>
    <!-- endNavbar -->

    <header class="py-3">
        <div class="container ">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-md-6 order-md-1 order-2" data-aos="fade-right" data-aos-duration="1800">
                    <h1 class="align-items-center text-primary text-center text-capitalize mb-5"
                        style="font-weight: bold">Tempat Belajar Teknologi di Kota Probolinggo</h1>
                    <p class="text-secondary text-center text-capitalize">
                        Tempat belajar sambil bermain anak-anak Proboliggo dengan mengulik alat dan kemajuan ilmu
                        digital
                    </p>
                    <!-- form pencarian -->

                    <div class="btn-posisi d-flex justify-content-center gap-3 mt-3 align-items-center ">
                        <div class="btn btn-primary rounded-8" style="width: 200px">Program Trial</div>
                        <div class="btn btn-outline-primary rounded-8" style="width: 200px"> Program Premium</div>

                    </div>
                </div>
                <div class="col-md-6 order-md-2 order-1 mb-5" data-aos="fade-left" data-aos-duration="1600">
                    <div class="hero"
                        style="background-image: url({{ asset('21848852_ikkx_bvmk_210906-removebg-preview.png') }}); height: 63vh; background-size: cover; background-position: center;">


                    </div>
                    {{-- <img src="{{ asset('21848852_ikkx_bvmk_210906.jpg') }}" alt="hero" class=""
                        style=" width: 80%; max-height: 80%;"> --}}
                </div>
            </div>

        </div>
    </header>




    <section class="py-5">
        <div class="container">
            <a href="#" class="row align-items-center hero-post">
                <div class="col-md-6">
                    <img src="{{ asset('storage/images/' . $programNew->gambar) }}" alt="gmbar"
                        class="rounded-3 mb-3 hero-post-img img-fluid " data-aos="fade-up-left"
                        data-aos-duration="1800">
                </div>
                <div class="col-md-6" data-aos="fade-up-left" data-aos-duration="1800">
                    <span class="bg-light rounded p-2 fw-bold text-primary category">Program Terbaru</span>
                    <h2 class="hero-post-title text-primary text-capitalize mt-3">
                        {{ $programNew->nama_program }}</h2>
                    <div class="text-right text-secondary"
                        style="max-height: 400px; overflow: hidden; text-overflow: ellipsis; text-align: justify">
                        {!! $programNew->deskripsi !!}
                    </div>
                    <div class="d-flex align-items-center gap-3">

                        <div class="profile">


                            @if ($programNew->harga == 0)
                                <span class="bg-success rounded p-2 text-light category me-auto">Gratis</span>
                            @else
                                <span class="text-primary rounded p-2 fw-bold category me-auto">Rp.
                                    {{ number_format($programNew->harga, 0, ',', '.') }}</span>
                            @endif
                            <span class="bg-secondary rounded p-2 text-light category">
                                {{ $programNew->kategori_program }} |
                                {{ $programNew->jeniskelas->nama_jenis_kelas }}</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </section>

    <!-- Section card post2 -->

    <section class="py-1">

        <div class="container">
            <div class="row">
                <div class="col animate__animated animate__fadeInUp animate__delay-700ms">
                    <h5 class="fw-bold text-primary">Program Trial
                        <span
                            style="background-color: green; color: white; padding: 10px; border-radius:8px; margin-left: 10px;font-size: 12px">
                            <i>Gratis</i></span>
                    </h5>
                </div>
                <div class="col text-end animate__animated animate__fadeInUp animate__delay-700ms">
                    <span data-bs-toggle="modal" data-bs-target="#myModal-all-trial"
                        class="btn btn-outline-success text-primary gap-3" style="border-radius:8px"> Lihat
                        Semua</span>
                </div>
            </div>
        </div>

    </section>

    <section class="py-5">
        <div class="container">
            <div class="row ">
                @foreach ($trial_program as $ap)
                    <div class="col-md-4 " data-aos="fade-down" data-aos-duration="1800">
                        <span class="card card-post border-3 rounded-3 mb-3">
                            <img src="{{ asset('storage/images/' . $ap->gambar) }}" alt=""
                                class="card-img-top" width="100%" height="250">
                            <div class="card-body">
                                <span class="bg-light rounded p-2 text-primary category me-auto">
                                    {{ $ap->kategori_program }} | {{ $ap->jeniskelas->nama_jenis_kelas }}</span>

                                <h2 class="card-post-title text-primary text-capitalize mt-3">{{ $ap->nama_program }}
                                </h2>
                                <div class="text-right text-secondary"
                                    style="max-height: 100px; overflow: hidden; text-overflow: ellipsis; text-align: justify">
                                    {!! $ap->deskripsi !!}
                                </div>
                                <div class="price mt-1">
                                    @if ($ap->harga == 0)
                                        <span class="text-primary me-auto fw-bold">Gratis</span>
                                    @else
                                        <span class="text-primary me-auto fw-bold">Rp.
                                            {{ number_format($ap->harga, 0, ',', '.') }} / {{ $ap->durasi }}</span>
                                    @endif

                                </div>

                                <div class="btn btn-primary form-control mt-2"
                                    onclick="detail({{ $ap->id }},
                                       '{{ $ap->nama_program }}',
                                       '{{ $ap->deskripsi }}',
                                       '{{ $ap->gambar }}',
                                       '{{ $ap->harga }}',
                                       '{{ $ap->durasi }}',
                                       '{{ $ap->kategori_program }}',
                                       '{{ $ap->jeniskelas->nama_jenis_kelas }}')";
                                    title="View"> Detail Program</div>
                                {{-- <a href="#" class="btn btn-primary form-control"> Detail Program </a> --}}

                            </div>
                        </span>
                    </div>
                @endforeach
                <!-- Sisanya juga diberikan perubahan yang serupa -->
            </div>

        </div>
    </section>

    <section class="py-3">

        <div class="container">
            <div class="row ">
                <div class="col animate__animated animate__fadeIn animate__delay-800ms">
                    <h5 class="fw-bold text-primary">Program Premium
                        <span
                            style="background-color: gold; color: white; padding: 10px; border-radius:8px; margin-left: 10px;font-size: 12px">
                            <i>Berbayar</i></span>
                    </h5>
                </div>
                <div class="col text-end animate__animated animate__fadeIn animate__delay-800ms">
                    <span data-bs-toggle="modal" data-bs-target="#myModal-all-premium"
                        class="btn btn-outline-warning text-primary gap-3" style="border-radius:8px"> Lihat
                        Semua</span>
                </div>
            </div>
        </div>
    </section>
    {{-- modal all program Trial --}}
    {{-- modal all program trial --}}
    <section>
        <div class="modal fade" id="myModal-all-trial">
            <div class="modal-dialog modal-xl" id="myModal-all-trian">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Trial Program</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-all-trial"></button>
                    </div>
                    <div class="modal-body mt-3">
                        <div class="container">

                            <div class="row ">
                                @foreach ($all_trial_program as $ap)
                                    <div class="col-md-4 p-2" data-aos="fade-down" data-aos-duration="1800">
                                        <a href="#" class="card card-post border-0 rounded-3 mb-3">
                                            <img src="{{ asset('storage/images/' . $ap->gambar) }}" alt=""
                                                class="card-img-top" width="100%" height="250">
                                            <div class="card-body">
                                                <span class="bg-light rounded p-2 text-primary category me-auto">
                                                    {{ $ap->kategori_program }} |
                                                    {{ $ap->jeniskelas->nama_jenis_kelas }}</span>

                                                <h2 class="card-post-title text-primary text-capitalize mt-3">
                                                    {{ $ap->nama_program }}
                                                </h2>
                                                <div class="text-right text-secondary"
                                                    style="max-height: 20px; overflow: hidden; text-overflow: ellipsis; text-align: justify">
                                                    {!! $ap->deskripsi !!}
                                                </div>
                                                <div class="price mt-1">
                                                    @if ($ap->harga == 0)
                                                        <span class="text-primary me-auto fw-bold">Gratis</span>
                                                    @else
                                                        <span class="text-primary me-auto fw-bold">Rp.
                                                            {{ number_format($ap->harga, 0, ',', '.') }} /
                                                            {{ $ap->durasi }}</span>
                                                    @endif

                                                </div>

                                                <div class="btn btn-primary form-control mt-2"
                                                    onclick="detail({{ $ap->id }},
                                                   '{{ $ap->nama_program }}',
                                                   '{{ $ap->deskripsi }}',
                                                   '{{ $ap->gambar }}',
                                                   '{{ $ap->harga }}',
                                                   '{{ $ap->durasi }}',
                                                   '{{ $ap->kategori_program }}',
                                                   '{{ $ap->jeniskelas->nama_jenis_kelas }}')";
                                                    title="View"> Detail Program</div>

                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="py-5">
        <div class="container">
            <div class="row">
                @foreach ($premium_program as $ap)
                    <div class="col-md-4 " data-aos="fade-down" data-aos-duration="1800">
                        <a href="#" class="card card-post border-3 rounded-3 mb-3">
                            <img src="{{ asset('storage/images/' . $ap->gambar) }}" alt=""
                                class="card-img-top" width="100%" height="250">
                            <div class="card-body">
                                <span class="bg-light rounded p-2 text-primary category me-auto">
                                    {{ $ap->kategori_program }} | {{ $ap->jeniskelas->nama_jenis_kelas }}</span>

                                <h2 class="card-post-title text-primary text-capitalize mt-3">{{ $ap->nama_program }}
                                </h2>
                                <div class="text-right text-secondary"
                                    style="max-height: 100px; overflow: hidden; text-overflow: ellipsis; text-align: justify">
                                    {!! $ap->deskripsi !!}
                                </div>
                                <div class="price mt-1">
                                    @if ($ap->harga == 0)
                                        <span class="text-primary me-auto fw-bold">Gratis</span>
                                    @else
                                        <span class="text-primary me-auto fw-bold">Rp.
                                            {{ number_format($ap->harga, 0, ',', '.') }} / {{ $ap->durasi }}</span>
                                    @endif

                                </div>

                                <div class="btn btn-primary form-control mt-2"
                                    onclick="detail({{ $ap->id }},
                                       '{{ $ap->nama_program }}',
                                       '{{ $ap->deskripsi }}',
                                       '{{ $ap->gambar }}',
                                       '{{ $ap->harga }}',
                                       '{{ $ap->durasi }}',
                                       '{{ $ap->kategori_program }}',
                                       '{{ $ap->jeniskelas->nama_jenis_kelas }}')";
                                    title="View"> Detail Program</div>

                            </div>
                        </a>
                    </div>
                @endforeach
                <!-- Sisanya juga diberikan perubahan yang serupa -->
            </div>
        </div>
    </section>
    {{-- modal all program premium --}}
    <section>
        <div class="modal fade" id="myModal-all-premium">
            <div class="modal-dialog modal-xl" id="myModal-all-premium">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Premium Program</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-all-premium"></button>
                    </div>
                    <div class="modal-body mt-3">
                        <div class="container">

                            <div class="row">
                                @foreach ($all_premium_program as $ap)
                                    <div class="col-md-4" data-aos="fade-down" data-aos-duration="1800">
                                        <a href="#" class="card card-post border-3 rounded-3 mb-3">
                                            <img src="{{ asset('storage/images/' . $ap->gambar) }}" alt=""
                                                class="card-img-top" width="100%" height="250">
                                            <div class="card-body">
                                                <span class="bg-light rounded p-2 text-primary category me-auto">
                                                    {{ $ap->kategori_program }} |
                                                    {{ $ap->jeniskelas->nama_jenis_kelas }}</span>

                                                <h2 class="card-post-title text-primary text-capitalize mt-3">
                                                    {{ $ap->nama_program }}
                                                </h2>
                                                <div class="text-right text-secondary"
                                                    style="max-height: 50px; overflow: hidden; text-overflow: ellipsis; text-align: justify">
                                                    {!! $ap->deskripsi !!}
                                                </div>
                                                <div class="price mt-1">
                                                    @if ($ap->harga == 0)
                                                        <span class="text-primary me-auto fw-bold">Gratis</span>
                                                    @else
                                                        <span class="text-primary me-auto fw-bold">Rp.
                                                            {{ number_format($ap->harga, 0, ',', '.') }} /
                                                            {{ $ap->durasi }}</span>
                                                    @endif

                                                </div>

                                                <div class="btn btn-primary form-control mt-2"
                                                    onclick="detail({{ $ap->id }},
                                       '{{ $ap->nama_program }}',
                                       '{{ $ap->deskripsi }}',
                                       '{{ $ap->gambar }}',
                                       '{{ $ap->harga }}',
                                       '{{ $ap->durasi }}',
                                       '{{ $ap->kategori_program }}',
                                       '{{ $ap->jeniskelas->nama_jenis_kelas }}')";
                                                    title="View"> Detail Program</div>

                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section id="sejak_dini" class="py-5">
        <div class="container">
            <div class="box text-center justify-content-center align-items-center" data-aos="fade-down"
                data-aos-duration="1200">
                <h1 class="text-primary text-capitalize mb-5" style="font-weight: bold;">Kenapa Perlu Belajar Digital
                    Sejak Dini?</h1>
                <p class="text-secondary text-capitalize">
                    Tempat belajar sambil bermain anak-anak Proboliggo dengan mengulik alat dan kemajuan ilmu digital
                </p>
            </div>

            <!-- form pencarian -->
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="box-card-custom">
                        <div class="card mb-3 border-0 bg-light" style="max-width: 500px;">
                            <div class="row g-0">
                                <div class="col-md-12">
                                    <div class="card-body  text-center justify-content-center align-items-center"
                                        data-aos="fade-up" data-aos-duration="800">
                                        <div class="icon-box mb-3">
                                            {{-- <i class="fa-regular fa-user"></i> --}}
                                            {{-- <i class="fa-solid fa-microchip"></i> --}}
                                            <i class="fa-regular fa-user" style="font-size: 50px"></i>
                                        </div>

                                        <h5 class="card-title fw-bold">Masa depan teknologi</h5>
                                        <p class="card-text text-secondary">
                                            Belajar Menyenangkan sambil bermain untuk anak-anak di Proboliggo dengan
                                            mengulik alat
                                            dan kemajuan ilmu digital
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 2 --}}
                <div class="col-md-4">
                    <div class="box-card-custom">
                        <div class="card mb-3 border-0 bg-light" style="max-width: 500px;">
                            <div class="row g-0">
                                <div class="col-md-12">
                                    <div class="card-body  text-center justify-content-center align-items-center"
                                        data-aos="fade-up" data-aos-duration="1200">
                                        <div class="icon-box mb-3">
                                            {{-- <i class="fa-solid fa-pen-nib"></i> --}}
                                            <i class="fa-solid fa-pen-nib" style="font-size: 50px"></i>
                                        </div>

                                        <h5 class="card-title fw-bold">Adaptable / Up to date</h5>
                                        <p class="card-text text-secondary">
                                            Berdaptasi dengan perkembangan teknologi terkini. Terbuka pada kemajuan
                                            teknologi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 3 --}}
                <div class="col-md-4">
                    <div class="box-card-custom">
                        <div class="card mb-3 border-0 bg-light" style="max-width: 500px;">
                            <div class="row g-0">
                                <div class="col-md-12">
                                    <div class="card-body  text-center justify-content-center align-items-center"
                                        data-aos="fade-up" data-aos-duration="1600">
                                        <div class="icon-box mb-3">
                                            {{-- <i class="fa-solid fa-microchip"></i> --}}
                                            <i class="fa-solid fa-microchip" style="font-size: 50px"></i>
                                        </div>

                                        <h5 class="card-title fw-bold">Masa depan teknologi</h5>
                                        <p class="card-text text-secondary">
                                            Tempat belajar sambil bermain anak-anak Proboliggo dengan mengulik alat
                                            dan kemajuan ilmu digital
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="box-card-custom">
                        <div class="card mb-3 border-0 bg-light" style="max-width: 500px;">
                            <div class="row g-0">
                                <div class="col-md-12">
                                    <div class="card-body  text-center justify-content-center align-items-center"
                                        data-aos="fade-up" data-aos-duration="2000">
                                        <div class="icon-box mb-3">
                                            <i class="fa-solid fa-book text-primary" style="font-size: 50px"></i>
                                        </div>

                                        <h5 class="card-title fw-bold">Melatih multibahasa</h5>
                                        <p class="card-text text-secondary">
                                            Tersedia tempat belajar multibahasa seperti mandarin dan bahasa inggris.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 2 --}}
                <div class="col-md-4">
                    <div class="box-card-custom">
                        <div class="card mb-3 border-0 bg-light" style="max-width: 500px;">
                            <div class="row g-0">
                                <div class="col-md-12">
                                    <div class="card-body  text-center justify-content-center align-items-center"
                                        data-aos="fade-up" data-aos-duration="2400">
                                        <div class="icon-box mb-3">
                                            {{-- <i class="fa-brands fa-resolving"></i> --}}
                                            <i class="fa-brands fa-resolving" style="font-size: 50px"></i>
                                        </div>

                                        <h5 class="card-title fw-bold">Problem solving</h5>
                                        <p class="card-text text-secondary">
                                            Melatih kemampuan dengan mencetak karakter problem solving.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 3 --}}
                <div class="col-md-4">
                    <div class="box-card-custom ">
                        <div class="card mb-3 border-0 bg-light " style="max-width: 500px;">
                            <div class="row g-0">
                                <div class="col-md-12">
                                    <div class="card-body  text-center justify-content-center align-items-center"
                                        data-aos="fade-up" data-aos-duration="2800">
                                        <div class="icon-box mb-3">
                                            <i class="fa-solid fa-brain text-primary" style="font-size: 50px"></i>
                                        </div>

                                        <h5 class="card-title fw-bold">Structural thinking</h5>
                                        <p class="card-text text-secondary">
                                            Develop anak-anak Probolinggo dengan mengolah berfikir secara struktural
                                            thinking sejak dini.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    {{-- detailprogram --}}
    <section>
        <div class="modal fade" id="myModal-detail">
            <div class="modal-dialog modal-xl" id="myModal-detail">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Program</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close"></button>
                    </div>
                    <div class="modal-body mt-3">
                        <div class="container">
                            <span class="card card-post border-0 rounded-3 mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="" id="gambar_detail" alt="" class="img-fluid"
                                            style=" width: 100%; max-height: 1000px;">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <span id="kategori_program_detail"
                                                        class="bg-light rounded p-2 text-primary category me-auto"></span>
                                                </div>
                                                <div class="col text-end">
                                                    <span id="harga_detail" class="text-primary fw-bold"></span>
                                                </div>
                                            </div>
                                            <h2 id="namaprogram_detail"
                                                class="card-post-title text-primary text-capitalize mt-3">

                                            </h2>
                                            <div class="text-right text-secondary" id="deskripsi_detail"
                                                style=" text-align: justify">
                                            </div>

                                            <span class="btn btn-primary mt-3" id="daftar"> Daftar
                                                Sekarang</span>
                                        </div>
                                    </div>
                                </div>
                            </span>



                            {{-- daftar program --}}
                            <section>
                                <div class="row mb-3" id="daftar_program" style="display: none">

                                    <div class="box-content">
                                        <div class="col bg-white">
                                            <div class="p-5">
                                                <form action="{{ route('pendaftaran-create-ortu') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="div-left">
                                                                <h2
                                                                    class="card-post-title text-primary text-capitalize mt-3 fw-bold">
                                                                    Form Pendaftaran
                                                                </h2>
                                                                <p>Periksa danisilah data dengan benar</p>
                                                            </div>
                                                            <div class="col-md-12">
                                                                @if (Auth::check())
                                                                    <input type="text"
                                                                        value="{{ Auth::user()->id }}"
                                                                        name="id_orangtua" hidden>
                                                                @endif
                                                                <input type="text" name="id_program"
                                                                    id="id_programnya" hidden>
                                                                <div class="mb-3">
                                                                    <label for="exampleFormControlTextarea1"
                                                                        class="form-label">Nama Anak</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nama_anak" id="harga"
                                                                        placeholder="joko">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleFormControlTextarea1"
                                                                        class="form-label">Asal Sekolah</label>
                                                                    <input type="text" class="form-control"
                                                                        name="asal_sekolah" id="harga"
                                                                        placeholder="Smpn 1 kertosono">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleFormControlTextarea1"
                                                                        id="label_bp_premium" class="form-label">Bukti
                                                                        Pembayaran</label>
                                                                    <input type="file" name="bukti_pembayaran"
                                                                        class="form-control"
                                                                        id="bukti_pembayaran_premium">
                                                                </div>


                                                                <button type="submit" class="btn btn-primary mt-3"
                                                                    id="btn_daftar"> Daftar
                                                                    Sekarang</button>

                                                            </div>

                                                        </div>
                                                        <div class="col text-end">
                                                            <div class="div-right">
                                                                <h2
                                                                    class="card-post-title text-primary text-capitalize mt-3 fw-bold">
                                                                    Informasi Pembayaran
                                                                </h2>
                                                                <p>Pilih salah satu jenis pembayaran</p>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="mb-3 d-none">
                                                                    <label for="exampleFormControlInput1"
                                                                        id="label_sp_premium"
                                                                        class="form-label">Status
                                                                        Pembayaran</label>
                                                                    <select name="status_pembayaran"
                                                                        class="form-control"
                                                                        id="status_pembayaran_premium">
                                                                        <option value="Menunggu-Konfirmasi"
                                                                            class="form-control">Menunggu Konfirmasi
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                                {{-- Informasi Pembayaran --}}
                                                                <div class="row">
                                                                    <div class="card border-0">
                                                                        <div class="card-body border-0">
                                                                            <div
                                                                                class="d-flex justify-content-center align-items-center">
                                                                                <div class="col text-end">
                                                                                    <img src="{{ asset('storage/images/bri.png') }}"
                                                                                        id="" alt=""
                                                                                        style="width: auto; height: 80px">
                                                                                </div>
                                                                                <div class="col text-center">
                                                                                    <h5
                                                                                        class="text-primary text-capitalize fw-bold">
                                                                                        No Rek. 123456789</h5>
                                                                                    <p class="text-secondary">Admin
                                                                                        Center
                                                                                        Bejay</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card border-0">
                                                                        <div class="card-body border-0">
                                                                            <div
                                                                                class="d-flex justify-content-center align-items-center">
                                                                                <div class="col text-end">
                                                                                    <img src="{{ asset('storage/images/mandiri.png') }}"
                                                                                        id="" alt=""
                                                                                        style="width: auto; height: 80px">
                                                                                </div>
                                                                                <div class="col text-center">
                                                                                    <h5
                                                                                        class="text-primary text-capitalize fw-bold">
                                                                                        No Rek. 123456789</h5>
                                                                                    <p class="text-secondary">Admin
                                                                                        Center
                                                                                        Bejay</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card border-0">
                                                                        <div class="card-body border-0">
                                                                            <div
                                                                                class="d-flex justify-content-center align-items-center">
                                                                                <div class="col text-end">
                                                                                    <img src="{{ asset('storage/images/bca.png') }}"
                                                                                        id="" alt=""
                                                                                        style="width: auto; height: 80px">
                                                                                </div>
                                                                                <div class="col text-center">
                                                                                    <h5
                                                                                        class="text-primary text-capitalize fw-bold">
                                                                                        No Rek. 123456789</h5>
                                                                                    <p class="text-secondary">Admin
                                                                                        Center
                                                                                        Bejay</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                            </div>

                                                        </div>
                                                    </div>

                                                </form>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </section>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>



    <section>
        <div class="container mt-5 ">
            <div
                class="box text-center justify-content-center align-items-center py-5 animate__animated animate__fadeInUp animate__delay-800ms">
                <h1 class="text-primary text-capitalize mb-5" style="font-weight: bold;">Konsultasikan Program & Kelas
                    Untuk Anak Bersama Kami</h1>
                <div class="btn-posisi d-flex justify-content-center gap-3 mt-3 align-items-center ">
                    <div class="btn btn-primary rounded-8" style="width: 200px">Konsultasi Sekarang</div>
                </div>
            </div>
        </div>

    </section>




    <footer class="py-5">
        <div class="container">
            <hr class="mb-3">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-4">
                    <ul
                        class="list-unstyled d-flex align-items-center justify-content-center justify-content-md-start gap-3 mb-3 mb-md-0">
                        <li><a href="#" class="text-primary">Home</a></li>
                        <li><a href="#" class="text-primary">Services</a></li>
                        <li><a href="#" class="text-primary">About Us</a></li>
                        <li><a href="#" class="text-primary">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <a href="#" class="text-primary fw-bolder fs-4 text-uppercase text-center d-block">
                        <img src="{{ asset('logo.png') }}" alt="logo">
                    </a>
                </div>
                <div class="col-md-4">
                    <p class="m-0 text-secondary text-center text-md-end">&copy; 2023. All Right Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        function detail(id, namaprogram, deskripsi, gambar, harga, durasi, kategori_program, jeniskelas) {
            $('#close-all-premium').click();
            $('#close-all-trial').click();
            $('#myModal-detail').modal('show');
            $('#namaprogram_detail').text(namaprogram);
            // Assuming deskripsi contains HTML content
            let deskripsiText = deskripsi.replace(/^(<p>)+|(<p>)+$/g, '');
            deskripsiText = deskripsiText.replace(/(?:\r\n|\r|\n)/g, '<br>');

            $('#deskripsi_detail').html(deskripsiText);
            // $('#id_programnya').text(id);
            let id_program = id;
            $('#id_programnya').val(id_program);






            // $('#deskripsi_detail').text(deskripsiText);
            let src = "{{ asset('storage/images') }}" + "/" + gambar;
            $('#gambar_detail').attr('src', src);
            let hargaFormat = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(harga);
            $('#harga_detail').text(hargaFormat);

            $('#durasi_detail').text(durasi);
            $('#kategori_program_detail').text(kategori_program + "|" + jeniskelas);

            if (kategori_program == "Trial") {

                $('#status_pembayaran_premium').css('display', 'none');
                $('#bukti_pembayaran_premium').css('display', 'none');
                $('#label_bp_premium').css('display', 'none');
                $('#label_sp_premium').css('display', 'none');
            } else {
                $('#status_pembayaran_premium').css('display', 'block');
                $('#bukti_pembayaran_premium').css('display', 'block');
                $('#label_bp_premium').css('display', 'block');
                $('#label_sp_premium').css('display', 'block');
            }
        }

        // jika close modal diklik
        $('#close').click(function() {
            $('#myModal-detail').modal('hide');
            $('#daftar_program').css('display', 'none');
            $('#daftar').css('display', 'block');
        });


        $('#daftar').click(function() {
            $('#daftar_program').css('display', 'block');
            $('#daftar').css('display', 'none');
        });
    </script>

</body>

</html>

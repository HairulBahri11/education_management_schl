<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS with cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('style.css') }}" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300&family=Open+Sans:ital,wght@0,400;0,600;0,700;1,600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
    <title>Admin Sidebar</title>

</head>

<body>

    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-4 pt-3 pb-2 d-flex justify-content-between" style="background-color: white;">
                {{-- <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2 py-1">ED</span> <span
                        class="" style="color: #284a5e">Education.Io</span></h1> --}}
                <img src="{{ asset('logo.png') }}" height="38px" class=" px-3" alt="">
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i
                        class="fal fa-stream"></i></button>
            </div>

            <span class="menu-icon d-none d-block mt-5">
            </span>
            <ul class="list-unstyled px-3">

                <span class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"
                        style="color: #f9f9f9;">Menu</a></span>

                @if (Auth::user()->role == 'admin')
                    <li class="@yield('active_dashboard')"><a href="{{ route('dashboard') }}"
                            class="text-decoration-none px-3 py-2 d-block "><i
                                class="fa-solid fa-house"></i>Dashboard</a>
                    </li>
                @else
                    <li class="@yield('active_dashboard')"><a href="{{ route('dashboard-ortu') }}"
                            class="text-decoration-none px-3 py-2 d-block "><i
                                class="fa-solid fa-house"></i>Dashboard</a>
                    </li>
                @endif

                @if (Auth::user()->role == 'orangtua')
                    <li class="@yield('active_pendaftaran')"><a href="{{ route('pendaftaran.index.ortu') }}"
                            class="text-decoration-none px-3 py-2 d-block "><i
                                class="fa-solid fa-landmark"></i>Pendaftaran</a>
                @endif


                </li>
                @if (Auth::user()->role == 'admin')
                    <li class="@yield('active_pengajar')"><a href="{{ route('pengajar') }}"
                            class="text-decoration-none px-3 py-2 d-block"><i
                                class="fa-solid fa-chalkboard-user"></i>Pengajar</a></li>
                    {{-- make dropdown sidebar --}}

                    <span class="mb-1">
                        <a href="#" class="d-flex align-items-start px-3 py-2 text-decoration-none"
                            style="color: #284a5e;" data-bs-toggle="collapse" data-bs-target="#home-collapse"
                            aria-expanded="true">
                            <i class="fa-solid fa-landmark" style=" padding-right: 19px;"></i>
                            Manajemen Program
                            <i class="fa-solid fa-angle-down ms-auto"></i>

                        </a>
                        <div class="collapse @yield('show_manajemenprogram') " id="home-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-5">
                                <li class="@yield('active_program')"><a href="{{ route('program.index') }}"
                                        class="text-decoration-none px-3 py-2 d-block"></i>Program</a>
                                </li>
                                <li class="@yield('active_petugas')"><a href="{{ route('petugas.index') }}"
                                        class="text-decoration-none px-3 py-2 d-block">Petugas</a></li>
                                <li class="@yield('active_ruangan')"><a href="{{ route('ruangan.index') }}"
                                        class="text-decoration-none px-3 py-2 d-block">Ruangan</a></li>

                            </ul>
                        </div>

                    </span>
                    <span class="mb-1">
                        <a href="#" class="d-flex align-items-center px-3 py-2 text-decoration-none"
                            style="color: #284a5e;" data-bs-toggle="collapse" data-bs-target="#man-siswa-collapse"
                            aria-expanded="true">
                            <i class="fa-solid fa-users" style="padding-right: 16px"></i>
                            Manajemen Siswa
                            <i class="fa-solid fa-angle-down ms-auto"></i>
                        </a>

                        <div class="collapse @yield('show_manajemensiswa') " id="man-siswa-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-5">
                                <li class="@yield('active_orangtua')"><a href="{{ route('orangtua.index') }}"
                                        class="text-decoration-none px-3 py-2 d-block"></i>Orang Tua</a>
                                </li>
                            </ul>
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-5">
                                <li class="@yield('active_pendaftaran')"><a href="{{ route('pendaftaran.index') }}"
                                        class="text-decoration-none px-3 py-2 d-block"></i>Pendaftaran</a>
                                </li>
                            </ul>
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-5">
                                <li class="@yield('active_siswa')"><a href="{{ route('siswa.index') }}"
                                        class="text-decoration-none px-3 py-2 d-block"></i>Siswa</a>
                                </li>
                            </ul>
                        </div>
                    </span>
                    <span class="mb-1">
                        <a href="#" class="d-flex align-items-center px-3 py-2 text-decoration-none"
                            style="color: #284a5e;" data-bs-toggle="collapse" data-bs-target="#man-kelas-collapse"
                            aria-expanded="true">
                            <i class="fa-solid fa-shop" style="padding-right: 16px"></i>

                            Manajemen Kelas
                            <i class="fa-solid fa-angle-down ms-auto"></i>
                        </a>

                        <div class="collapse @yield('show_manajemenkelas') " id="man-kelas-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-5">

                                <li class="@yield('active_kelas')"><a href="{{ route('kelas.index') }}"
                                        class="text-decoration-none px-3 py-2 d-block">Kelas</a></li>
                                <li class="@yield('active_jadwalkelas')"><a href="{{ route('jadwalpremium.index') }}"
                                        class="text-decoration-none px-3 py-2 d-block">Jadwal Kelas</a>
                                </li>
                                <li class="@yield('active_jadwaltrial')"><a href="{{ route('jadwaltrial.index') }}"
                                        class="text-decoration-none px-3 py-2 d-block">Jadwal Trial</a>
                                </li>
                            </ul>
                        </div>
                    </span>
                @endif
                <li class="@yield('active_absensi')"><a href="{{ route('absensi.index') }}"
                        class="text-decoration-none px-3 py-1 d-block "><i
                            class="fa-regular fa-calendar-check fs-5"></i>Kehadiran</a>
                </li>

            </ul>
            <hr class="h-color mx-2">

            {{-- <ul class="list-unstyled px-2">
                <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-bars"></i> Settings</a></li>
                <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-bell"></i> Notifications</a></li>
            </ul> --}}
        </div>

        <div class="content">
            <nav class="navbar navbar-expand-md">

                <div class="container-fluid px-5">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2"><i class="fal fa-stream"></i></button>
                        <a class="navbar-brand fs-4" href="#"><span
                                class="bg-dark rounded px-2 py-0 text-white">BJ</span></a>
                    </div>

                    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fal fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            @if (Auth::check())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <span class="px-2">{{ Auth::user()->nama }}</span>

                                        <img src="{{ asset('storage/images/' . Auth::user()->foto) }}"
                                            class="img-thumbnail rounded-circle" width="30" height="30"
                                            alt="{{ Auth::user()->nama }}">
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                                        <a class="dropdown-item text-sm" href="{{ route('landingpage') }}">
                                            <i class="fa-solid fa-house"></i> Home
                                        </a>
                                        <a class="dropdown-item text-sm" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>

                                </li>
                            @else
                                <li class="nav-item"><a href="{{ route('login') }}"
                                        class="nav-link btn btn-outline-primary text-primary">Login</a></li>
                                <li class="nav-item"><a href="{{ route('register') }}"
                                        class="btn btn-primary fw-medium px-4 py-2">Register</a></li>
                            @endif
                        </ul>
                    </div>
                    {{-- <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" style="color: #284a5e" aria-current="page" href="#"><i
                                        class="fas fa-search"></i> Search</a>
                            </li>

                            @if (Auth::check())
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-decoration-none text-dark">
                                        <img src="{{ asset('storage/images/' . Auth::user()->foto) }}"
                                            class="img-thumbnail rounded-circle" width="30" height="30"
                                            alt="{{ Auth::user()->nama }}">
                                        {{ Auth::user()->nama }}

                                    </a>
                                </li>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn custom-btn-hapus btn-sm hover-btn text-white"
                                        title="Logout"><i class="fa-solid fa-arrow-right-from-bracket text-white"></i>
                                    </button>
                                </form>
                            @else
                                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                                <li class="nav-item"><a href="{{ route('register') }}"
                                        class="btn btn-primary rounded-pill fw-medium px-4 py-2">Register</a></li>
                            @endif


                        </ul>
                    </div> --}}
                </div>

            </nav>

            @yield('content')
        </div>
    </div>


    @yield('js')



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="{{ asset('datatables.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"
        integrity="sha512-Ixzuzfxv1EqafeQlTCufWfaC6ful6WFqIz4G+dWvK0beHw0NVJwvCKSgafpy5gwNqKmgUfIBraVwkKI+Cz0SEQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(".sidebar ul li").on('click', function() {
            $(".sidebar ul li.active").removeClass('active');
            $(this).addClass('active');
        });

        $('.open-btn').on('click', function() {
            $('.sidebar').addClass('active');
        });
        $('.close-btn').on('click', function() {
            $('.sidebar').removeClass('active');
        });

        let datatable = $('#example').DataTable({
            "order": [
                [0, "asc"]
            ], // Contoh pengurutan kolom pertama secara ascending
            "ordering": false // Menonaktifkan pengurutan otomatis
        });

        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>

</body>

</html>

{{-- js --}}
@stack('js')

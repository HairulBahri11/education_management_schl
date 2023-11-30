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
    {{-- <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet"> --}}

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <title>Landing Page</title>
</head>
<style>
    .box {
        max-width: 500px;
        /* Sesuaikan dengan lebar maksimal yang Anda inginkan */
        margin: 0 auto;
        /* Untuk meletakkan elemen di tengah halaman */
    }

    .breadcrumb {
        background-color: #f8f9fa;
        padding: 8px 15px;
        border-radius: 4px;
        margin-top: 20px;
    }

    .breadcrumb-item {
        font-size: 14px;
        color: #6c757d;
    }

    .breadcrumb-item.active {
        color: #122d5a;
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
    <nav class="navbar navbar-expand-md bg-white py-3 ">
        <div class="container">
            <a href="#" class="navbar-brand text-uppercase navbar-text-truncate ">
                <img src="{{ asset('logo.png') }}" width="67" height="67" alt="logo" class="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon">
                    <i class="fas fa-bars text-primary"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav gap-1 ms-auto ">
                    <li class="nav-item"><a href="{{ route('landingpage') }}" class="nav-link ">Home</a></li>

                    <li class="nav-item"><a href="." class="nav-link active">Dashboard</a></li>
                </ul>
                <ul class="navbar-nav gap-3 ms-auto">
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

    <header class="py-3 mt-5">
        <div class="container mb-5">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-md-6 order-md-1 order-2" data-aos="fade-right" data-aos-duration="1600">
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

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">

                @yield('breadcrumb')

            </ol>
        </nav>
    </div>
    @yield('content')


</body>

</html>
<script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    let datatable = $('#example').DataTable({
        "order": [
            [0, "asc"]
        ], // Contoh pengurutan kolom pertama secara ascending
        "ordering": false // Menonaktifkan pengurutan otomatis
    });
</script>
<script>
    AOS.init();
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sidebar</title>
    <!--Fonts Google makai Ubuntu-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- My Style-->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <style>
        .active{
            background-color: #FF9900;
        }
    </style>
</head>
<body>
    <div class="container-a">
        <div class="sidebar">
            <div class="header">
                <div class="list-item">
                    <a href="#">
                        {{-- <img src="{{ asset('assets/Youtube.png') }}" alt="" class="icon"> --}}
                        <span class="description-header">School Management</span>
                    </a>
                </div>
                <div class="illustration">
                    <img src="{{ asset('assets/Ilustration.png') }}" alt="">
                </div>
            </div>
            <div class="main">
                <div class="list-item active" >
                    <a href="#">
                        <img src="{{ asset('assets/Dashboard.png') }}" alt="" class="icon">
                        <span class="description">Dashboard</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img src="{{ asset('assets/Analytics.png') }}" alt="" class="icon">
                        <span class="description">Analytics</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img src="{{ asset('assets/Category.png') }}" alt="" class="icon">
                        <span class="description">Category</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img src="{{ asset('assets/Team.png') }}" alt="" class="icon">
                        <span class="description">Team</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img src="{{ asset('assets/Events.png') }}" alt="" class="icon">
                        <span class="description">Event</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img src="{{ asset('assets/Explore.png') }}" alt="" class="icon">
                        <span class="description">Explore</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img src="{{ asset('assets/History.png') }}" alt="" class="icon">
                        <span class="description">History</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img src="{{ asset('assets/Settings.png') }}" alt="" class="icon">
                        <span class="description">Setting</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="main-content">
            {{-- <div id="menu-button">
                <input type="checkbox" id="menu-checkbox">
                <label for="menu-checkbox" id="menu-label">
                    <div id="hamburger-a"></div>
                </label>
            </div> --}}
            <div class="header" style="background-color:#111827">
                <div class="row" style="align-items: center">
                    <div class="col ms-3">
                        <div class="container">
                        <ul class="nav justify-content-end p-3">

                            <li class="nav-item" >
                              <a class="nav-link disabled" href="#" tabindex="-1" style="color: white">irul</a>
                            </li>
                          </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
            <div class="konten">
                @yield('konten')
            </div>
        </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="script.js"></script>



</body>
</html>

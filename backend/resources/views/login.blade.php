
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('login.css') }}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300&family=Open+Sans:ital,wght@0,400;0,600;0,700;1,600&display=swap" rel="stylesheet">

    <title>Login</title>
</head>
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
    @elseif(session('error'))
        <script>
            swal({
                title: "Error!",
                text: "{{ session('error') }}!",
                icon: "error",
                button: "OK",
            });
        </script>
    @endif
  <div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 side-image">
                <div class="text">
                    <p>“You can't study the darkness by flooding it with light."<br><i>― Edward Abbey</i></p>
                </div>
            </div>

            <div class="col-md-6 right">
                <div class="input-box">
                    <header>Hi, Welcome Back</header>

                    <form action="{{ route('login-proses') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="input-field">
                        <input type="text" class="input" id="email" name="email" required="" autocomplete="off">
                        <label for="email">Username</label>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="input" id="pass" required="">
                        <label for="pass">Password</label>
                        <div id="emailHelp" class="form-text mb-3">Forget password?</div>
                    </div>
                    <div class="input-field">
                        <input type="submit" class="btn-submit" value="Sign In">
                    </div>
                    <div class="signup" >
                        <span>Don't have an account? <a href="{{ route('register') }}">Sign Up here</a></span>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

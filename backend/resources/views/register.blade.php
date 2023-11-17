
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300&family=Open+Sans:ital,wght@0,400;0,600;0,700;1,600&display=swap" rel="stylesheet">
    <title>Register</title>
</head>
<body>
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
                    <header>Sign Up</header>
                    <form action="{{ route('register.proses') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="input-field">
                        <input type="text" class="input" id="email" name="nama" required="" autocomplete="off">
                        <label for="email">Full Name</label>
                    </div>
                    <div class="input-field">
                        <input type="text" class="input" id="email" name="email"  required="" autocomplete="off">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field">
                        <input type="password" class="input" id="pass" name="password" required="">
                        <label for="pass">Password</label>
                    </div>
                    <div class="input-field">
                        <input type="number" class="input" id="pass" name="no_hp" required="">
                        <label for="phone">Phone Number</label>
                    </div>
                    <div class="input-field">
                        <input type="submit" class="btn-submit" value="Sign Up">
                    </div>
                </form>
                    <div class="signin">
                        <span>Already have an account? <a href="{{ route('login') }}">Sign In</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

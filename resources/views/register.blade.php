<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PMB PEI">
    <meta property="og:title" content="PMB PEI">
    <meta property="og:description" content="PMB PEI">

    <!-- PAGE TITLE HERE -->
    <title>Daftar | PMB PEI</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('sipenmaru/images/logo.png') }}">
    <link href="{{ asset('sipenmaru/css/style.css') }}" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center">
                                        <a href="index"><img src="{{ asset('sipenmaru/images/logo.png') }}" alt=""
                                                width="100px"> </a>
                                    </div>
                                    <h4 class="text-center">Daftarkan akunmu</h4>
                                    <form method="POST" action="/signup">
                                        {{ csrf_field() }}

                                        @if (session()->has('loginError'))
                                            <div class="alert alert-danger" role="alert">
                                                <strong>Warning!</strong>
                                                {{ session('loginError') }}
                                            </div>
                                        @endif
                                        <div class="mb-2">
                                            <label class="text-label form-label">Nama Lengkap</label>
                                            <div class="input-group">
                                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                <input type="text" class="form-control"
                                                    placeholder="Masukkan nama lengkap.." name="name"
                                                    value="{{ old('name') }}">
                                                @error('name')
                                                    <div class="alert alert-warning" role="alert">
                                                        <strong>Warning!</strong>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label class="text-label form-label">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text"> <i class="fas fa-envelope"></i> </span>
                                                <input type="text" class="form-control" placeholder="Masukkan email.."
                                                    name="email" value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="alert alert-warning" role="alert">
                                                        <strong>Warning!</strong>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label class="text-label form-label">Kata Sandi *</label>
                                            <div class="input-group transparent-append">
                                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                                <input type="password" class="form-control" id="dlab-password"
                                                    placeholder="Masukkan  kata sandi..." name="password">
                                                <span class="input-group-text show-pass">
                                                    <i class="fa fa-eye-slash"></i>
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                                <div class="invalid-feedback">
                                                    Masukkan ulang kata sandi.
                                                </div>
                                            </div>
                                            @error('password')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Warning!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="text-center mb-3">
                                            <button type="submit"
                                                class="btn me-2 btn-primary text-center">Daftar</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3 text-center">
                                        <p>Sudah memiliki akun? <a class="text-primary" href="/login">Sign up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--************
        Scripts
    *************-->
    <!-- Required vendors -->
    <script src="{{ asset('sipenmaru/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('sipenmaru/js/custom.min.js') }}"></script>
    <script src="{{ asset('sipenmaru/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('sipenmaru/js/styleSwitcher.js') }}"></script>
</body>

</html>

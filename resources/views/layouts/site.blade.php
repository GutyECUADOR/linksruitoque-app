<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../assets/libs/magnific-popup/dist/magnific-popup.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Codescandy">

    <script>
        // Render blocking JS:
        if (localStorage.theme) document.documentElement.setAttribute("data-theme", localStorage.theme);
    </script>

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon/favicon.ico">


     <!-- Libs CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('assets/libs/magnific-popup/dist/magnific-popup.css')}}" rel="stylesheet" >
    <link href="{{ asset('assets/fonts/feather/feather.css')}}" rel="stylesheet" >
    <link href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.css')}}" rel="stylesheet" >
    <link href="{{ asset('assets/libs/@mdi/font/css/materialdesignicons.min.css')}}" rel="stylesheet" >
    <link href="{{ asset('assets/libs/simplebar/dist/simplebar.min.css')}}" rel="stylesheet" >


    <!-- Theme CSS -->
    <link href="{{ asset('assets/css/theme.min.css')}}" rel="stylesheet" >
    <link href="../../assets/libs/tiny-slider/dist/tiny-slider.css" rel="stylesheet">
    <title>{{ config('app.name', 'App') }} </title>
</head>

<body class="bg-white">
    <!-- Page content -->
    <!-- navbar login -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid px-0">
            <div class="d-flex">
                <a class="navbar-brand" href="../../index.html"><img src="../../assets/images/brand/logo/logo.svg"
                        alt="Geeks high quality website templates created with Bootstrap 5."></a>

            </div>
            <div class="order-lg-3">
                <div class="d-flex align-items-center">
                    <a href="#"
                        class="form-check form-switch theme-switch btn btn-light btn-icon rounded-circle me-2">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>

                    </a>
                    <a href="{{ route('login') }}" style="margin-left: 10px;" class="btn btn-outline-primary me-2 ">{{ __('Login') }}</a>
                    <a href="{{ route('register') }}" class="btn btn-primary d-none d-md-block">{{ __('Register') }}</a>
                    <!-- Button -->
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="icon-bar top-bar mt-0"></span>
                        <span class="icon-bar middle-bar"></span>
                        <span class="icon-bar bottom-bar"></span>
                    </button>
                </div>

            </div>

            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="navbar-default">

                <ul class="navbar-nav mx-auto">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarLanding"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pago de servicios
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarLanding">
                            <li>
                                <h4 class="dropdown-header">Servicios</h4>
                            </li>
                            <li>
                                <a href="{{ route('pagos.index') }}"
                                    class="dropdown-item d-flex justify-content-between">
                                    Pagos de facturas online <span class="badge bg-primary ms-1">Nuevo</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>

            </div>

        </div>
    </nav>

    <!-- main section -->
    {{ $slot }}

    <!-- Scripts -->
    <!-- Libs JS -->
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/libs/simplebar/dist/simplebar.min.js"></script>


    <!-- Theme JS -->
    <script src="../../assets/js/theme.min.js"></script>

    <script src="../../assets/libs/tiny-slider/dist/min/tiny-slider.js"></script>
    <script src="../../assets/js/vendors/tnsSlider.js"></script>
    <script src="../../assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <script src="../../assets/js/vendors/popup.js"></script>

</body>

</html>

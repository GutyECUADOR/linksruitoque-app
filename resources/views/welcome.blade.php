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
            <a class="navbar-brand" href="/">
                <img style="max-width: 70px;" src="{{ asset('assets/images/brand/logo/logo.png')}}"
                alt="Logo">
            </a>

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
                        <a href="{{ route('invoices.index') }}" class="nav-link">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                            Pago de facturas
                        </a>

                    </li>

                </ul>

            </div>

        </div>
    </nav>

    <!-- section -->
    <main>
        <section class="py-lg-10 py-5">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row align-items-center">
                    <!-- col -->
                    <div class="col-lg-6 mb-6 mb-lg-0">
                        <div class="">
                            <!-- heading -->
                            <h5 class="text-dark mb-4"><i
                                    class="fe fe-check icon-xxs icon-shape bg-light-success text-success rounded-circle me-2"></i>Planes y pagos 100% confiables</h5>
                            <!-- heading -->
                            <h1 class="display-3 fw-bold mb-3">Planes de internet adaptados a tus necesidades</h1>
                            <!-- para -->
                            <p class="pe-lg-10 mb-5">No te quedes fuera. Contrata uno de nuestros planes con un descuentro promocional por tiempo limitado.</p>
                            <!-- btn -->
                            <a href="#" class="btn btn-primary">Adquiere tu plan ahora</a>
                            <a href="https://www.youtube.com/watch?v=JRzWRZahOVU"
                                class="popup-youtube fs-4 text-inherit ms-3"><img
                                    src="../../assets/images/svg/play-btn.svg" alt="play" class="me-2">Video promocional</a>


                        </div>
                    </div>
                    <!-- col -->
                    <div class="col-lg-6 d-flex justify-content-center">
                        <!-- images -->
                        <div class="position-relative">
                            <img src="../../assets/images/background/acedamy-img/bg-thumb.svg" alt="img"
                                class=" ">
                            <img src="../../assets/images/background/acedamy-img/girl-image.png" alt="girl"
                                class=" w-100 w-md-auto position-absolute end-0 bottom-0">
                            <img src="../../assets/images/background/acedamy-img/frame-1.svg" alt="frame"
                                class=" position-absolute top-0 ms-lg-n10 ms-n19">
                            <img src="../../assets/images/background/acedamy-img/frame-2.svg" alt="frame"
                                class=" position-absolute bottom-0 start-0 ms-lg-n14 ms-n6 mb-n7">
                            <img src="../../assets/images/background/acedamy-img/target.svg" alt="target"
                                class=" position-absolute bottom-0 mb-10 ms-n10 ms-lg-n1 ">
                            <img src="../../assets/images/background/acedamy-img/sound.svg" alt="sound"
                                class=" position-absolute top-0  start-0 mt-18 ms-lg-n19 ms-n8">
                            <img src="../../assets/images/background/acedamy-img/trophy.svg" alt="trophy"
                                class=" position-absolute top-0  start-0 ms-lg-n14 ms-n5">

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <x-preguntas-frecuentes></x-preguntas-frecuentes>

    </main>

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

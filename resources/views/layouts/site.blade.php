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

    <x-navbar-quest></x-navbar-quest>

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

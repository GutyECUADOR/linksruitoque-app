<!-- navbar vertical -->
<!-- Sidebar -->
<nav class="navbar-vertical navbar">
    <div class="vh-100" data-simplebar>
        <!-- Brand logo -->
        <a class="navbar-brand" href="/dashboard">
            <img src="{{ asset('assets/images/brand/logo/logo.png')}}" alt="">
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="nav-icon fe fe-home me-2"></i> Inicio
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('anulacion-facturas') }}">
                    <i class="nav-icon fe fe-file me-2"></i> Anulación de Facturas
                </a>
            </li>
        </ul>

    </div>
</nav>

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


            <div class="collapse navbar-collapse" id="navbar-default">

                <ul class="navbar-nav mx-auto">

                    <li class="nav-item dropdown">
                        <a href="/" class="nav-link">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            Inicio
                        </a>

                    </li>

                    <li class="nav-item dropdown">
                        <a href="{{ route('invoices.index') }}" class="nav-link">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                            Pago de facturas
                        </a>

                    </li>

                    <li class="nav-item dropdown">
                        <a href="{{ route('preguntas-frecuentes') }}" class="nav-link">
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                            Preguntas Frecuentes
                        </a>

                    </li>

                    <li class="nav-item dropdown">
                        <a href="{{ route('preguntas-frecuentes') }}" class="nav-link">
                            <i class="fa fa-handshake" aria-hidden="true"></i>
                            Términos y Condiciones
                        </a>

                    </li>

                </ul>

            </div>

        </div>
</nav>

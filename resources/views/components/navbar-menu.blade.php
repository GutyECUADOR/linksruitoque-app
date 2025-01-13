<!-- navbar -->
<nav class="navbar-default navbar navbar-expand-lg">
    <a id="nav-toggle" href="#">
        <i class="fe fe-menu"></i>
    </a>

    <!--Navbar nav -->
    <div class="ms-auto d-flex">

        <ul class="navbar-nav navbar-right-wrap ms-2 d-flex nav-top-wrap">

            <!-- List -->
            <li class="dropdown ms-2">
                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="avatar avatar-md avatar-indicators avatar-online">
                        <img alt="avatar" src="{{ asset('assets/images/avatar/default.png')}}" class="rounded-circle">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                    <div class="dropdown-item">
                        <div class="d-flex">
                            <div class="avatar avatar-md avatar-indicators avatar-online">
                                <img alt="avatar" src="{{ asset('assets/images/avatar/default.png')}}" class="rounded-circle">

                            </div>
                            <div class="ms-3 lh-1">
                                <h5 class="mb-1">{{ auth()->user()->nickname }}</h5>
                                <p class="mb-0 text-muted">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <ul class="list-unstyled">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        <i class="fe fe-power me-2"></i>
                                        {{ __('Logout') }}
                                    </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

</nav>

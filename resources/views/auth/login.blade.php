<x-guest-layout>

    <!-- Page content -->
    <main>
        <section class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center g-0 min-vh-100">

                <div class="col-lg-5 col-md-8 py-8 py-xl-0">
                    <!-- Card -->
                    <div class="card shadow ">
                        <!-- Card body -->
                        <div class="card-body p-6">
                            <div class="mb-4">
                                <a href="/">
                                    <img style="max-width: 70px;"
                                        src="{{ asset('assets/images/brand/logo/logo.png')}}" class="mb-4"
                                        alt="logo-icon">
                                </a>
                                <h1 class="mb-1 fw-bold">Iniciar Sesión</h1>
                                <span>Aun no tienes una cuenta? <a href="{{ route('register') }}"
                                        class="ms-1">Registrarse</a></span>
                            </div>
                            <!-- Form -->
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Flash messages -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />
                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                <!-- Username -->
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control" id="email" placeholder="name@example.com" required
                                        autofocus>
                                    <label for="email">Correo electrónico</label>
                                </div>
                                <!-- Password -->
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Password" required autocomplete="current-password">
                                    <label for="password">Contraseña</label>
                                </div>
                                <!-- Checkbox -->
                                <div class="d-lg-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input id="remember_me" type="checkbox" name="remember">
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
                                    </div>
                                    <div>
                                        <a href="{{ route('password.request') }}">Olvidataste tu contraseña?</a>
                                    </div>
                                </div>
                                <div>
                                    <!-- Button -->
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary ">Ingresar</button>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="mt-4 text-center">
                                    <!--Facebook-->
                                    <a href="#" class="btn-social btn-social-outline btn-facebook">
                                        <i class="mdi mdi-facebook fs-4"></i>
                                    </a>
                                    <!--Twitter-->
                                    <a href="#" class="btn-social btn-social-outline btn-twitter">
                                        <i class="mdi mdi-twitter fs-4"></i>
                                    </a>
                                    <!--LinkedIn-->
                                    <a href="#" class="btn-social btn-social-outline btn-linkedin">
                                        <i class="mdi mdi-linkedin"></i>
                                    </a>
                                    <!--GitHub-->
                                    <a href="#" class="btn-social btn-social-outline btn-github">
                                        <i class="mdi mdi-github"></i>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</x-guest-layout>

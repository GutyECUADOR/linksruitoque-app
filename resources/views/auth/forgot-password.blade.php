<x-guest-layout>
  <main>
		<section class="container d-flex flex-column">
			<div class="row align-items-center justify-content-center g-0 min-vh-100">
				<div class="col-lg-5 col-md-8 py-8 py-xl-0">
					<!-- Card -->
					<div class="card shadow">
						<!-- Card body -->
						<div class="card-body p-6">
							<div class="mb-4">
								<a href="/"><img style="max-width: 50px;" src="{{ asset('assets/images/brand/logo/logo-cybergrupon.svg')}}" class="mb-4" alt="logo-icon"></a>
								<h1 class="mb-1 fw-bold">Restaurar contraseña</h1>
								<p> {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
							</div>

							<!-- Session Status -->
							<x-auth-session-status class="mb-4" :status="session('status')" />

							<!-- Validation Errors -->
							<x-auth-validation-errors class="mb-4" :errors="$errors" />

							<!-- Form -->
							<form method="POST" action="{{ route('password.email') }}">
                            @csrf

								<!-- Email -->
								<div class="mb-3">
									<label for="email" class="form-label">Email</label>
									<input type="email" name="email" value="{{old('email')}}" placeholder="Ingrese su correo" class="form-control" id="email" required />
								</div>
									<!-- Button -->
								<div class="mb-3 d-grid">
									<button type="submit" class="btn btn-primary">
										Enviar correo de recuperación
									</button>
								</div>
								<span>Regresar a <a href="{{ route('login')}}">Iniciar Sesión</a></span>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
</x-guest-layout>


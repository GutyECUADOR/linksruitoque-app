<section class="py-7 py-lg-5">
    <div class="container">
        <div class="row mb-2 justify-content-center">
            <div class="col-lg-6 col-md-12 col-12 text-center">
                <!-- caption -->
                <span class="text-primary mb-3 d-block text-uppercase fw-semibold ls-xl">Transación Finalizada</span>
                <h2 class="mb-2 display-4 fw-bold ">{{ $requestInformation->StatusMessage }}</h2>
                <div>
                    <label class="form-check-label text-center">
                        <span>Regresar a la página de inicio <a href="/">AQUI.</a></span></label>
                </div>

                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
        </div>
        <!-- row -->
        @if ($requestInformation)
            <div class="row justify-content-center ">
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- Card -->
                    <div class="card">
                        <!-- Card Body -->
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Información</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requestInformation->toArray() as $key => $value)
                                        @if (!in_array($key, ['created_at', 'updated_at', 'requestId']))
                                            <tr>
                                                <td>{{ $key }}</td>
                                                <td>{{ $value }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

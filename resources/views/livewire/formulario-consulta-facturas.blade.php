<main>
    <section class="bg-light py-8 bg-cover">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row align-items-center">
                <div class="col-lg-6 col-12 mx-auto">
                    <div>
                        <div class="text-center text-md-start">
                            <!-- heading -->
                            <h1 class="display-2 fw-bold mb-3 text-center">Consulta de facturas</h1>
                            <!-- lead -->
                            <p class="lead text-center">Consulta aqui tus facturas pendientes, y realiza el pago de forma segura.</p>
                        </div>

                        <noscript>
                            <div style="background-color: #ffdddd; color: #d8000c; padding: 10px; text-align: center;">
                                JavaScript está deshabilitado en tu navegador. Por favor, habilítalo para disfrutar de todas las funcionalidades del sitio.
                            </div>
                        </noscript>

                        <!-- Flash messages -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <div class="mt-8">
                            <!-- card -->
                            <div class="bg-white rounded-md-pill shadow rounded-3 mb-4">
                                <!-- card body -->
                                <div class="p-md-2 p-4">

                                    <!-- form -->
                                    <form wire:submit.prevent="submit_cosultaFacturas" class="row g-1">
                                        <div class="col-12 col-md-9">
                                            <!-- input -->
                                            <div class="input-group mb-2 mb-md-0 border-md-0 border rounded-pill">
                                                <!-- input group -->
                                                <span
                                                    class="input-group-text bg-transparent border-0 pe-0 ps-md-3 ps-md-0"
                                                    id="search">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" fill="currentColor" class="bi bi-search"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                                                    </svg>
                                                </span>
                                                <!-- search -->
                                                <input type="search"
                                                    wire:model.defer="cedula"
                                                    name="cedula"
                                                    class="form-control rounded-pill border-0 ps-3 form-focus-none"
                                                    placeholder="Ingrese el número de DNI para buscar tus facturas" aria-label="busqueda"
                                                    aria-describedby="busqueda">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3 text-end d-grid">
                                            <!-- button -->
                                            <button type="submit"
                                                wire:loading.attr="disabled"
                                                class="btn btn-primary rounded-pill">
                                                <span wire:loading.remove>
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                    Buscar
                                                </span>
                                                <span wire:loading>
                                                    <i class="fa fa-cog fa-spin"></i>
                                                    Procesando
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @if($invoices)
    <section class="py-lg-5 pb-3">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="offset-xl-2 col-xl-8 col-md-12 col-12">
                    <div class="text-center mb-8">
                        <!-- col -->
                        <!-- text -->
                        <span class="text-uppercase text-primary fw-semibold ls-md"></span>
                        <!-- heading -->
                        <h2 class="h2 fw-bold mt-3">Lista de facturas pendientes</h2>
                        <h3 class="h3">Total: $ {{ $total }}</h3>
                        <button
                            wire:click="submit_pagarFacturas()"
                            wire:loading.attr="disabled"
                            {{ $isSubmitting === true ? 'disabled' : '' }}
                            {{ !$invoices_checked->isEmpty() ? '' : 'disabled' }}
                            class="btn btn-outline-primary me-2 mb-5">

                            <span wire:loading.remove>
                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                Pagar facturas
                            </span>
                            <span wire:loading>
                                <i class="fa fa-cog fa-spin"></i>
                                Procesando
                            </span>
                        </button>

                        <!-- Flash messages -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div>
                            <label class="form-check-label text-center"><span>Al proceder con el pago aceptas los <a href="#" data-bs-toggle="modal" data-bs-target="#modalterminos">Términos y Condiciones.</a></span></label>
                        </div>

                    </div>
                    <!-- row -->
                    @foreach ($invoices as $index => $invoice)
                    <div class="card card-bordered mb-4 card-hover cursor-pointer">
                        <!-- card body -->
                        <div class="card-body">
                            <div>
                                <div class="d-md-flex">
                                    <!-- text -->
                                    <div class="ms-md-3 w-100 mt-3 mt-xl-1">
                                        <div class="d-flex justify-content-between mb-5">
                                            <div>
                                                <!-- heading -->
                                                <h3 class="mb-1 fs-4">
                                                    <span class="text-inherit">Factura #:{{ $invoice["numeroFactura"] }}</span>
                                                    <span class="badge {{ \Carbon\Carbon::parse($invoice['fechaLimitePago'])->isFuture() ? 'bg-success-soft' : 'bg-danger-soft' }} ms-2">
                                                        Fecha limite: {{ \Carbon\Carbon::parse($invoice['fechaLimitePago'])->subDays(1) }}
                                                    </span>
                                                </h3>

                                                <div>
                                                    <span>{{$invoice["referenciaPago"] }}</span>
                                                    <span class="ms-0"> - {{ $invoice["periodoCancelar"] }}</span>
                                                </div>
                                                @if (\Carbon\Carbon::now() <= $invoice['fechaLimitePago'])
                                                    <h2>$ {{ $invoice["valor"] }}</h2>
                                                @else
                                                    <h2>$ {{ $invoice["valorVencido"] }}</h2>
                                                @endif

                                                @if ($invoice['status'] === 'PENDING')
                                                    <span class="badge bg-info-soft">
                                                        Factura pendiente verificación de pago
                                                    </span>
                                                @elseif ($invoice['status'] === 'UNPAYMENT')
                                                    <span class="badge bg-danger-soft">
                                                        Factura pendiente de pago
                                                    </span>
                                                @elseif ($invoice['status'] === 'APPROVED')
                                                    <span class="badge bg-primary-soft">
                                                        Factura pagada
                                                    </span>
                                                @else
                                                    Estado desconocido
                                                @endif

                                            </div>

                                            @if ($invoice['status'] === 'UNPAYMENT')
                                            <div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input
                                                            class="form-check-input"
                                                            wire:click="actualizaValorTotal()"
                                                            wire:model="invoices.{{ $index }}.checked"
                                                            type="checkbox">

                                                        Pagar esta factura
                                                    </label>
                                                </div>
                                            </div>
                                            @endif
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
</main>

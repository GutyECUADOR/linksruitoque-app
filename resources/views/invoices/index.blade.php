<x-site-layout>

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
                                        <form method="POST" action="{{ route('invoices.consultar') }}" class="row g-1">
                                            @csrf
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
                                                        class="form-control rounded-pill border-0 ps-3 form-focus-none"
                                                        name="cedula"
                                                        placeholder="Ingrese el número de DNI para buscar tus facturas" aria-label="busqueda"
                                                        aria-describedby="busqueda">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-3 text-end d-grid">
                                                <!-- button -->
                                                <button type="submit"
                                                    class="btn btn-primary rounded-pill">Buscar</button>
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

        <section class="py-lg-8 pb-8">
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
                            <h2 class="h2 fw-bold mt-3">Lista de facturas pendientes.</h2>
                        </div>
                        <!-- row -->

                        <div class="card card-bordered mb-4 card-hover cursor-pointer">
                            <!-- card body -->
                            <div class="card-body">
                                <div>
                                    <div class="d-md-flex">
                                        <div class="mb-3 mb-md-0">
                                            <!-- Img -->
                                            <img src="../../assets/images/job/job-brand-logo/job-list-logo-1.svg"
                                                alt="Geeks UI - Bootstrap 5 Template"
                                                class="icon-shape border rounded-circle">
                                        </div>
                                        <!-- text -->
                                        <div class="ms-md-3 w-100 mt-3 mt-xl-1">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                    <!-- heading -->
                                                    <h3 class="mb-1 fs-4">
                                                        <a href="../jobs/job-single.html"
                                                            class="text-inherit">Software Engineer (Web3/Crypto)</a>
                                                        <span class="badge bg-danger-soft ms-2">Featured Job</span>
                                                    </h3>

                                                    <div>
                                                        <span>at HelpDesk</span>
                                                        <!-- star -->
                                                        <span class="text-dark ms-2 fw-medium">
                                                            4.5
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="10" fill="currentColor"
                                                                class="bi bi-star-fill text-warning align-baseline"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                            </svg>
                                                        </span>
                                                        <span class="ms-0">(131 Reviews)</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <!-- bookmark -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor"
                                                        class="bi bi-bookmark bookmark" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z">
                                                    </svg>
                                                </div>
                                            </div>

                                            <div class="d-md-flex justify-content-between">
                                                <div class="mb-2 mb-md-0">
                                                    <!-- year -->
                                                    <span class="me-2">
                                                        <i class="fe fe-briefcase"></i>
                                                        <span class="ms-1">1 - 5 years</span>
                                                    </span>
                                                    <!-- salary -->

                                                    <span class="me-2">
                                                        <i class="fe fe-dollar-sign"></i>
                                                        <span class="ms-1">12k - 18k</span>
                                                    </span>
                                                    <!-- location -->
                                                    <span class="me-2">
                                                        <i class="fe fe-map-pin"></i>
                                                        <span class="ms-1">Ahmedabad, Gujarat</span>
                                                    </span>
                                                </div>
                                                <!-- time -->
                                                <div>
                                                    <i class="fe fe-clock"></i>
                                                    <span>21 hours ago</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card -->
                        <div class="card card-bordered mb-4 card-hover cursor-pointer">
                            <!-- card body -->
                            <div class="card-body">
                                <div>
                                    <div class="d-md-flex">
                                        <div class="mb-3 mb-md-0">
                                            <!-- Img -->

                                            <img src="../../assets/images/job/job-brand-logo/job-list-logo-2.svg"
                                                alt="Geeks Bootstrap 5 Template"
                                                class="icon-shape border rounded-circle">
                                        </div>
                                        <!-- text -->
                                        <div class="ms-md-3 w-100 mt-3 mt-xl-1">
                                            <div class="d-flex justify-content-between mb-4">
                                                <div>
                                                    <h3 class="mb-1 fs-4"><a href="../jobs/job-single.html"
                                                            class="text-inherit">Senior React Developer</a></h3>
                                                    <div>
                                                        <span>at Airtable</span>
                                                        <!-- icon -->
                                                        <span class="text-dark ms-2 fw-medium">
                                                            5.0
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="10" fill="currentColor"
                                                                class="bi bi-star-fill text-warning align-baseline"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                            </svg>
                                                        </span>
                                                        <span class="ms-0">(324 Reviews)</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor"
                                                        class="bi bi-bookmark bookmark" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z">
                                                    </svg>
                                                </div>
                                            </div>

                                            <div class="d-md-flex justify-content-between">
                                                <div class="mb-2 mb-lg-0">
                                                    <!-- year -->
                                                    <span class="me-2">
                                                        <i class="fe fe-briefcase"></i>
                                                        <span class="ms-1">0 - 5 years</span>
                                                    </span>
                                                    <!-- salary -->
                                                    <span class="me-2">
                                                        <i class="fe fe-dollar-sign"></i>
                                                        <span class="ms-1">5k - 8k</span>
                                                    </span>
                                                    <!-- location -->
                                                    <span class="me-2">
                                                        <i class="fe fe-map-pin"></i>
                                                        <span class="ms-1">Jaipur, Rajasthan</span>
                                                    </span>
                                                </div>
                                                <!-- day -->
                                                <div>
                                                    <i class="fe fe-clock"></i>
                                                    <span>1 day ago</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card -->
                        <div class="card card-bordered mb-4 card-hover cursor-pointer">
                            <!-- card body -->
                            <div class="card-body">
                                <div>
                                    <div class="d-md-flex">
                                        <div class="mb-3 mb-md-0">
                                            <!-- Img -->

                                            <img src="../../assets/images/job/job-brand-logo/job-list-logo-3.svg" alt
                                                class="icon-shape border rounded-circle">
                                        </div>
                                        <!-- text -->
                                        <div class="ms-md-3 w-100 mt-3 mt-xl-1">
                                            <div class="d-flex justify-content-between mb-4">
                                                <div>
                                                    <!-- heading -->
                                                    <h3 class="mb-1 fs-4"><a href="../jobs/job-single.html"
                                                            class="text-inherit">Software Engineer (Web3/Crypto)</a>
                                                    </h3>
                                                    <div>
                                                        <span>at Square</span>
                                                        <!-- icon -->
                                                        <span class="text-dark ms-2 fw-medium">
                                                            3.9
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="10" fill="currentColor"
                                                                class="bi bi-star-fill text-warning align-baseline"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                            </svg>
                                                        </span>
                                                        <span class="ms-0">(424 Reviews)</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <!-- icon -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor"
                                                        class="bi bi-bookmark bookmark" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z">
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="d-md-flex justify-content-between">
                                                    <div class="mb-2 mb-md-0">
                                                        <!-- year -->
                                                        <span class="me-2">
                                                            <i class="fe fe-briefcase"></i>
                                                            <span class="ms-1">2 - 6 years</span>
                                                        </span>
                                                        <!-- year -->
                                                        <span class="me-2">
                                                            <i class="fe fe-dollar-sign"></i>
                                                            <span class="ms-1">Not discloses</span>
                                                        </span>
                                                        <!-- location -->
                                                        <span class="me-2">
                                                            <i class="fe fe-map-pin"></i>
                                                            <span class="ms-1">Hastsal, Delhi</span>
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <!-- icon -->
                                                        <i class="fe fe-clock"></i>
                                                        <span>1 day ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card -->
                        <div class="card card-bordered mb-4 card-hover cursor-pointer">
                            <!-- card body -->
                            <div class="card-body">
                                <div>
                                    <div class="d-md-flex">
                                        <div class="mb-3 mb-md-0">
                                            <!-- Img -->

                                            <img src="../../assets/images/job/job-brand-logo/job-list-logo-4.svg" alt
                                                class="icon-shape border rounded-circle">
                                        </div>
                                        <!-- text -->
                                        <div class="ms-md-3 w-100 mt-3 mt-xl-1">
                                            <div class="d-flex justify-content-between mb-4">
                                                <div>
                                                    <!-- heading -->
                                                    <h3 class="mb-1 fs-4"><a href="../jobs/job-single.html"
                                                            class="text-inherit">Lead Software Engineer</a></h3>
                                                    <div>
                                                        <span>at Dot</span>
                                                        <!-- star -->
                                                        <span class="text-dark ms-2 fw-medium">
                                                            3.9
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="10" fill="currentColor"
                                                                class="bi bi-star-fill text-warning align-baseline"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                            </svg>
                                                            <!-- reviews -->
                                                        </span>
                                                        <span class="ms-0">(523 Reviews)</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor"
                                                        class="bi bi-bookmark bookmark" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z">
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="d-md-flex justify-content-between">
                                                    <div class="mb-2 mb-md-0">
                                                        <!-- year -->
                                                        <span class="me-2">
                                                            <i class="fe fe-briefcase"></i>
                                                            <span class="ms-1">0 - 2 years</span>
                                                        </span>
                                                        <span class="me-2">
                                                            <!-- salary -->
                                                            <i class="fe fe-dollar-sign"></i>
                                                            <span class="ms-1">Not discloses</span>
                                                        </span>
                                                        <span class="me-2">
                                                            <!-- location -->
                                                            <i class="fe fe-map-pin"></i>
                                                            <span class="ms-1">Pune, Chennai</span>
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <!-- time -->
                                                        <i class="fe fe-clock"></i>
                                                        <span>1 Month ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card -->
                        <div class="card card-bordered mb-4 card-hover cursor-pointer">
                            <!-- card body -->
                            <div class="card-body">
                                <div>
                                    <div class="d-md-flex">
                                        <div class="mb-3 mb-md-0">
                                            <!-- Img -->

                                            <img src="../../assets/images/job/job-brand-logo/job-list-logo-5.svg" alt
                                                class="icon-shape border rounded-circle">
                                        </div>
                                        <!-- text -->
                                        <div class="ms-md-3 w-100 mt-3 mt-xl-1">
                                            <div class="d-flex justify-content-between mb-4">
                                                <div>
                                                    <!-- heading -->
                                                    <h3 class="mb-1 fs-4"><a href="../jobs/job-single.html"
                                                            class="text-inherit">Senior Full Stack Engineer</a></h3>
                                                    <div>
                                                        <span>at Toggle</span>
                                                        <span class="text-dark ms-2 fw-medium">
                                                            4.9
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="10" fill="currentColor"
                                                                class="bi bi-star-fill text-warning align-baseline"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                            </svg>
                                                        </span>
                                                        <span class="ms-0">(923 Reviews)</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <!-- icon -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor"
                                                        class="bi bi-bookmark bookmark" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z">
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="d-md-flex justify-content-between">
                                                    <div class="mb-2 mb-md-0">
                                                        <!-- year -->
                                                        <span class="me-2">
                                                            <i class="fe fe-briefcase"></i>
                                                            <span class="ms-1">2 - 6 years</span>
                                                        </span>
                                                        <!-- salary -->
                                                        <span class="me-2">
                                                            <i class="fe fe-dollar-sign"></i>
                                                            <span class="ms-1">Not discloses</span>
                                                        </span>
                                                        <!-- location -->
                                                        <span class="me-2">
                                                            <i class="fe fe-map-pin"></i>
                                                            <span class="ms-1">Ahmedabad, Gujarat</span>
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <!-- time -->
                                                        <i class="fe fe-clock"></i>
                                                        <span>2 Month ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card -->

                    </div>
                </div>
            </div>
        </section>

    </main>

</x-site-layout>

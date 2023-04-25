<x-app-layout>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="/dashboard" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <div class="nav-item dropdown">
                            @if (Auth::check())
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                    <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
                                </a>
                            @endif
                            <div
                                class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                                @if (Route::has('login'))
                                    <div class="dropdown-item">
                                        @auth
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                {{ csrf_field() }}
                                                <button type="submit">Logout</button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}"
                                                    class="ml-4 text-sm text-gray-700 underline">Register</a>
                                            @endif
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- Navbar End -->

                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <div class="h-100 bg-secondary rounded p-4">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h6 class="mb-0">Data inicio</h6>
                                </div>
                                <div id="calender"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <div class="h-100 bg-secondary rounded p-4">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h6 class="mb-0">Data fim</h6>
                                </div>
                                <div id="calender2"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-xl-4">
                            <div style="height: 320px; overflow: auto;" class="bg-secondary rounded p-4">
                                <div class="h-100 bg-secondary rounded p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <h6 class="mb-0">Lista de Sensores</h6>
                                        <div class="d-flex mb-2">
                                            <button type="button" class="btn btn-primary ms-2"
                                                id="btnBuscar">buscar</button>
                                                <button type="button" class="btn btn-primary ms-2"
                                                onclick="imprimirPDF()">PDF</button>
                                        </div>
                                    </div>

                                    @foreach ($nomes as $nome)
                                        <div class="d-flex align-items-center border-bottom py-2">
                                            <input class="form-check-input m-0" type="checkbox" value="{{ $nome->nome }}">
                                            <div class="w-100 ms-3">
                                                <div class="d-flex w-100 align-items-center justify-content-between">
                                                    <span>{{ $nome->nome }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>



                        <!-- Table Start -->
                        <div class="container-fluid pt-4 px-4">
                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <div class="d-flex align-items-center justify-content-between mb-4">
                                            <h6 class="mb-0">Relatório de Leitura</h6>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Nome</th>
                                                        <th scope="col">Temperatura</th>
                                                        <th scope="col">Umidade</th>
                                                        <th scope="col">Data</th>
                                                        <th scope="col">Hora</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-body">
                                                    <!-- Aqui serão adicionadas as linhas da tabela -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Table End -->


                        <!-- Footer Start -->
                        <div class="container-fluid pt-4 px-4">
                            <div class="bg-secondary rounded-top p-4">
                                <div class="row">
                                    <div class="col-12 col-sm-6 text-center text-sm-start">
                                        &copy; <a href="/dashboard">Tech Passos</a>, Todos os direitos reservados.
                                    </div>
                                    <div class="col-12 col-sm-6 text-center text-sm-end">
                                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                                        <br>Distributed By: <a
                                            href="https://www.linkedin.com/in/f%C3%A1bio-marchiore-passos-234542158/"
                                            target="_blank">Fabio passos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Footer End -->
                    </div>
                    <!-- Content End -->


                    <!-- Back to Top -->
                    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
                            class="bi bi-arrow-up"></i></a>
                </div>

                <!-- JavaScript Libraries -->

                <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
                <script src="lib/chart/chart.min.js"></script>
                <script src="lib/easing/easing.min.js"></script>
                <script src="lib/waypoints/waypoints.min.js"></script>
                <script src="lib/owlcarousel/owl.carousel.min.js"></script>
                <script src="lib/tempusdominus/js/moment.min.js"></script>
                <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
                <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>


                <script>
                    function imprimirPDF() {
                        var dataInicio = $('#calender').data().date;
                        var dataFim = $('#calender2').data().date;
                        var checkboxes = $('input[type="checkbox"]:checked');
                        var nomesSelecionados = [];

                        checkboxes.each(function() {
                            nomesSelecionados.push($(this).val());
                        });

                        var url = '/imprimir-pdf?dataInicio=' + dataInicio + '&dataFim=' + dataFim + '&nomesSelecionados=' +
                            encodeURIComponent(nomesSelecionados.join(','));

                        window.open(url, '_blank');
                    }
                </script>


                <!-- Template Javascript -->
                <script src="js/main.js"></script>

    </x-app-layout>

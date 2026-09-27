<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ !empty($header_title) ? $header_title : '' }}-BabliYaceSchoolDashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets1/img/kaiadmin/logo_ecole.jpg') }}" type="image/x-icon" />

    <!-- Fonts and icons -->

    <script src="{{ asset('assets1/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets1/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->

    <link rel="stylesheet" href="{{ asset('assets1/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets1/css/plugins.min.cs') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets1/css/kaiadmin.min.css') }}">


    <!-- CSS Just for demo purpose, don't include it in your project -->

    <link rel="stylesheet" href="{{ asset('assets1/css/demo.css') }}">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <img src=" {{ asset('assets1/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                                class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                @include('layouts.header')
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="mt-4 app-page-title d-inline-block px-3 py-1 rounded"
                                style="background-color: #28a745; color: #fff;">
                                Espace detail profile</h3>
                        </div>

                        {{-- <div class="ms-md-auto py-2 py-md-0"> --}}
                        {{-- <a href="#" class="btn btn-label-primary btn-round me-2">Liste Année</a> --}}
                        {{-- <a href="{{ url('admin/dashboard') }}" class="btn btn-primary btn-round">Retour sur le
                                Dashboard
                            </a>
                        </div> --}}
                    </div>
                    @include('_message')
                    <div class="card my-4 p-4">
                        <div class="card-header" style="font-size: 20px;"><b>Profil détail Utilisateur </b>
                        </div>
                        <div class="app-card app-card-settings shadow-sm p-4">
                            <div class="card-body">
                                <form class="settings-form" method="GET" action="">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <section style="background-color: #eee;">
                                            <div class="container py-5">
                                                <div class="row">
                                                    <div
                                                        class="d-flex justify-content-between align-items-center bg-body-tertiary rounded-3 p-3 mb-4">

                                                        <div>
                                                            <span class="fw-bold">
                                                                <b>
                                                                    Bienvenue
                                                                    <span class="text-danger">
                                                                        {{ Auth::user()->name }}
                                                                        {{ Auth::user()->last_name }}
                                                                    </span>
                                                                    sur votre espace Detail
                                                                </b>
                                                            </span>
                                                        </div>

                                                        <div>
                                                            <button type="button" class="btn btn-warning btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#changePasswordModal">
                                                                <i class="fa fa-key"></i> Changer mot de passe
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="card mb-4">
                                                            <div class="card-body text-center">
                                                                <img src="{{ Auth::user()->getProfile() }}"
                                                                    alt="avatar" class="rounded-circle img-fluid"
                                                                    style="width:150px; height:150px; object-fit:cover;">
                                                                <h5 class="my-3">{{ Auth::user()->name }}</h5>
                                                                <p class="text-muted mb-1">Ingenieur Developpeur &
                                                                    Administrateur de base de donnée
                                                                </p>
                                                                <p class="text-muted mb-4">Abidjan, Plateau TPTTM
                                                                </p>
                                                                <div class="d-flex justify-content-center mb-2">
                                                                    <button type="button" data-mdb-button-init
                                                                        data-mdb-ripple-init
                                                                        class="btn btn-primary">Suivre</button>
                                                                    <button type="button" data-mdb-button-init
                                                                        data-mdb-ripple-init
                                                                        class="btn btn-outline-primary ms-1">Message</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="card mb-4">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <p class="mb-0"><b>Nom complet</b></p>
                                                                    </div>
                                                                    <div class="col-sm-9">
                                                                        <p class="text-muted mb-0 text-end">
                                                                            {{ Auth::user()->name }}
                                                                            {{ Auth::user()->last_name }}</p>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <p class="mb-0"><b>Email</b></p>
                                                                    </div>
                                                                    <div class="col-sm-9">
                                                                        <p class="text-muted mb-0 text-end">
                                                                            {{ Auth::user()->email }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <p class="mb-0"><b>Contact</b></p>
                                                                    </div>
                                                                    <div class="col-sm-9">
                                                                        <p class="text-muted mb-0 text-end">
                                                                            {{ Auth::user()->mobile_number }}</p>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <p class="mb-0 "><b>Date de naissance</b></p>
                                                                    </div>
                                                                    <div class="col-sm-9">
                                                                        <p class="text-muted mb-0 text-end">
                                                                            {{ \Carbon\Carbon::parse(Auth::user()->date_of_birth)->format('d-m-Y') }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <p class="mb-0"><b>Address</b></p>
                                                                    </div>
                                                                    <div class="col-sm-9">
                                                                        <p class="text-muted mb-0 text-end">Bay Area,
                                                                            San
                                                                            Francisco, CA</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                    </div>

                                    {{-- <button type="submit" class="btn btn-primary"><b>Mettre à jour</b></button> --}}
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Modal Changer Mot de Passe  don cplus besoin de creer une nouvelle page -->
            <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fa fa-lock"></i> Changer mot de passe
                            </h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form method="POST" action="{{ url('profile/change_password') }}">
                            @csrf

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label class="form-label"><b>Ancien mot de passe</b></label>
                                    <input type="password" name="old_password" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"><b>Nouveau mot de passe</b></label>
                                    <input type="password" name="new_password" class="form-control" required>
                                </div>

                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Annuler
                                </button>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Mettre à jour
                                </button>

                            </div>

                        </form>

                    </div>
                </div>
            </div>


            @include('layouts.footer')
        </div>

    </div>
    <!--   Core JS Files   -->

    <script src="{{ asset('assets1/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets1/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets1/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets1/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets1/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets1/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('assets1/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets1/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets1/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('assets1/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets1/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets1/js/kaiadmin.min.js') }}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets1/js/setting-demo.js') }}"></script>
    {{-- <script src="{{ asset('assets1/js/demo.js') }}"></script> --}}
    <script src="{{ asset('assets1/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>
        {{ !empty($header_title) ? $header_title : '' }} - BabliYaceSchoolDashboard
    </title>

    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

    <link rel="icon" href="{{ asset('assets1/img/kaiadmin/logo_ecole.jpg') }}" type="image/x-icon" />

    <!-- Fonts -->
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
                    "simple-line-icons"
                ],
                urls: ["{{ asset('assets1/css/fonts.min.css') }}"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets1/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets1/css/kaiadmin.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets1/css/demo.css') }}">

    <style>
        .attendance-table {
            width: 100%;
            margin-bottom: 0 !important;
        }

        .attendance-table th,
        .attendance-table td {
            text-align: center !important;
            vertical-align: middle !important;
        }

        .attendance-table thead th {
            text-align: center !important;
        }

        .attendance-table tbody tr {
            height: 55px;
        }

        .table-responsive {
            width: 100%;
            margin: 0 !important;
            padding: 0 !important;
        }

        .app-card-settings .card-body {
            width: 100%;
        }

        .student-info {
            background-color: #28a745;
            color: #fff;
            border-radius: 5px;
        }
    </style>

</head>

<body>

    <div class="wrapper">

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End Sidebar -->


        <div class="main-panel">

            <!-- Header -->
            <div class="main-header">

                <div class="main-header-logo">

                    <div class="logo-header" data-background-color="dark">

                        <a href="#" class="logo">

                            <img src="{{ asset('assets1/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
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

                </div>

                @include('layouts.header')

            </div>
            <!-- End Header -->


            <div class="container">

                <div class="page-inner">

                    <!-- Titre -->
                    <div
                        class="d-flex align-items-left align-items-md-center
                    flex-column flex-md-row pt-2 pb-4">

                        <div>

                            <h3 class="mt-1 app-page-title d-inline-block px-3 py-1 rounded"
                                style="background-color: #28a745; color: #fff;">

                                Espace Parent

                            </h3>

                        </div>

                    </div>


                    @include('_message')


                    {{-- INFORMATIONS DE L'ELEVE --}}

                    <div class="card my-4">

                        <div class="card-header d-flex justify-content-between align-items-center"
                            style="font-size: 20px;">

                            <b>
                                Pointage de présence
                            </b>

                            <span class="app-page-title px-3 py-1 rounded"
                                style="background-color: #28a745; color: #fff; font-size:14px;">

                                <b>
                                    {{ $getStudent->name }}
                                    {{ $getStudent->last_name }}
                                </b>

                            </span>

                        </div>


                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-4 mb-2">

                                    <b>Nom et prénom :</b>

                                    {{ $getStudent->name }}
                                    {{ $getStudent->last_name }}

                                </div>


                                <div class="col-md-4 mb-2">

                                    <b>Classe :</b>

                                    {{ $getStudent->class_name }}

                                </div>


                                <div class="col-md-4 mb-2">

                                    <b>N° matricule :</b>

                                    {{ $getStudent->roll_number ?? 'Non défini' }}

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ESPACE DE RECHERCHE --}}

                    <div class="card my-4 p-2">

                        <div class="card-header" style="font-size: 20px;">

                            <b>
                                Espace de recherche...
                            </b>

                        </div>


                        <div class="app-card app-card-settings shadow-sm p-4" style="background-color:#d8e0de;">

                            <div class="card-body">

                                <form method="GET"
                                    action="{{ url('parent/my_student/my_attendance/' . $getStudent->id) }}">

                                    <div class="row">


                                        {{-- MATIERE --}}

                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">

                                                <b>Matière</b>

                                            </label>


                                            <select name="subject_id" class="form-control">

                                                <option value="">

                                                    ~~~~~~~~~~~~~
                                                    Veuillez choisir une matière
                                                    s'il vous plaît
                                                    ~~~~~~~~~~~~~~~

                                                </option>


                                                @foreach ($getSubject as $subject)
                                                    <option value="{{ $subject->subject_id }}"
                                                        {{ Request::get('subject_id') == $subject->subject_id ? 'selected' : '' }}>

                                                        {{ $subject->subject_name }}

                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>


                                        {{-- TYPE DE POINTAGE --}}

                                        <div class="col-md-3 mb-3">

                                            <label class="form-label">

                                                <b>Type de pointage</b>

                                            </label>


                                            <select name="attendance_type" class="form-control">

                                                <option value="">

                                                    ~~~ Veuillez choisir un type de pointage
                                                    s'il vous plaît ~~~

                                                </option>


                                                <option value="1"
                                                    {{ Request::get('attendance_type') == 1 ? 'selected' : '' }}>

                                                    Présent

                                                </option>


                                                <option value="2"
                                                    {{ Request::get('attendance_type') == 2 ? 'selected' : '' }}>

                                                    Absent

                                                </option>

                                            </select>

                                        </div>

                                        <div class="col-md-3 mb-3">

                                            <label class="form-label">

                                                <b>Date de pointage</b>

                                            </label>


                                            <input type="date" name="attendance_date" class="form-control"
                                                value="{{ Request::get('attendance_date') }}">

                                        </div>

                                        <div class="col-md-2 mb-3">

                                            <button type="submit" class="btn btn-primary" style="margin-top:30px"
                                                title="Rechercher">

                                                <i class="fas fa-search"></i>

                                            </button>


                                            <a href="{{ url('parent/my_student/my_attendance/' . $getStudent->id) }}"
                                                class="btn btn-danger" style="margin-top:30px"
                                                title="Effacer les filtres">

                                                <i class="fas fa-trash"></i>

                                            </a>

                                        </div>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                    <div class="app-card app-card-settings shadow-sm p-4">

                        <div class="card-body">

                            <div class="card-header d-flex justify-content-between align-items-center mb-4"
                                style="font-size: 20px;">

                                <b>
                                    Liste de pointage de présence
                                </b>

                                @if ($getRecord instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                    <span class="app-page-title px-3 py-1 rounded"
                                        style="background-color: #28a745; color: #fff; font-size:14px;">

                                        <b>
                                            Total de pointage :
                                            {{ $getRecord->total() }}
                                        </b>

                                    </span>
                                @endif

                            </div>

                            <div class="table-responsive">

                                <table class="table table-striped attendance-table">

                                    <thead class="table-success">

                                        <tr>
                                            <th>Classe</th>
                                            <th>Matière</th>
                                            <th>Pointage</th>
                                            <th>Date de pointage</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->class_name }} </td>
                                                <td>{{ $value->subject_name }} </td>
                                                <td>
                                                    @if ($value->attendance_type == 1)
                                                        <span class="badge bg-success">
                                                            Présent
                                                        </span>
                                                    @elseif ($value->attendance_type == 2)
                                                        <span class="badge bg-danger">
                                                            Absent
                                                        </span>
                                                    @else
                                                        <span class="badge bg-secondary">
                                                            Non défini
                                                        </span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if (!empty($value->attendance_date))
                                                        {{ ucfirst(\Carbon\Carbon::parse($value->attendance_date)->locale('fr')->translatedFormat('l d F Y')) }}
                                                    @endif
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">

                                                    <div class="alert alert-info mb-0">

                                                        Aucune présence trouvée
                                                        pour cet élève.

                                                    </div>

                                                </td>

                                            </tr>
                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                            @if ($getRecord instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                <div class="d-flex justify-content-end mt-3">

                                    {{ $getRecord->appends(request()->except('page'))->links() }}

                                </div>
                            @endif


                        </div>

                    </div>


                </div>

            </div>


            <!-- Footer -->

            @include('layouts.footer')

        </div>

    </div>


    <!-- JS -->

    <script src="{{ asset('assets1/js/core/jquery-3.7.1.min.js') }}"></script>

    <script src="{{ asset('assets1/js/core/popper.min.js') }}"></script>

    <script src="{{ asset('assets1/js/core/bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets1/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <script src="{{ asset('assets1/js/plugin/chart.js/chart.min.js') }}"></script>

    <script src="{{ asset('assets1/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <script src="{{ asset('assets1/js/plugin/chart-circle/circles.min.js') }}"></script>

    <script src="{{ asset('assets1/js/plugin/datatables/datatables.min.js') }}"></script>

    <script src="{{ asset('assets1/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <script src="{{ asset('assets1/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>

    <script src="{{ asset('assets1/js/plugin/jsvectormap/world.js') }}"></script>

    <script src="{{ asset('assets1/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <script src="{{ asset('assets1/js/kaiadmin.min.js') }}"></script>

    <script src="{{ asset('assets1/js/setting-demo.js') }}"></script>


</body>

</html>

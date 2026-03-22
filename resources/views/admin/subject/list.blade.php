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
                            <h3 class="mt-1 app-page-title d-inline-block px-3 py-1 rounded"
                                style="background-color: #28a745; color: #fff;">
                                Espace Administrateur</h3>
                        </div>

                        <div class="ms-md-auto py-2 py-md-0">
                            {{-- <a href="#" class="btn btn-label-primary btn-round me-2">Liste Année</a> --}}
                            <a href="{{ url('admin/subject/add') }}" class="btn btn-primary btn-round">Ajouter
                                une matière</a>
                        </div>
                    </div>
                    @include('_message')
                    <div class="card my-4 p-2">
                        <div class="card-header" style="font-size: 20px;"><b>Espace de recherche...</b>
                        </div>
                        <div class="app-card app-card-settings shadow-sm p-4"
                            style="background-color:#d8e0de; color:#fff;">

                            <div class="card-body">
                                <form class="settings-form" method="GET" action="">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="setting-input-1" class="form-label"><b>Nom de la
                                                    matière</b></label>
                                            <input type="text" class="form-control" id="setting-input-1"
                                                name="name" value="{{ Request::get('name') }}"
                                                placeholder="Entrez le nom de matière">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="setting-input-3" class="form-label"><b>Type de
                                                    matière</b></label>
                                            <select name="type" required class="form-control">
                                                <option value="">
                                                    ~~~~~~~~~~~~~~~~~~Veillez
                                                    choisir le type
                                                    de matières~~~~~~~~~~~~~~~~~~
                                                </option>
                                                <option {{ Request::get('type') == 'Théorique' ? 'selected' : '' }}
                                                    value="Théorique">Théorique</option>
                                                <option {{ Request::get('type') == 'Pratique' ? 'selected' : '' }}
                                                    value="Pratique">Pratique</option>
                                            </select>

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="setting-input-3" class="form-label"><b>Veillez choisir une
                                                    Date</b></label>
                                            <input type="date" class="form-control" id="setting-input-3"
                                                name="date" value="{{ Request::get('date') }}">
                                        </div>

                                        <div class="col-md-2 mb-3"><button type="submit" class="btn btn-primary"
                                                style="margin-top: 30px;"><b>Rechercher</b></button>
                                            <a href="{{ url('admin/subject/list') }}" class="btn btn-danger"
                                                style="margin-top: 30px">Effacer</a>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="card my-4 p-4">
                        <div class="card-header d-flex justify-content-between align-items-center"
                            style="font-size: 20px;">

                            <b>Liste des matières</b>

                            <span class="app-page-title px-3 py-1 rounded"
                                style="background-color: #28a745; color: #fff; font-size:14px;">
                                <b> Total de matière : {{ $getRecord->total() }}</b>
                            </span>

                        </div>

                        <div class="app-card app-card-settings shadow-sm p-4">
                            <div class="card-body">
                                <form class="settings-form" method="" action="">
                                    {{ csrf_field() }}

                                    <div class="row">

                                        <table class="table table-striped mt-3">
                                            <thead class="table-success">
                                                <tr>
                                                    <th>N°##</th>
                                                    <th>Nom de la matière</th>
                                                    <th>Status</th>
                                                    <th>Type de matière</th>
                                                    <th>Créé Par</th>
                                                    <th>Date création</th>
                                                    <th>Date modification</th>
                                                    <th class="text-center">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($getRecord as $value)
                                                    <tr>
                                                        <td>{{ $value->id }}</td>
                                                        <td>{{ $value->name }}</td>
                                                        <td>
                                                            @if ($value->status == 0)
                                                                Active
                                                            @else
                                                                Inactive
                                                            @endif
                                                        </td>
                                                        <td>{{ $value->type }}</td>
                                                        <td>{{ $value->created_by_name }}</td>
                                                        <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}
                                                        </td>
                                                        <td>{{ date('d-m-Y H:i A', strtotime($value->updated_at)) }}
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="d-flex justify-content-center gap-2">
                                                                <a href="{{ url('admin/subject/edit/' . $value->id) }}"
                                                                    class="btn btn-sm btn-primary">
                                                                    Modifier
                                                                </a>
                                                                <a href="{{ url('admin/subject/delete/' . $value->id) }}"
                                                                    class="btn btn-sm btn-danger">
                                                                    Supprimer
                                                                </a>

                                                            </div>
                                                        </td>
                                                @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end mt-1">
                                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>

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

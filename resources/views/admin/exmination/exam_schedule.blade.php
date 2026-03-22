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

                        {{-- <div class="ms-md-auto py-2 py-md-0"> --}}
                        {{-- <a href="#" class="btn btn-label-primary btn-round me-2">Liste Année</a> --}}
                        {{-- <a href="{{ url('admin/examination/exam/add') }}" class="btn btn-primary btn-round">Ajouter
                                un examen</a>
                        </div> --}}
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
                                        <div class="col-md-5 mb-3">
                                            <label class="form-label">
                                                <b>Examen</b> <span style="color:red">*</span>
                                            </label>

                                            <select name="exam_id" id="exam_select" class="form-control" size="1"
                                                onfocus="this.size=10;" onblur="this.size=1;"
                                                onchange="this.size=1; this.blur();">

                                                <option value="">~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Veillez choisir
                                                    un
                                                    examen~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                </option>

                                                @foreach ($getExam as $exam)
                                                    <option {{ Request::get('exam_id') == $exam->id ? 'selected' : '' }}
                                                        value="{{ $exam->id }}">
                                                        {{ $exam->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>


                                        <div class="col-md-5 mb-3">
                                            <label class="form-label">
                                                <b>Classe</b> <span style="color:red">*</span>
                                            </label>

                                            <select name="class_id" id="class_select" class="form-control"
                                                size="1" onfocus="this.size=10;" onblur="this.size=1;"
                                                onchange="this.size=1; this.blur();">

                                                <option value="">~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Veillez choisir
                                                    une
                                                    classe~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                </option>

                                                @foreach ($getClass as $class)
                                                    <option
                                                        {{ Request::get('class_id') == $class->id ? 'selected' : '' }}
                                                        value="{{ $class->id }}">
                                                        {{ $class->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>


                                        <div class="col-md-2 mb-3"><button type="submit" class="btn btn-primary"
                                                style="margin-top: 30px"><b>Rechercher</b></button>
                                            <a href="{{ url('admin/examination/exam/list') }}" class="btn btn-danger"
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

                            <b>Calendrier des examens</b>

                            {{-- <span class="app-page-title px-3 py-1 rounded"
                                style="background-color: #28a745; color: #fff; font-size:14px;">
                                <b> Total d'examen : {{ $getRecord->total() }}</b>
                            </span> --}}

                        </div>


                        @if (!@empty($getRecord))
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="card-body">
                                    <form class="settings-form" method="post"
                                        action="{{ url('admin/examination/exam_schedule_insert') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="exam_id" value=" {{ Request::get('exam_id') }}">
                                        <input type="hidden" name="class_id" value=" {{ Request::get('class_id') }}">
                                        <div class="row">

                                            <table class="table table-striped mt-3">
                                                <thead class="table-success">
                                                    <tr>
                                                        <th>Non de la matière</th>
                                                        <th>Date de l'examen</th>
                                                        <th>Date de debut</th>
                                                        <th>Datede fin</th>
                                                        <th>Numero de classe</th>
                                                        <th>Note maximal</th>
                                                        <th>Note de passage</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($getRecord as $value)
                                                        <tr>
                                                            {{-- <td> {{ $loop->iteration }} </td> --}}
                                                            <td>{{ $value['subject_name'] }}
                                                                <input type="hidden"
                                                                    name="schedule[{{ $i }}][subject_id]"
                                                                    class="form-control"
                                                                    value="{{ $value['subject_id'] }}">
                                                            </td>
                                                            <td><input type="date"
                                                                    name="schedule[{{ $i }}][exam_date]"
                                                                    class="form-control"
                                                                    value="{{ $value['exam_date'] }}"></td>
                                                            <td><input type="time"
                                                                    name="schedule[{{ $i }}][start_time]"
                                                                    class="form-control"
                                                                    value="{{ $value['start_time'] }}"></td>
                                                            <td><input type="time"
                                                                    name="schedule[{{ $i }}][end_time]"
                                                                    class="form-control"
                                                                    value="{{ $value['end_time'] }}"></td>
                                                            <td><input type="text"
                                                                    name="schedule[{{ $i }}][room_number]"
                                                                    class="form-control"
                                                                    value="{{ $value['room_number'] }}"></td>
                                                            <td><input type="text"
                                                                    name="schedule[{{ $i }}][full_marks]"
                                                                    class="form-control"
                                                                    value="{{ $value['full_marks'] }}"></td>
                                                            <td><input type="text"
                                                                    name="schedule[{{ $i }}][passing_mark]"
                                                                    class="form-control"
                                                                    value="{{ $value['passing_mark'] }}"></td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div style="text-align: right; padding:10px">
                                                <button class="btn btn-primary">Enregistrer</button>
                                            </div>

                                        </div>

                                    </form>
                                </div>
                            </div>
                        @endif
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

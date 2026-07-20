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
                                Espace Elève</h3>
                        </div>


                    </div>
                    @include('_message')


                    <div class="card my-4 p-4">
                        <div class="card-header d-flex justify-content-between align-items-center"
                            style="font-size: 20px;">

                            <b>Resultats des évaluations</b>

                            <span class="px-3 py-1 rounded"
                                style="background-color:#87912c; color:#fff; font-size:14px; display:inline-block; width:auto;">
                                {{ $getStudent->name }} {{ $getStudent->last_name }}
                            </span>

                            {{-- <span class="app-page-title px-3 py-1 rounded"
                                style="background-color: #28a745; color: #fff; font-size:14px;">
                                <b>Total de matière : {{ $getRecord->count() }}</b>
                            </span> --}}

                        </div>

                        <div class="app-card app-card-settings shadow-sm p-4">
                            <div class="card-body">
                                <form class="settings-form" method="" action="">
                                    {{ csrf_field() }}

                                    <div class="row">

                                        <tbody>
                                            @foreach ($getRecord as $value)
                                                <div class="card mt-4">

                                                    <div class="card-header table-success">
                                                        <h4 class="mt-1 app-page-title d-inline-block px-3 py-1 rounded"
                                                            style="background-color: #4654f6; color: #fff;">
                                                            {{ $value['exam_name'] }}
                                                        </h4>
                                                    </div>


                                                    <div class="card-body">

                                                        <table class="table table-striped">

                                                            <thead class="table-success">
                                                                <tr>
                                                                    <th>Nom matière</th>
                                                                    <th>Prémière Interrogation</th>
                                                                    <th>Deuxième Interrogation</th>
                                                                    <th>Devoir classe 1</th>
                                                                    <th>Devoir classe 2</th>
                                                                    <th>Devoir niveau</th>
                                                                    <th>Total de point obtenue</th>
                                                                    <th>Note passage</th>
                                                                    <th>Total de point des matières</th>
                                                                    <th>Resultat</th>
                                                                    <th>Decision Final</th>
                                                                </tr>
                                                            </thead>


                                                            <tbody>
                                                                @php
                                                                    $total_general = 0;
                                                                    $total_general_full_marks = 0;
                                                                    $total_passing_marks = 0;
                                                                @endphp

                                                                @foreach ($value['subject'] as $subject)
                                                                    @php
                                                                        $totalDePointObtenu =
                                                                            $subject['Interrogation_1'] +
                                                                            $subject['Interrogation_2'] +
                                                                            $subject['Devoir_de_classe_1'] +
                                                                            $subject['Devoir_de_classe_2'] +
                                                                            $subject['Devoir_de_niveau'];

                                                                        $total_general += $totalDePointObtenu;

                                                                        $total_general_full_marks +=
                                                                            $subject['full_marks'];

                                                                        $total_passing_marks +=
                                                                            $subject['passing_marks'];
                                                                    @endphp
                                                                    <tr>
                                                                        <td style="width: 250px">
                                                                            {{ $subject['subject_name'] }}</td>

                                                                        <td>{{ $subject['Interrogation_1'] }}</td>

                                                                        <td>{{ $subject['Interrogation_2'] }}</td>

                                                                        <td>{{ $subject['Devoir_de_classe_1'] }}
                                                                        </td>

                                                                        <td>{{ $subject['Devoir_de_classe_2'] }}
                                                                        </td>

                                                                        <td>{{ $subject['Devoir_de_niveau'] }}</td>

                                                                        <td> {{ $subject['Interrogation_1'] +
                                                                            $subject['Interrogation_2'] +
                                                                            $subject['Devoir_de_classe_1'] +
                                                                            $subject['Devoir_de_classe_2'] +
                                                                            $subject['Devoir_de_niveau'] }}
                                                                        </td>

                                                                        <td>
                                                                            {{ $subject['passing_marks'] }}
                                                                        </td>

                                                                        <td>{{ $subject['full_marks'] }}</td>


                                                                        <td>
                                                                            {{ $totalDePointObtenu }}
                                                                            / {{ $subject['full_marks'] }}
                                                                        </td>



                                                                        <td>
                                                                            @if ($totalDePointObtenu >= $subject['passing_marks'])
                                                                                <span
                                                                                    style="color: green"><b>Validé</b></span>
                                                                            @else
                                                                                <span
                                                                                    style="color: red"><b>Refusé</b></span>
                                                                            @endif
                                                                        </td>


                                                                    </tr>
                                                                @endforeach

                                                                <tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <b>TOTAL Général : {{ $total_general }} /
                                                                            {{ $total_general_full_marks }}</b>
                                                                    </td>

                                                                    <td colspan="2">
                                                                        <b>POURCENTAGE :
                                                                            {{ round(($total_general * 100) / $total_general_full_marks, 2) }}%</b>
                                                                    </td>

                                                                    <td colspan="3">
                                                                        <b>POINT DE PASSAGE OBTENU :
                                                                            {{ $total_general }} /
                                                                            {{ $total_passing_marks }}</b>
                                                                    </td>

                                                                    <td colspan="4">
                                                                        <b>DECISION GLOBALE DEFINITIVE :</b>

                                                                        @if ($total_general >= $total_passing_marks)
                                                                            <span class="badge bg-success fs-6">
                                                                                Vous êtes déclaré Admis
                                                                            </span>
                                                                        @else
                                                                            <span class="badge bg-danger fs-6">
                                                                                Vous êtes déclaré Refusé
                                                                            </span>
                                                                        @endif

                                                                    </td>

                                                                </tr>

                                                                </tr>

                                                            </tbody>

                                                        </table>

                                                    </div>

                                                </div>


                                                <div style="height:30px"></div>
                                            @endforeach

                                        </tbody>
                                        </table>

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

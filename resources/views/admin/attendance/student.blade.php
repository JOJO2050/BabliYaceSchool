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
                    <div id="success_message" class="alert alert-success" style="display:none;"></div>
                    <div id="error_message" class="alert alert-danger" style="display:none;"></div>
                    <div class="card my-4 p-2">
                        <div class="card-header" style="font-size: 20px;"><b>Espace de recherche...</b>
                        </div>
                        <div class="app-card app-card-settings shadow-sm p-4"
                            style="background-color:#d8e0de; color:#fff;">

                            <div class="card-body">
                                <form class="settings-form" method="GET"
                                    action="{{ url('admin/attendance/student') }}">


                                    <div class="row">

                                        <div class="col-md-3 mb-3">


                                            <label class="form-label">
                                                <b>Classe</b> <span style="color:red">*</span>
                                            </label>

                                            <select name="class_id" class="form-control" required id="getClass">

                                                <option value="">
                                                    ~~~~~~~~~~~~~ Veuillez choisir une classe
                                                    ~~~~~~~~~~~~~~~~~
                                                </option>

                                                @foreach ($getClass as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ Request::get('class_id') == $class->id ? 'selected' : '' }}>
                                                        {{ $class->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>


                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">
                                                <b>Matière</b> <span style="color:red">*</span>
                                            </label>

                                            <select name="subject_id" class="form-control" required id="getSubject">

                                                <option value="">
                                                    ~~~~~~~~~~~~~ Veuillez choisir une matière
                                                    ~~~~~~~~~~~~~~~~~
                                                </option>

                                                @if (!empty($getSubject))

                                                    @foreach ($getSubject as $subject)
                                                        <option value="{{ $subject->subject_id }}"
                                                            {{ Request::get('subject_id') == $subject->subject_id ? 'selected' : '' }}>
                                                            {{ $subject->subject_name }}
                                                        </option>
                                                    @endforeach

                                                @endif

                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">
                                                <b>Date de pointage</b> <span style="color:red">*</span>
                                            </label>
                                            <input type="date" class="form-control" name="attendance_date" required
                                                value="{{ Request::get('attendance_date') }}" id="getAttendanceDate">
                                        </div>


                                        <div class="col-md-2 mb-3">
                                            <button type="submit" class="btn btn-primary" style="margin-top:30px">
                                                <b>Rechercher</b>
                                            </button>

                                            <a href="{{ url('admin/attendance/student') }}" class="btn btn-danger"
                                                style="margin-top:30px">
                                                Effacer
                                            </a>
                                        </div>
                                    </div>

                            </div>

                            </form>
                        </div>

                    </div>
                </div>

                <div class="app-card app-card-settings shadow-sm p-4">

                    @if (Request::get('class_id') && Request::get('attendance_date'))

                        <div class="card-body">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="font-size: 20px;">
                                <b>Liste de pointage de présence</b>
                            </div>
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th>Numero matricule</th>
                                        <th>Nom et prenom de l'eleve</th>
                                        <th class="text-center">Pointage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($getStudent) && $getStudent->count() > 0)
                                        @foreach ($getStudent as $value)
                                            @php
                                                $attendance_type = '';
                                                $getAttendance = $value->getAttendance(
                                                    Request::get('class_id'),
                                                    Request::get('subject_id'),
                                                    Request::get('attendance_date'),
                                                    $value->id,
                                                );

                                                if (!empty($getAttendance)) {
                                                    $attendance_type = $getAttendance->attendance_type;
                                                }

                                            @endphp
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name }} {{ $value->last_name }}</td>
                                                <td class="text-center">

                                                    <label style="margin-right: 15px"><input type="radio"
                                                            name="attendance{{ $value->id }}" value="1"
                                                            id="{{ $value->id }}"
                                                            {{ $attendance_type == '1' ? 'checked' : '' }}
                                                            class="SaveAttendance">Présent</label>

                                                    <label style="margin-right: 15px"><input type="radio"
                                                            name="attendance{{ $value->id }}" value="2"
                                                            id="{{ $value->id }}"
                                                            {{ $attendance_type == '2' ? 'checked' : '' }}
                                                            class="SaveAttendance">Absent</label>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

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
    <script>
        $('#getClass').on('change', function() {

            var class_id = $(this).val();

            // Si aucune classe n'est sélectionnée
            // if (class_id == '') {

            //     $('#getSubject').html(
            //         '<option value="">~~~~~~~~~ Il existe pas de matière pour cette classse ~~~~~~</option>'
            //     );

            //     return;
            // }

            $.ajax({
                url: "{{ url('admin/attendance/get-subject') }}",
                type: "GET",
                data: {
                    class_id: class_id
                },
                dataType: "json",
                success: function(data) {

                    $('#getSubject').html('');

                    // Vérifie si des matières existent
                    if (data.length > 0) {

                        $('#getSubject').append(
                            '<option value="">~~~~~~~~~~~~~~ Veuillez choisir une matière ~~~~~~~~~~~~~~~</option>'
                        );

                        $.each(data, function(key, value) {

                            $('#getSubject').append(
                                '<option value="' + value.subject_id + '">' +
                                value.subject_name +
                                '</option>'
                            );

                        });

                    } else {

                        $('#getSubject').html(
                            '<option value="">~~~~~~~~~ Il existe pas de matière pour cette classse ~~~~~~</option>'
                        );

                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);

                    $('#getSubject').html(
                        '<option value="">Erreur lors du chargement des matières</option>'
                    );
                }
            });

        });
    </script>
    <script>
        $(".SaveAttendance").change(function(e) {
            var student_id = $(this).attr("id");
            var attendance_type = $(this).val();
            var class_id = $("#getClass").val();
            var subject_id = $("#getSubject").val();
            var attendance_date = $("#getAttendanceDate").val();



            $.ajax({
                type: "POST",
                url: "{{ url('admin/attendance/student/save') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    class_id: class_id,
                    subject_id: subject_id,
                    attendance_date: attendance_date,
                    student_id: student_id,
                    attendance_type: attendance_type
                },

                dataType: "json",

                success: function(data) {

                    if (data.status) {

                        $("#error_message").hide();

                        $("#success_message")
                            .removeClass("alert-danger")
                            .addClass("alert-success")
                            .html(data.message)
                            .fadeIn();

                        setTimeout(function() {
                            $("#success_message").fadeOut();
                        }, 4000);

                    } else {

                        $("#success_message").hide();

                        $("#error_message")
                            .html(data.message)
                            .fadeIn();

                        setTimeout(function() {
                            $("#error_message").fadeOut();
                        }, 4000);
                    }

                }
            });
        });
    </script>
</body>

</html>

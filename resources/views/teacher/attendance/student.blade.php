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
<link rel="stylesheet" href="{{ asset('assets1/css/kaiadmin.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets1/css/demo.css') }}">

<div class="wrapper">
    @include('layouts.sidebar')
    <div class="main-panel">
        <div class="main-header">
            <div class="main-header-logo">
                <div class="logo-header" data-background-color="dark">
                    <a href="{{ url('/') }}" class="logo">
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
                            Espace Professeur
                        </h3>
                    </div>
                </div>

                @include('_message')

                <div id="success_message" class="alert alert-success" style="display:none;">
                </div>

                <div id="error_message" class="alert alert-danger" style="display:none;">
                </div>
                <div class="card my-4 p-2">
                    <div class="card-header" style="font-size: 20px;">
                        <b>Espace de recherche...</b>
                    </div>

                    <div class="app-card app-card-settings shadow-sm p-4" style="background-color:#d8e0de;">
                        <div class="card-body">
                            <form class="settings-form" method="GET"
                                action="{{ url('teacher/attendance/student') }}">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">
                                            <b>Classe</b>
                                            <span style="color:red">*</span>
                                        </label>

                                        <select name="class_id" class="form-control" required id="getClass">
                                            <option value="">
                                                ~~~~~~~~~~~~~
                                                Veuillez choisir une classe
                                                ~~~~~~~~~~~~~
                                            </option>

                                            @if (!empty($getClassSubject))

                                                @foreach ($getClassSubject as $classSubject)
                                                    <option value="{{ $classSubject->class_id }}"
                                                        {{ Request::get('class_id') == $classSubject->class_id ? 'selected' : '' }}>

                                                        {{ $classSubject->class_name }}

                                                    </option>
                                                @endforeach

                                            @endif


                                        </select>

                                    </div>

                                    <div class="col-md-4 mb-3">

                                        <label class="form-label">

                                            <b>Date de pointage</b>

                                            <span style="color:red">*</span>

                                        </label>

                                        <input type="date" class="form-control" name="attendance_date" required
                                            value="{{ Request::get('attendance_date') }}" id="getAttendanceDate">

                                    </div>

                                    <div class="col-md-4 mb-3">

                                        <label class="form-label">
                                            <b>Matière lié a cette classe</b>
                                        </label>

                                        <input type="text" class="form-control" value="{{ $subject_name ?? '' }}"
                                            readonly>
                                        <input type="hidden" name="subject_id" id="getSubject"
                                            value="{{ $subject_id ?? '' }}">

                                    </div>

                                    <div class="col-md-1 mb-3">
                                        <button type="submit" class="btn btn-primary" style="margin-top:30px"
                                            title="Rechercher">
                                            <i class="fas fa-search"></i>
                                        </button>

                                        <a href="{{ url('teacher/attendance/student') }}" class="btn btn-danger"
                                            style="margin-top:30px" title="Effacer les filtres">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="app-card app-card-settings shadow-sm p-4">

                    @if (Request::filled('class_id') && Request::filled('attendance_date'))

                        <div class="card-body">

                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="font-size: 20px;">

                                <b>
                                    Liste de pointage de présence
                                </b>

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
                                                    $subject_id,
                                                    Request::get('attendance_date'),
                                                    $value->id,
                                                );

                                                if (!empty($getAttendance)) {
                                                    $attendance_type = $getAttendance->attendance_type;
                                                }
                                            @endphp

                                            <tr>

                                                <td>
                                                    {{ $value->id }}
                                                </td>

                                                <td>
                                                    {{ $value->name }}
                                                    {{ $value->last_name }}
                                                </td>

                                                <td class="text-center">

                                                    <label style="margin-right: 15px">

                                                        <input type="radio" name="attendance{{ $value->id }}"
                                                            value="1" id="{{ $value->id }}"
                                                            {{ $attendance_type == '1' ? 'checked' : '' }}
                                                            class="SaveAttendance">

                                                        Présent

                                                    </label>

                                                    <label style="margin-right: 15px">

                                                        <input type="radio" name="attendance{{ $value->id }}"
                                                            value="2" id="{{ $value->id }}"
                                                            {{ $attendance_type == '2' ? 'checked' : '' }}
                                                            class="SaveAttendance">

                                                        Absent

                                                    </label>

                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>

                                            <td colspan="3" class="text-center">

                                                <span class="text-danger">
                                                    Aucun élève trouvé dans cette classe.
                                                </span>

                                            </td>

                                        </tr>

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

<script>
    $(".SaveAttendance").change(function(e) {

        var student_id = $(this).attr("id");
        var attendance_type = $(this).val();
        var class_id = $("#getClass").val();
        var subject_id = $("#getSubject").val();
        var attendance_date = $("#getAttendanceDate").val();

        if (class_id == '') {

            alert("Veuillez sélectionner une classe.");

            return;
        }

        if (subject_id == '') {

            alert("La matière n'a pas été trouvée.");
            return;

        }

        if (attendance_date == '') {

            alert("Veuillez sélectionner une date.");

            return;

        }


        $.ajax({

            type: "POST",

            url: "{{ url('teacher/attendance/student/save') }}",

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

            },


            error: function(xhr) {


                $("#success_message").hide();


                var message = "Une erreur est survenue.";


                if (
                    xhr.responseJSON &&
                    xhr.responseJSON.message
                ) {

                    message = xhr.responseJSON.message;

                }


                $("#error_message")

                    .html(message)

                    .fadeIn();


                setTimeout(function() {

                    $("#error_message").fadeOut();

                }, 4000);

            }

        });


    });
</script>
</body>

</html>

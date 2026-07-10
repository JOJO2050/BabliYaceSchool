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
                                <form class="settings-form" method="GET" action="">


                                    <div class="row">
                                        <div class="col-md-5 mb-3">
                                            <label class="form-label">
                                                <b>Niveau</b> <span style="color:red">*</span>
                                            </label>

                                            <select name="exam_id" id="exam_select" class="form-control" size="1"
                                                onfocus="this.size=10;" onblur="this.size=1;"
                                                onchange="this.size=1; this.blur();">

                                                <option value="">~~~~~~~~~~~~~~~~~~~~~~~~~Veillez choisir
                                                    un
                                                    type d'évalution~~~~~~~~~~~~~~~~~~~~~~~~~~
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
                                            <a href="{{ url('admin/examination/marks_register') }}"
                                                class="btn btn-danger" style="margin-top: 30px">Effacer</a>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="app-card app-card-settings shadow-sm p-4">

                        <div class="card-body">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="font-size: 20px;">

                                <b>Liste des notes liées aux differents types d'evaluation</b>

                                <span class="app-page-title px-3 py-1 rounded"
                                    style="background-color: #28a745; color: #fff; font-size:14px;">
                                    {{-- <b> Total Elève : {{ $getRecord->total() }}</b> --}}
                                </span>

                            </div>

                            <div class="row">

                                <tbody>
                                    @if (request()->filled('exam_id') && request()->filled('class_id'))

                                        <div class="table-responsive">

                                            <table class="table table-striped mt-3">

                                                <thead class="table-success">
                                                    <tr>
                                                        <th>Nom et prénom de l'élève</th>

                                                        @if (!empty($getSubject) && $getSubject->count() > 0)
                                                            @foreach ($getSubject as $subject)
                                                                <th>
                                                                    {{ $subject->subject_name }} <br />
                                                                    ({{ $subject->subject_type }} :
                                                                    {{ $subject->passing_mark }}/{{ $subject->full_marks }})
                                                                </th>
                                                            @endforeach
                                                        @endif

                                                        <th class="text-end align-middle">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if (!empty($getSubject) && $getSubject->count() > 0)

                                                        @if (!empty($getStudent) && $getStudent->count() > 0)

                                                            @foreach ($getStudent as $student)
                                                                <tr>

                                                                    <form class="SubmitForm">

                                                                        {{ csrf_field() }}

                                                                        <input type="hidden" name="student_id"
                                                                            value="{{ $student->id }}">

                                                                        <input type="hidden" name="exam_id"
                                                                            value="{{ Request::get('exam_id') }}">

                                                                        <input type="hidden" name="class_id"
                                                                            value="{{ Request::get('class_id') }}">

                                                                        <td>
                                                                            {{ $student->name }}
                                                                            {{ $student->last_name }}
                                                                        </td>

                                                                        @php
                                                                            $i = 1;
                                                                            $totalStudentMark = 0;
                                                                            $totalFullMarks = 0;
                                                                            $totalPassingMarks = 0;
                                                                        @endphp

                                                                        @foreach ($getSubject as $subject)
                                                                            @php
                                                                                $totalMark = 0;

                                                                                $totalFullMarks =
                                                                                    $totalFullMarks +
                                                                                    $subject->full_marks;

                                                                                $totalPassingMarks =
                                                                                    $totalPassingMarks +
                                                                                    $subject->passing_mark;

                                                                                $getMark = $subject->getMark(
                                                                                    $student->id,
                                                                                    Request::get('exam_id'),
                                                                                    Request::get('class_id'),
                                                                                    $subject->subject_id,
                                                                                );

                                                                                if (!empty($getMark)) {
                                                                                    $totalMark =
                                                                                        $getMark->Interrogation_1 +
                                                                                        $getMark->Interrogation_2 +
                                                                                        $getMark->Devoir_de_classe_1 +
                                                                                        $getMark->Devoir_de_classe_2 +
                                                                                        $getMark->Devoir_de_niveau;
                                                                                }
                                                                                $totalStudentMark =
                                                                                    $totalStudentMark + $totalMark;
                                                                            @endphp
                                                                            <td>

                                                                                <div style="margin-bottom: 10px;">
                                                                                    Interrogation 1

                                                                                    <input type="hidden"
                                                                                        name="mark[{{ $i }}][subject_id]"
                                                                                        value="{{ $subject->subject_id }}">

                                                                                    <input type="text"
                                                                                        name="mark[{{ $i }}][Interrogation_1]"
                                                                                        id="Interrogation_1_{{ $student->id }}{{ $subject->subject_id }}"
                                                                                        value="{{ !empty($getMark->Interrogation_1) ? $getMark->Interrogation_1 : '' }}"
                                                                                        class="form-control"
                                                                                        style="width: 200px">
                                                                                </div>

                                                                                <div style="margin-bottom: 10px;">
                                                                                    Interrogation 2

                                                                                    <input type="text"
                                                                                        name="mark[{{ $i }}][Interrogation_2]"
                                                                                        id="Interrogation_2_{{ $student->id }}{{ $subject->subject_id }}"
                                                                                        value="{{ !empty($getMark->Interrogation_2) ? $getMark->Interrogation_2 : '' }}"
                                                                                        class="form-control"
                                                                                        style="width: 200px">
                                                                                </div>

                                                                                <div style="margin-bottom: 10px;">
                                                                                    Devoir de classe 1

                                                                                    <input type="text"
                                                                                        name="mark[{{ $i }}][Devoir_de_classe_1]"
                                                                                        id="Devoir_de_classe_1_{{ $student->id }}{{ $subject->subject_id }}"
                                                                                        value="{{ !empty($getMark->Devoir_de_classe_1) ? $getMark->Devoir_de_classe_1 : '' }}"
                                                                                        class="form-control"
                                                                                        style="width: 200px">
                                                                                </div>

                                                                                <div style="margin-bottom: 10px;">
                                                                                    Devoir de classe 2

                                                                                    <input type="text"
                                                                                        name="mark[{{ $i }}][Devoir_de_classe_2]"
                                                                                        id="Devoir_de_classe_2_{{ $student->id }}{{ $subject->subject_id }}"
                                                                                        value="{{ !empty($getMark->Devoir_de_classe_2) ? $getMark->Devoir_de_classe_2 : '' }}"
                                                                                        class="form-control"
                                                                                        style="width: 200px">
                                                                                </div>

                                                                                <div style="margin-bottom: 10px;">
                                                                                    Devoir de niveau

                                                                                    <input type="text"
                                                                                        name="mark[{{ $i }}][Devoir_de_niveau]"
                                                                                        id="Devoir_de_niveau_{{ $student->id }}{{ $subject->subject_id }}"
                                                                                        value="{{ !empty($getMark->Devoir_de_niveau) ? $getMark->Devoir_de_niveau : '' }}"
                                                                                        class="form-control"
                                                                                        style="width: 200px">
                                                                                </div>

                                                                                <div style="margin-bottom: 10px;">
                                                                                    <button type="button"
                                                                                        class="btn btn-primary SaveSingleSubject"
                                                                                        id="{{ $student->id }}"
                                                                                        data-val="{{ $subject->subject_id }}"
                                                                                        data-exam="{{ Request::get('exam_id') }}"
                                                                                        data-schedule="{{ $subject->id }}"
                                                                                        data-class="{{ Request::get('class_id') }}">Enregistrement
                                                                                        unique</button>
                                                                                </div>

                                                                                @if (!empty($getMark))
                                                                                    <div style="margin-bottom: 10px;">
                                                                                        <b>Total de point :
                                                                                        </b>{{ $totalMark }} <br />

                                                                                        <b>Point
                                                                                            de passage :
                                                                                        </b>{{ $subject->passing_mark }}
                                                                                        <br />

                                                                                        <b>Votre moyenne est de :</b>
                                                                                        <br />
                                                                                        <span
                                                                                            class="app-page-title d-inline-block px-1 py-1 rounded"
                                                                                            style="background-color:#72b4a2; color:#fff; font-size:20px;">
                                                                                            {{ number_format($totalMark / 4, 2) }}
                                                                                        </span>
                                                                                        <b>Vous êtes donc declaré</b>
                                                                                        @if ($subject->passing_mark <= $totalMark)
                                                                                            <span
                                                                                                style="color: green; font-weight: bold;">Admis</span>
                                                                                        @else
                                                                                            <span
                                                                                                style="color: red; font-weight: bold;">Refusé</span>
                                                                                        @endif
                                                                                        @php
                                                                                            $pass_fail_vali = 1;
                                                                                        @endphp
                                                                                @endif
                                        </div>



                                        </td>

                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach


                                    <td class="text-end">

                                        <button type="submit" class="btn btn-success mb-4">
                                            Enregistrer
                                        </button>
                                        @if (!empty($totalStudentMark))
                                            <div class="mb-3"></div>
                                            <strong>Total de points de toutes
                                                les
                                                matières : <span
                                                    class="badge bg-danger text-dark fs-6"><b>{{ $totalFullMarks }}</b></span></strong><br>
                            </div>
                            <br />
                            <div class="mb-3">
                                <strong>Total de points de passage
                                    de
                                    l'élève : <span
                                        class="badge bg-success text-dark fs-6"><b>{{ $totalPassingMarks }}</b></span></strong><br>

                            </div>

                            <div class="mb-3">
                                <strong>Total de points de l'élève
                                    dans
                                    toutes les matières : <span
                                        class="badge bg-warning text-dark fs-6"><b>{{ $totalStudentMark }}</b></span></strong><br>
                            </div>
                            @php
                                $percentage = ($totalStudentMark * 100) / $totalFullMarks;
                            @endphp
                            <br>
                            <div class="mb-3"><b>Pourcentage :</b>{{ round($percentage, 2) }}%</div>


                            @if ($totalStudentMark >= $totalPassingMarks)
                                <span class="badge bg-success text-dark fs-6">
                                    <b>Vous êtes déclaré Admis</b>
                                </span>
                            @else
                                <span class="badge bg-danger text-dark fs-6">
                                    <b>Vous êtes déclaré Refusé</b>
                                </span>
                            @endif
                            @endif

                            </td>

                            </form>

                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="{{ ($getSubject->count() ?? 0) + 2 }}"
                                    class="text-center text-danger fw-bold">
                                    Aucun élève trouvé pour cette classe.
                                </td>
                            </tr>
                            @endif
                        @else
                            <tr>
                                <td colspan="100%" class="text-center text-danger fw-bold" style="font-size:18px;">
                                    Ce type d'évaluation n'est pas lié à cette classe.
                                </td>
                            </tr>
                            @endif

                            </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-muted fw-bold" style="padding:20px;">
                            Veuillez sélectionner un type d’évaluation et une classe.
                        </div>
                        @endif
                        </form>
                        </tbody>
                        </table>

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
    <script>
        $(".SubmitForm").submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "{{ url('admin/examination/submit_marks_register') }}",
                data: $(this).serialize(),
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

        $(".SaveSingleSubject").click(function(e) {
            var student_id = $(this).attr("id");
            var subject_id = $(this).attr("data-val");
            var exam_id = $(this).attr("data-exam");
            var class_id = $(this).attr("data-class");
            var id = $(this).attr("data-schedule");
            var Interrogation_1 = $("#Interrogation_1_" + student_id + subject_id).val();
            var Interrogation_2 = $("#Interrogation_2_" + student_id + subject_id).val();
            var Devoir_de_classe_1 = $("#Devoir_de_classe_1_" + student_id + subject_id).val();
            var Devoir_de_classe_2 = $("#Devoir_de_classe_2_" + student_id + subject_id).val();
            var Devoir_de_niveau = $("#Devoir_de_niveau_" + student_id + subject_id).val();


            $.ajax({
                type: "POST",
                url: "{{ url('admin/examination/single_submit_marks_register') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    student_id: student_id,
                    subject_id: subject_id,
                    exam_id: exam_id,
                    class_id: class_id,
                    Interrogation_1: Interrogation_1,
                    Interrogation_2: Interrogation_2,
                    Devoir_de_classe_1: Devoir_de_classe_1,
                    Devoir_de_classe_2: Devoir_de_classe_2,
                    Devoir_de_niveau: Devoir_de_niveau,
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

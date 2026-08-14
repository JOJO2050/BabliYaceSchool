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

                                Espace Professeur

                            </h3>

                        </div>

                    </div>


                    @include('_message')


                    <div id="success_message" class="alert alert-success" style="display:none;">
                    </div>


                    <div id="error_message" class="alert alert-danger" style="display:none;">
                    </div>


                    <!-- ================================================= -->
                    <!-- RECHERCHE -->
                    <!-- ================================================= -->

                    <div class="card my-4 p-2">

                        <div class="card-header" style="font-size: 20px;">

                            <b>Espace de recherche...</b>

                        </div>


                        <div class="app-card app-card-settings shadow-sm p-4"
                            style="background-color:#d8e0de; color:#fff;">

                            <div class="card-body">

                                <form class="settings-form" method="GET"
                                    action="{{ url('teacher/attendance/report') }}">

                                    <div class="row">


                                        <!-- ================================================= -->
                                        <!-- CLASSE -->
                                        <!-- ================================================= -->

                                        <div class="col-md-2 mb-3">

                                            <label class="form-label">
                                                <b>Classe</b>
                                            </label>


                                            <select name="class_id" class="form-control" id="getClass">

                                                <option value="">
                                                    ~~~ Veuillez choisir une classe ~~~
                                                </option>


                                                @foreach ($getClass as $class)
                                                    <option value="{{ $class->class_id }}"
                                                        {{ Request::get('class_id') == $class->class_id ? 'selected' : '' }}>

                                                        {{ $class->class_name }}

                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>


                                        <!-- ================================================= -->
                                        <!-- MATIERE -->
                                        <!-- ================================================= -->

                                        <div class="col-md-3 mb-3">

                                            <label class="form-label">
                                                <b>Matière</b>
                                            </label>


                                            <select name="subject_id" class="form-control" id="getSubject">

                                                <option value="">
                                                    ~ Sélectionnez une classe pour voir vos matières ~
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


                                        <!-- ================================================= -->
                                        <!-- MATRICULE ELEVE -->
                                        <!-- ================================================= -->

                                        <div class="col-md-2 mb-3">

                                            <label class="form-label">
                                                <b>Matricule de l'élève</b>
                                            </label>


                                            <input type="text" name="student_id" class="form-control"
                                                placeholder="Ex : 15 ou #MAJ#15"
                                                value="{{ Request::get('student_id') }}">

                                        </div>


                                        <!-- ================================================= -->
                                        <!-- TYPE DE POINTAGE -->
                                        <!-- ================================================= -->

                                        <div class="col-md-2 mb-3">

                                            <label class="form-label">
                                                <b>Type de pointage</b>
                                            </label>


                                            <select name="attendance_type" class="form-control">

                                                <option value="">
                                                    ~~~ Choisir le type ~~~
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


                                        <!-- ================================================= -->
                                        <!-- DATE -->
                                        <!-- ================================================= -->

                                        <div class="col-md-2 mb-3">

                                            <label class="form-label">
                                                <b>Date de pointage</b>
                                            </label>


                                            <input type="date" class="form-control" name="attendance_date"
                                                value="{{ Request::get('attendance_date') }}">

                                        </div>


                                        <!-- ================================================= -->
                                        <!-- BOUTONS -->
                                        <!-- ================================================= -->

                                        <div class="col-md-1 mb-3">

                                            <button type="submit" class="btn btn-primary" style="margin-top:30px"
                                                title="Rechercher">

                                                <i class="fas fa-search"></i>

                                            </button>


                                            <a href="{{ url('teacher/attendance/report') }}" class="btn btn-danger"
                                                style="margin-top:30px" title="Effacer les filtres">

                                                <i class="fas fa-trash"></i>

                                            </a>

                                        </div>


                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>


                    <!-- ================================================= -->
                    <!-- LISTE DES POINTAGES -->
                    <!-- ================================================= -->

                    <div class="app-card app-card-settings shadow-sm p-4">

                        <div class="card-body">

                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="font-size: 20px;">

                                <b>
                                    Liste de pointage de présence
                                </b>

                            </div>


                            <div class="table-responsive">

                                <table class="table table-striped mt-3">

                                    <thead>

                                        <tr>

                                            <th>
                                                Numéro matricule
                                            </th>

                                            <th>
                                                Nom et prénom de l'élève
                                            </th>

                                            <th>
                                                Classe
                                            </th>

                                            <th>
                                                Matière
                                            </th>

                                            <th>
                                                Pointage
                                            </th>

                                            <th>
                                                Date de pointage
                                            </th>

                                            <th>
                                                Créé par
                                            </th>

                                            <th>
                                                Date de création
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        @forelse ($getRecord as $value)
                                            <tr>

                                                <!-- Matricule -->

                                                <td>

                                                    #MAJ#{{ $value->student_id }}

                                                </td>


                                                <!-- Nom -->

                                                <td>

                                                    {{ $value->student_name }}

                                                    {{ $value->student_last_name }}

                                                </td>


                                                <!-- Classe -->

                                                <td>

                                                    {{ $value->class_name }}

                                                </td>


                                                <!-- Matière -->

                                                <td>

                                                    {{ $value->subject_name }}

                                                </td>


                                                <!-- Pointage -->

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


                                                <!-- Date pointage -->

                                                <td>

                                                    <b>Le</b>

                                                    {{ date('d-m-Y', strtotime($value->attendance_date)) }}

                                                </td>


                                                <!-- Créé par -->

                                                <td>

                                                    {{ $value->created_name }}

                                                </td>


                                                <!-- Date création -->

                                                <td>

                                                    Le

                                                    {{ date('d-m-Y', strtotime($value->created_at)) }}

                                                    à

                                                    {{ date('H:i', strtotime($value->created_at)) }}

                                                </td>

                                            </tr>


                                        @empty

                                            <tr>

                                                <td colspan="8" class="text-center">

                                                    <div class="alert alert-info mb-0">

                                                        @if (Request::filled('class_id'))
                                                            Aucun pointage trouvé
                                                            pour cette classe.
                                                        @else
                                                            Sélectionnez une classe
                                                            puis cliquez sur
                                                            rechercher.
                                                        @endif

                                                    </div>

                                                </td>

                                            </tr>
                                        @endforelse

                                    </tbody>

                                </table>

                            </div>


                            <!-- ================================================= -->
                            <!-- PAGINATION -->
                            <!-- ================================================= -->

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


    <!-- ===================================================== -->
    <!-- JAVASCRIPT -->
    <!-- ===================================================== -->

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


    <!-- ===================================================== -->
    <!-- CHARGEMENT DES MATIERES DU PROFESSEUR -->
    <!-- ===================================================== -->

    <script>
        $('#getClass').on('change', function() {

            var class_id = $(this).val();


            // Réinitialiser les matières

            $('#getSubject').html(
                '<option value="">Chargement des matières...</option>'
            );


            // Aucune classe sélectionnée

            if (class_id === '') {

                $('#getSubject').html(
                    '<option value="">~~~ Veuillez choisir une classe ~~~</option>'
                );

                return;
            }


            // AJAX

            $.ajax({

                url: "{{ url('teacher/attendance/get-subject') }}",

                type: "GET",

                data: {
                    class_id: class_id
                },

                dataType: "json",


                success: function(data) {

                    $('#getSubject').html('');


                    // Matières trouvées

                    if (data.length > 0) {

                        $('#getSubject').append(

                            '<option value="">' +
                            '~~~~~~~~ Veuillez choisir une matière ~~~~~~~~' +
                            '</option>'

                        );


                        $.each(data, function(key, value) {

                            $('#getSubject').append(

                                '<option value="' +
                                value.subject_id +
                                '">' +

                                value.subject_name +

                                '</option>'

                            );

                        });

                    }


                    // Aucune matière
                    else {

                        $('#getSubject').html(

                            '<option value="">' +
                            '~~~~~~~~~ Aucune matière pour cette classe ~~~~~~~~~' +
                            '</option>'

                        );

                    }

                },


                error: function(xhr) {

                    console.log(xhr.responseText);

                    $('#getSubject').html(

                        '<option value="">' +
                        'Erreur lors du chargement des matières' +
                        '</option>'

                    );

                }

            });

        });
    </script>


</body>

</html>

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

    <style>
        .btn-action {
            width: 63px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .btn-action:hover {
            transform: translateY(-2px);
        }
    </style>
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

                        <div class="ms-md-auto py-2py-md-0">
                            <a href="{{ url('admin/homework/homework_list') }}" class="btn btn-primary btn-round">Retour
                                sur la
                                liste
                                des devoirs</a>
                        </div>
                    </div>
                    @include('_message')

                    <div class="card my-4 p-2">


                        <div class="card-header" style="font-size:20px;">
                            <b>Espace de recherche</b>
                        </div>

                        <div class="card my-4 p-2">
                            <div class="app-card app-card-settings shadow-sm p-4" style="background-color:#d8e0de;">
                                <div class="card-body">
                                    <form method="GET"
                                        action="{{ url('admin/homework/homework_submitted/' . $homework_id) }}">
                                        <div class="row align-items-end">
                                            <div class="col-md-2 mb-3">
                                                <label for="student_id" class="form-label"><b>ID Élève</b></label>
                                                <input type="text" name="student_id" id="student_id"
                                                    class="form-control" value="{{ Request::get('student_id') }}"
                                                    placeholder="ID élève">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="last_name" class="form-label"><b>Nom</b></label>
                                                <input type="text" name="last_name" id="last_name"
                                                    class="form-control" value="{{ Request::get('last_name') }}"
                                                    placeholder="Nom">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="first_name" class="form-label"><b>Prénom</b></label>
                                                <input type="text" name="first_name" id="first_name"
                                                    class="form-control" value="{{ Request::get('first_name') }}"
                                                    placeholder="Prénom">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label for="homework_date" class="form-label"><b>Date
                                                        d'émission</b></label>
                                                <input type="date" name="homework_date" id="homework_date"
                                                    class="form-control" value="{{ Request::get('homework_date') }}">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label for="submission_date" class="form-label"><b>Date de
                                                        rendu</b></label>
                                                <input type="date" name="submission_date" id="submission_date"
                                                    class="form-control" value="{{ Request::get('submission_date') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <button type="submit" class="btn btn-primary btn-action"
                                                        title="Rechercher">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                    <a href="{{ url('admin/homework/homework_submitted/' . $homework_id) }}"
                                                        class="btn btn-danger btn-action" title="Réinitialiser">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="card my-4 p-4">
                    <div class="card-header d-flex justify-content-between align-items-center"
                        style="font-size: 20px;">

                        <b>Liste des devoirs</b>

                        <span class="app-page-title px-3 py-1 rounded"
                            style="background-color: #28a745; color: #fff; font-size:14px;">
                            <b> Total devoir rendu : {{ $getRecord->total() }}</b>
                        </span>

                    </div>

                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="card-body">
                            <form class="settings-form" method="" action="">
                                {{ csrf_field() }}

                                <div class="row">

                                    <div class="table-responsive">
                                        <table class="table table-striped mt-3">

                                            <thead class="table-success">
                                                <tr>
                                                    <th>N°#MAJ#</th>
                                                    <th>Nom et prénom</th>
                                                    <th>Classe</th>
                                                    <th>Matière</th>
                                                    <th>Fichier PDF du devoir</th>
                                                    <th>Description</th>
                                                    <th>Date de soumission</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse ($getRecord as $value)
                                                    <tr>
                                                        <td>#MAJ#{{ $value->student_id }}</td>
                                                        <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                        <td>{{ $value->class_name }}</td>
                                                        <td>{{ $value->subject_name }}</td>
                                                        <td ">
                                                                         @if (!empty($value->getDocument()))
                                                            <a href="{{ $value->getDocument() }}"
                                                                class="btn btn-success" download>
                                                                <i class="fas fa-file-pdf me-1"></i>Télécharger
                                                            </a>
                                                        @else
                                                            <span class="text-muted">Aucun fichier</span>
                                                @endif
                                                </td>

                                                <td>{!! $value->description !!}</td>
                                                <td>{{ date('d-m-Y', strtotime($value->getHomework->submission_date)) }}
                                                </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center py-4">
                                                        <div class="text-muted">
                                                            <i class="fas fa-search fa-2x mb-2"></i>
                                                            <h5 class="mb-1">Aucun devoir rendu</h5>
                                                            <p class="mb-0">Aucun élève n'a encore envoyé ce
                                                                devoir.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>


                                        </table>
                                    </div>

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
        $(document).ready(function() {

            $('#getClass').change(function() {

                let class_id = $(this).val();

                $('#getSubject')
                    .prop('disabled', true)
                    .html('<option value="">Chargement...</option>');

                if (class_id === '') {

                    $('#getSubject')
                        .prop('disabled', false)
                        .html(
                            '<option value="">Sélectionnez une classe</option>'
                        );

                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/ajax_get_subject/add') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        class_id: class_id
                    },
                    dataType: 'json',

                    success: function(data) {

                        if (data.success === false) {

                            $('#getSubject')
                                .prop('disabled', false)
                                .html(
                                    '<option value="">' +
                                    data.message +
                                    '</option>'
                                );

                            return;
                        }

                        $('#getSubject')
                            .prop('disabled', false)
                            .html(
                                '<option value="">Sélectionnez une matière</option>' +
                                data.html
                            );
                    },

                    error: function(xhr) {

                        console.log(xhr.responseText);

                        $('#getSubject')
                            .prop('disabled', false)
                            .html(
                                '<option value="">Erreur lors du chargement</option>'
                            );
                    }
                });

            });

        });
    </script>

    <script>
        $(document).ready(function() {

            function loadSubjects(class_id, selected_subject_id = '') {

                $('#getSubject')
                    .prop('disabled', true)
                    .html('<option value="">Chargement...</option>');

                if (class_id === '') {

                    $('#getSubject')
                        .prop('disabled', false)
                        .html('<option value="">Sélectionnez une matière</option>');

                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/ajax_get_subject/add') }}",

                    data: {
                        _token: "{{ csrf_token() }}",
                        class_id: class_id
                    },

                    dataType: 'json',

                    success: function(data) {

                        if (data.success === false) {

                            $('#getSubject')
                                .prop('disabled', false)
                                .html(
                                    '<option value="">' +
                                    data.message +
                                    '</option>'
                                );

                            return;
                        }

                        $('#getSubject')
                            .prop('disabled', false)
                            .html(
                                '<option value="">Sélectionnez une matière</option>' +
                                data.html
                            );

                        /*
                         * On remet la matière sélectionnée
                         * après le chargement AJAX.
                         */
                        if (selected_subject_id !== '') {

                            $('#getSubject').val(selected_subject_id);

                        }

                    },

                    error: function(xhr) {

                        console.log(xhr.responseText);

                        $('#getSubject')
                            .prop('disabled', false)
                            .html(
                                '<option value="">Erreur lors du chargement</option>'
                            );
                    }
                });
            }


            /*
             * Quand l'utilisateur change de classe,
             * on recharge les matières.
             */
            $('#getClass').change(function() {

                let class_id = $(this).val();

                loadSubjects(class_id, '');

            });


            /*
             * Récupération de TOUTES les valeurs
             * présentes dans l'URL après une recherche.
             */
            let class_id = "{{ Request::get('class_id', '') }}";
            let subject_id = "{{ Request::get('subject_id', '') }}";
            let created_by = "{{ Request::get('created_by', '') }}";
            let homework_date = "{{ Request::get('homework_date', '') }}";
            let submission_date = "{{ Request::get('submission_date', '') }}";


            /*
             * On remet explicitement les valeurs
             * dans les champs.
             */
            $('#getClass').val(class_id);

            $('#created_by').val(created_by);

            $('#homework_date').val(homework_date);

            $('#submission_date').val(submission_date);


            /*
             * La matière doit attendre le chargement AJAX.
             */
            if (class_id !== '') {

                loadSubjects(class_id, subject_id);

            } else {

                $('#getSubject')
                    .prop('disabled', false)
                    .html('<option value="">Sélectionnez une matière</option>');
            }

        });
    </script>
</body>

</html>

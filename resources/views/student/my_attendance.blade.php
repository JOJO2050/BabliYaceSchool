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

        .attendance-table td:last-child {
            padding-right: 0 !important;
        }

        .table-responsive {
            width: 100%;
            margin: 0 !important;
            padding: 0 !important;
        }

        .app-card-settings .card-body {
            width: 100%;
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
                                Espace Elève
                            </h3>
                        </div>
                    </div>

                    <div class="card my-4 p-2">
                        <div class="card-header" style="font-size: 20px;">
                            <b>Espace de recherche...</b>
                        </div>

                        <div class="app-card app-card-settings shadow-sm p-4" style="background-color:#d8e0de;">

                            <div class="card-body">

                                <form method="GET" action="{{ url('student/my_attendance') }}">

                                    <div class="row">

                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">
                                                <b>Matière</b>
                                            </label>

                                            <select name="subject_id" class="form-control">

                                                <option value="">
                                                    ~~~~~~~~~~~~~ Veillez choisir une matière s'il vous plait
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


                                        <div class="col-md-3 mb-3">

                                            <label class="form-label">
                                                <b>Type de pointage</b>
                                            </label>

                                            <select name="attendance_type" class="form-control">

                                                <option value="">
                                                    ~~~ Tous ~~~
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

                                            <a href="{{ url('student/my_attendance') }}" class="btn btn-danger"
                                                style="margin-top:30px" title="Effacer les filtres">

                                                <i class="fas fa-trash"></i>

                                            </a>

                                        </div>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                    @include('_message')


                    <div id="success_message" class="alert alert-success" style="display:none;">
                    </div>

                    <div id="error_message" class="alert alert-danger" style="display:none;">
                    </div>

                    <div class="app-card app-card-settings shadow-sm p-4">

                        <div class="card-body">

                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="font-size: 20px;">

                                <b>
                                    Liste de pointage de présence
                                </b>
                                <span class="app-page-title px-3 py-1 rounded"
                                    style="background-color: #28a745; color: #fff; font-size:14px;">
                                    <b>Total de pointage : {{ $getRecord->count() }}</b>
                                </span>

                            </div>

                            <div class="table-responsive">

                                <table class="table table-striped attendance-table">

                                    <thead>
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
                                                <td> {{ $value->class_name }} </td>
                                                <td> {{ $value->subject_name }}</td>
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
                                                    {{ ucfirst(\Carbon\Carbon::parse($value->attendance_date)->locale('fr')->translatedFormat('l d F Y')) }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    <div class="alert alert-info mb-0">
                                                        Cher élève veuillez faire une recherche pour voir les pointages
                                                        de présence
                                                        disponibles.
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
        $('#getClass').on('change', function() {
            var class_id = $(this).val();

            // Réinitialiser les matières
            $('#getSubject').html(
                '<option value="">Chargement des matières...</option>'
            );

            // Aucune classe sélectionnée
            if (class_id === '') {
                $('#getSubject').html('<option value="">~~~ Veuillez choisir une classe ~~~</option>');
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

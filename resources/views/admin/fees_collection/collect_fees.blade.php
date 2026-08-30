<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ !empty($header_title) ? $header_title : '' }}-BabliYaceSchoolDashboard</title>
    <meta content="width=device-width,initial-scale=1.0,shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets1/img/kaiadmin/logo_ecole.jpg') }}" type="image/x-icon" />

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

    <link rel="stylesheet" href="{{ asset('assets1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/css/kaiadmin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/css/demo.css') }}">
</head>

<body>

    <div class="wrapper">

        @include('layouts.sidebar')

        <div class="main-panel">

            <div class="main-header">

                <div class="main-header-logo">

                    <div class="logo-header" data-background-color="dark">

                        <a href="index.html" class="logo">
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

            <div class="container">

                <div class="page-inner">

                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">

                        <div>

                            <h3 class="mt-1 app-page-title d-inline-block px-3 py-1 rounded"
                                style="background-color:#28a745;color:#fff;">
                                Espace Administrateur
                            </h3>

                        </div>

                    </div>

                    @include('_message')

                    <div class="card my-4 p-2">

                        <div class="card-header" style="font-size:20px;">
                            <b>Espace de recherche...</b>
                        </div>

                        <div class="app-card app-card-settings shadow-sm p-4"
                            style="background-color:#d8e0de;color:#fff;">

                            <div class="card-body">

                                <form class="settings-form" method="GET"
                                    action="{{ url('admin/fees_collection/collect_fees') }}">

                                    <div class="row">

                                        <div class="col-md-2 mb-3">

                                            <label class="form-label">
                                                <b>Nom de la classe</b>
                                            </label>

                                            <select class="form-control" name="class_id" id="getClass"
                                                style="appearance:auto;-webkit-appearance:auto;">

                                                <option value="">
                                                    Sélectionner une classe
                                                </option>

                                                @foreach ($getClass as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ Request::get('class_id') == $class->id ? 'selected' : '' }}>

                                                        {{ $class->name }}

                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="col-md-2 mb-3">

                                            <label class="form-label">
                                                <b>Selectionner un élève</b>
                                            </label>

                                            <select class="form-control" name="selected_student_id" id="getStudent"
                                                style="appearance:auto;-webkit-appearance:auto;">

                                                <option value="">
                                                    Sélectionner un élève
                                                </option>

                                            </select>

                                        </div>

                                        <div class="col-md-2 mb-3">

                                            <label class="form-label">
                                                <b>Student ID</b>
                                            </label>

                                            <input type="text" class="form-control" name="student_id" id="student_id"
                                                value="{{ Request::get('student_id') }}" placeholder="Ex: 25">

                                        </div>

                                        <div class="col-md-2 mb-3">

                                            <label class="form-label">
                                                <b>Nom de l'élève</b>
                                            </label>

                                            <input type="text" class="form-control" name="name" id="studentName"
                                                value="{{ Request::get('name') }}" placeholder="Entrez le nom">

                                        </div>

                                        <div class="col-md-2 mb-3">

                                            <label class="form-label">
                                                <b>Prénom de l'élève</b>
                                            </label>

                                            <input type="text" class="form-control" name="last_name"
                                                id="studentLastName" value="{{ Request::get('last_name') }}"
                                                placeholder="Entrez le prénom">

                                        </div>

                                        <div class="col-md-2 mb-3">

                                            <button type="submit" class="btn btn-primary" style="margin-top:30px"
                                                title="Rechercher">

                                                <i class="fas fa-search"></i>

                                            </button>

                                            <a href="{{ url('admin/fees_collection/collect_fees') }}"
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

                    <div class="card my-4 p-4">

                        <div class="card-header d-flex justify-content-between align-items-center"
                            style="font-size:20px;">

                            <b>
                                Liste des versements de la scolarité
                            </b>

                            <span class="app-page-title px-3 py-1 rounded"
                                style="background-color:#28a745;color:#fff;font-size:14px;">

                                <b>
                                    Total : {{ $getRecord->total() }}
                                </b>

                            </span>

                        </div>

                        <div class="app-card app-card-settings shadow-sm p-4">

                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table table-striped mt-3">

                                        <thead class="table-success">

                                            <tr>

                                                <th>Matricule</th>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>Classe</th>
                                                <th>Scolarité total</th>
                                                <th>Scolarité payé</th>
                                                <th>Scolarité restant</th>
                                                <th>Date de création</th>
                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            @forelse($getRecord as $value)
                                                <tr>

                                                    <td>
                                                        @#MAJ#{{ $value->id }}
                                                    </td>

                                                    <td>
                                                        {{ $value->name }}
                                                    </td>

                                                    <td>
                                                        {{ $value->last_name }}
                                                    </td>

                                                    <td>
                                                        {{ $value->class_name }}
                                                    </td>

                                                    <td>
                                                        {{ number_format($value->amount) }} FCFA
                                                    </td>

                                                    <td>
                                                        {{ number_format($paidAmounts[$value->id] ?? 0) }} FCFA
                                                    </td>

                                                    <td>
                                                        {{ number_format($remaning_amount[$value->id] ?? 0) }} FCFA
                                                    </td>

                                                    <td>
                                                        {{ date('d-m-Y H:i A', strtotime($value->created_at)) }}
                                                    </td>

                                                    <td>

                                                        <a href="{{ url('admin/fees_collection/collect_fees/add_fees/' . $value->id) }}?return_url={{ urlencode(request()->fullUrl()) }}"
                                                            class="btn btn-success btn-sm">

                                                            <i class="fas fa-money-bill-wave"></i>

                                                            Faire un versement

                                                        </a>


                                                    </td>

                                                </tr>

                                            @empty

                                                <tr>

                                                    <td colspan="8" class="text-center">

                                                        <div class="alert alert-info mb-0">

                                                            @if (Request::filled('class_id') ||
                                                                    Request::filled('student_id') ||
                                                                    Request::filled('name') ||
                                                                    Request::filled('last_name'))
                                                                Aucun élève trouvé avec ces critères.
                                                            @else
                                                                Veuillez sélectionner une classe ou renseigner un
                                                                critère,
                                                                puis cliquer sur le bouton Rechercher.
                                                            @endif

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
        $(document).ready(function() {

            function loadStudents(class_id, selectedStudentId = '') {

                $('#getStudent').html(
                    '<option value="">Chargement des élèves...</option>'
                );

                if (class_id === '') {

                    $('#getStudent').html(
                        '<option value="">Sélectionner un élève</option>'
                    );

                    return;
                }

                $.ajax({

                    url: "{{ url('admin/fees_collection/get_students') }}",

                    type: "GET",

                    data: {
                        class_id: class_id
                    },

                    dataType: "json",

                    success: function(data) {

                        $('#getStudent').html(
                            '<option value="">Sélectionner un élève</option>'
                        );

                        if (data.length > 0) {

                            $.each(data, function(key, value) {

                                var selected = '';

                                if (
                                    selectedStudentId != '' &&
                                    selectedStudentId == value.id
                                ) {
                                    selected = 'selected';
                                }

                                $('#getStudent').append(

                                    '<option value="' +
                                    value.id +
                                    '" data-name="' +
                                    value.name +
                                    '" data-last-name="' +
                                    value.last_name +
                                    '" ' +
                                    selected +
                                    '>' +
                                    value.name +
                                    ' ' +
                                    value.last_name +
                                    '</option>'

                                );

                            });

                            if (selectedStudentId != '') {

                                var selectedOption =
                                    $('#getStudent').find('option:selected');

                                $('#student_id').val(
                                    selectedOption.val() || ''
                                );

                                $('#studentName').val(
                                    selectedOption.attr('data-name') || ''
                                );

                                $('#studentLastName').val(
                                    selectedOption.attr('data-last-name') || ''
                                );

                            }

                        } else {

                            $('#getStudent').html(
                                '<option value="">Aucun élève dans cette classe</option>'
                            );

                        }

                    },

                    error: function(xhr) {

                        console.log(xhr.responseText);

                        $('#getStudent').html(
                            '<option value="">Erreur lors du chargement</option>'
                        );

                    }

                });

            }

            $('#getClass').on('change', function() {

                var class_id = $(this).val();

                $('#student_id').val('');
                $('#studentName').val('');
                $('#studentLastName').val('');

                loadStudents(class_id);

            });

            $('#getStudent').on('change', function() {

                var selectedOption = $(this).find('option:selected');

                var studentId = selectedOption.val();

                var name =
                    selectedOption.attr('data-name') || '';

                var lastName =
                    selectedOption.attr('data-last-name') || '';

                $('#student_id').val(studentId);

                $('#studentName').val(name);

                $('#studentLastName').val(lastName);

            });

            var currentClassId =
                "{{ Request::get('class_id') }}";

            var currentStudentId =
                "{{ Request::get('student_id') }}";

            if (currentClassId !== '') {

                loadStudents(
                    currentClassId,
                    currentStudentId
                );

            }

        });
    </script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ !empty($header_title) ? $header_title : '' }}-BabliYaceSchoolDashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
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

    <style>
        .btn-action {
            width: 63px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all 0.2s ease;
            padding: 0;
        }

        .btn-action:hover {
            transform: translateY(-2px);
        }
    </style>
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
                                Espace Élève
                            </h3>
                        </div>

                        <div class="ms-md-auto py-2 py-md-0">
                            <a href="{{ url('student/dashboard') }}" class="btn btn-primary btn-round">
                                Retour au dashboard
                            </a>
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
                                    <form method="GET" action="{{ url('student/homework/homework_student_submit') }}">
                                        <div class="row g-3 align-items-end">

                                            <div class="col-md-3">
                                                <label for="getSubject" class="form-label">
                                                    <b>Matière</b>
                                                </label>
                                                <select name="subject_id" id="getSubject" class="form-select"
                                                    style="height:40px;">
                                                    <option value="">Toutes les matières</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="homework_date" class="form-label">
                                                    <b>Date d'émission</b>
                                                </label>
                                                <input type="date" name="homework_date" id="homework_date"
                                                    class="form-control" style="height:40px;"
                                                    value="{{ Request::get('homework_date') }}">
                                            </div>

                                            <div class="col-md-2">
                                                <label for="submission_date" class="form-label">
                                                    <b>Date de rendu</b>
                                                </label>
                                                <input type="date" name="submission_date" id="submission_date"
                                                    class="form-control" style="height:40px;"
                                                    value="{{ Request::get('submission_date') }}">
                                            </div>

                                            <div class="col-md-2">
                                                <label for="sent_date" class="form-label">
                                                    <b>Date de soumission</b>
                                                </label>
                                                <input type="date" name="sent_date" id="sent_date"
                                                    class="form-control" style="height:40px;"
                                                    value="{{ Request::get('sent_date') }}">
                                            </div>

                                            <div class="col-md-3">
                                                <div class="d-flex gap-2">
                                                    <button type="submit" class="btn btn-primary btn-action"
                                                        title="Rechercher">
                                                        <i class="fas fa-search"></i>
                                                    </button>

                                                    <a href="{{ url('/student/homework/homework_student_submit') }}"
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

                    <div class="card my-4 p-4">

                        <div class="card-header d-flex justify-content-between align-items-center"
                            style="font-size:20px;">
                            <b>Liste des devoirs envoyé</b>

                            <span class="app-page-title px-3 py-1 rounded"
                                style="background-color:#28a745;color:#fff;font-size:14px;">
                                <b>Total devoir envoyé : {{ $getRecord->total() }}</b>
                            </span>
                        </div>

                        <div class="app-card app-card-settings shadow-sm p-4">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped mt-3">
                                        <thead class="table-success">
                                            <tr>
                                                <th>N°</th>
                                                <th>Classe</th>
                                                <th>Matière</th>
                                                <th>Date d'émission</th>
                                                <th>Date de rendu</th>
                                                <th class="text-center">Fichier reçu</th>
                                                <th>Description du devoir</th>
                                                <th class="text-center">Document envoyé</th>
                                                <th>Description du document</th>
                                                <th class="text-center">Date de soumission</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($getRecord as $value)
                                                <tr>
                                                    <td>{{ $value->id }}</td>
                                                    <td>{{ $value->class_name }}</td>
                                                    <td>{{ $value->subject_name }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($value->getHomework->homework_date)) }}
                                                    </td>
                                                    <td>{{ date('d-m-Y', strtotime($value->getHomework->submission_date)) }}
                                                    </td>
                                                    <td class="text-center" style="background:#eff6ff;">
                                                        @if (!empty($value->getHomework->getDocument()))
                                                            <a href="{{ $value->getHomework->getDocument() }}"
                                                                class="btn btn-primary btn-sm" download>
                                                                <i class="fas fa-file-pdf me-1"></i>Télécharger
                                                            </a>
                                                        @else
                                                            <span class="badge bg-secondary">Aucun fichier</span>
                                                        @endif
                                                    </td>
                                                    <td style="background:#eff6ff;">{!! $value->getHomework->description !!}</td>
                                                    <td class="text-center" style="background:#f0fdf4;">
                                                        @if (!empty($value->getDocument()))
                                                            <a href="{{ $value->getDocument() }}"
                                                                class="btn btn-success btn-sm" download>
                                                                <i class="fas fa-file-pdf me-1"></i>Télécharger
                                                            </a>
                                                        @else
                                                            <span class="badge bg-secondary">Aucun fichier</span>
                                                        @endif
                                                    </td>
                                                    <td style="background:#f0fdf4;">{!! $value->description !!}</td>
                                                    <td class="text-center" style="background:#f0fdf4;">
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-check me-1"></i>
                                                            {{ date('d-m-Y', strtotime($value->created_at)) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="10" class="text-center py-4">
                                                        <div class="text-muted">
                                                            <i class="fas fa-search fa-2x mb-2"></i>
                                                            <h5 class="mb-1">Aucun résultat trouvé</h5>
                                                            <p class="mb-0">Aucun devoir ne correspond à votre
                                                                recherche.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-end mt-2">
                                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('layouts.footer')
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
            let class_id = "{{ Auth::user()->class_id }}";
            let selected_subject_id = "{{ Request::get('subject_id', '') }}";

            $('#getSubject')
                .prop('disabled', true)
                .html('<option value="">Chargement...</option>');

            if (class_id === '') {
                $('#getSubject')
                    .prop('disabled', false)
                    .html('<option value="">Toutes les matières</option>');
                return;
            }

            $.ajax({
                type: 'POST',
                url: "{{ url('student/ajax_get_subject/add') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    class_id: class_id
                },
                dataType: 'json',

                success: function(data) {
                    if (data.success === false) {
                        $('#getSubject')
                            .prop('disabled', false)
                            .html('<option value="">' + data.message + '</option>');
                        return;
                    }

                    $('#getSubject')
                        .prop('disabled', false)
                        .html('<option value="">Toutes les matières</option>' + data.html);

                    if (selected_subject_id !== '') {
                        $('#getSubject').val(selected_subject_id);
                    }
                },

                error: function(xhr) {
                    console.log(xhr.status);
                    console.log(xhr.responseText);

                    $('#getSubject')
                        .prop('disabled', false)
                        .html('<option value="">Erreur lors du chargement</option>');
                }
            });
        });
    </script>

</body>

</html>

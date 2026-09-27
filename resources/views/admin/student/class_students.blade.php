<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $header_title ?? 'Élèves de la classe' }} - BabliYaceSchoolDashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="{{ asset('assets1/img/kaiadmin/logo_ecole.jpg') }}" type="image/x-icon">
    <script src="{{ asset('assets1/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
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
        .student-photo {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%
        }

        .student-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d
        }

        .class-info {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border-radius: 12px
        }

        .class-info h2 {
            font-weight: 700
        }

        .table td {
            vertical-align: middle
        }
    </style>
</head>

<body>
    <div class="wrapper"> @include('layouts.sidebar') <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <div class="logo-header" data-background-color="dark"> <a href="#" class="logo"> <img
                                src="{{ asset('assets1/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                                class="navbar-brand" height="20"> </a>
                        <div class="nav-toggle"> <button class="btn btn-toggle toggle-sidebar"><i
                                    class="gg-menu-right"></i></button> <button
                                class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button> </div>
                        <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
                    </div>
                </div> @include('layouts.header')
            </div>
            <div class="container">
                <div class="page-inner"> @include('_message') <div
                        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="mt-1 app-page-title d-inline-block px-3 py-1 rounded"
                                style="background-color:#28a745;color:#fff;"> <i class="fas fa-school"></i> Classe :
                                {{ $class->name }} </h3>
                            <p class="text-muted mb-0 mt-2">Liste des élèves appartenant à cette classe</p>
                        </div>
                        <div class="ms-md-auto py-2 py-md-0"> <a href="{{ url()->previous() }}"
                                class="btn btn-secondary btn-round"> <i class="fas fa-arrow-left"></i> Retour </a>
                        </div>
                    </div>
                    <div class="card class-info shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h2 class="mb-2"> <i class="fas fa-school me-2"></i> {{ $class->name }} </h2>
                                    <p class="mb-0">Voici la liste complète des élèves inscrits dans cette classe.</p>
                                </div>
                                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                    <div style="font-size:16px;">Effectif total</div>
                                    <div style="font-size:42px;font-weight:bold;">{{ $students->total() }}</div>
                                    <div>élèves</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card my-4 p-2">
                        <div class="card-header d-flex justify-content-between align-items-center"
                            style="font-size:20px;"> <b>Élèves de la classe {{ $class->name }}</b> <span
                                class="app-page-title px-3 py-1 rounded"
                                style="background-color:#28a745;color:#fff;font-size:14px;">
                                <b>{{ $students->total() }} élève(s)</b> </span> </div>
                        <div class="app-card app-card-settings shadow-sm p-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover mt-3">
                                        <thead class="table-success">
                                            <tr>
                                                <th>N°##</th>
                                                <th>Photo</th>
                                                <th>Nom </th>
                                                <th>Prénom</th>
                                                {{-- <th>Nom du parent</th> --}}
                                                <th>Email</th>
                                                <th>Numero d'admission</th>
                                                <th>Numero matricule</th>
                                                {{-- <th>Classe</th> --}}
                                                <th>Genre</th>
                                                <th>Date de naissance</th>
                                                {{-- <th>Contact</th> --}}
                                                <th>Date d'inscription</th>
                                                <th>Groupe sanguin</th>
                                                <th>Status</th>
                                                {{-- <th>Date création</th>
                                                <th>Date modification</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($students as $student)
                                                <tr>
                                                    <td>{{ $student->id }}</td>
                                                    <td>
                                                        @if (!empty($student->getProfile()))
                                                            <img src="{{ $student->getProfile() }}"
                                                                class="student-photo"
                                                                alt="Photo de {{ $student->name }}">
                                                        @else
                                                            <div class="student-avatar"> <i class="fas fa-user"></i>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->last_name }}</td>
                                                    {{-- <td>{{ $student->parent_name ?? '' }}
                                                        {{ $student->parent_last_name ?? '' }}</td> --}}
                                                    <td>{{ $student->email }}</td>
                                                    <td>{{ $student->admission_number }}</td>
                                                    <td>{{ $student->roll_number }}</td>
                                                    {{-- <td> <span class="badge bg-success"> --}}
                                                    {{-- {{ $student->class_name ?? $class->name }} </span> </td> --}}
                                                    <td>{{ $student->gender }}</td>
                                                    <td>
                                                        @if (!empty($student->date_of_birth))
                                                            {{ date('d-m-Y', strtotime($student->date_of_birth)) }}
                                                        @endif
                                                    </td>
                                                    {{-- <td>{{ $student->mobile_number }}</td> --}}
                                                    <td>
                                                        @if (!empty($student->admission_date))
                                                            {{ date('d-m-Y', strtotime($student->admission_date)) }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $student->blood_group }}</td>
                                                    <td>
                                                        @if ($student->status == 0)
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    {{-- <td>
                                                        @if (!empty($student->created_at))
                                                            {{ date('d-m-Y H:i A', strtotime($student->created_at)) }}
                                                            @endif
                                                    </td>
                                                    <td>
                                                        @if (!empty($student->updated_at))
                                                            {{ date('d-m-Y H:i A', strtotime($student->updated_at)) }}
                                                        @endif
                                                    </td> --}}
                                            </tr> @empty <tr>
                                                    <td colspan="18" class="text-center py-5"> <i
                                                            class="fas fa-users fa-3x text-muted mb-3"></i>
                                                        <h5>Aucun élève dans cette classe</h5>
                                                        <p class="text-muted mb-0"> La classe
                                                            <strong>{{ $class->name }}</strong> ne contient
                                                            actuellement aucun élève.
                                                        </p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if ($students->hasPages())
                                    <div class="d-flex justify-content-end mt-3"> {!! $students->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> @include('layouts.footer') </div>
    </div>
    <script src="{{ asset('assets1/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets1/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets1/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets1/js/kaiadmin.min.js') }}"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ !empty($header_title) ? $header_title : '' }} - BabliYaceSchoolDashboard</title>
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
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets1/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
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

            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="mt-1 app-page-title d-inline-block px-3 py-1 rounded"
                                style="background-color: #28a745; color: #fff;">
                                Espace Paramètre
                            </h3>
                        </div>

                        <div class="ms-md-auto py-2 py-md-0">
                            @if (empty($getRecord))
                                <a href="{{ url('admin/parametre/add') }}" class="btn btn-primary btn-round">
                                    <i class="fas fa-plus"></i>
                                    Ajouter une configuration
                                </a>
                            @endif

                        </div>
                    </div>

                    @include('_message')

                    <div class="card my-4 p-4">
                        <div class="card-header d-flex justify-content-between align-items-center"
                            style="font-size: 20px;">
                            <b>Liste des configurations de l'établissement</b>
                        </div>

                        <div class="app-card app-card-settings shadow-sm p-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover mt-3">
                                            <thead class="table-success">
                                                <tr>
                                                    <th class="text-center">N°</th>
                                                    <th>Logo</th>
                                                    <th>Nom de l'établissement</th>
                                                    <th>URL</th>
                                                    <th>Adresse</th>
                                                    <th>créer par</th>
                                                    <th>Date création</th>
                                                    <th>Date modification</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if (!empty($getRecord))
                                                    <tr>
                                                        <td class="text-center">{{ $getRecord->id }}</td>

                                                        <td>
                                                            @if (!empty($getRecord->logo))
                                                                <img src="{{ asset('upload/etablissement/' . $getRecord->logo) }}"
                                                                    alt="Logo établissement"
                                                                    style="width:55px;height:55px;object-fit:cover;border-radius:8px;border:1px solid #ddd;">
                                                            @else
                                                                <div
                                                                    style="width:55px;height:55px;background-color:#f1f1f1;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                                                    <i class="fas fa-school"
                                                                        style="font-size:24px;color:#999;"></i>
                                                                </div>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <strong>{{ $getRecord->nom }}</strong>
                                                        </td>

                                                        <td>
                                                            @if (!empty($getRecord->url))
                                                                <a href="{{ $getRecord->url }}" target="_blank"
                                                                    class="text-primary">
                                                                    {{ $getRecord->url }}
                                                                </a>
                                                            @else
                                                                <span class="text-muted">Non renseignée</span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if (!empty($getRecord->adresse))
                                                                {{ $getRecord->adresse }}
                                                            @else
                                                                <span class="text-muted">Non renseignée</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ !empty($getRecord->createdBy) ? $getRecord->createdBy->name : 'Inconnu' }}
                                                        </td>

                                                        <td>
                                                            {{ !empty($getRecord->created_at) ? date('d-m-Y H:i', strtotime($getRecord->created_at)) : '-' }}
                                                        </td>

                                                        <td>
                                                            {{ !empty($getRecord->updated_at) ? date('d-m-Y H:i', strtotime($getRecord->updated_at)) : '-' }}
                                                        </td>

                                                        <td class="text-center">
                                                            <div class="d-flex justify-content-center gap-2">
                                                                <a href="{{ url('admin/parametre/edit/' . $getRecord->id) }}"
                                                                    class="btn btn-sm btn-primary" title="Modifier">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>

                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-danger"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal{{ $getRecord->id }}"
                                                                    title="Supprimer">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>

                                                            <div class="modal fade"
                                                                id="deleteModal{{ $getRecord->id }}" tabindex="-1"
                                                                aria-labelledby="deleteModalLabel{{ $getRecord->id }}"
                                                                aria-hidden="true">

                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content border-0 shadow">

                                                                        <div class="modal-body text-center p-4">

                                                                            <div class="mb-3">
                                                                                <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center"
                                                                                    style="width:80px;height:80px;">
                                                                                    <i class="fas fa-trash-alt text-danger"
                                                                                        style="font-size:32px;"></i>
                                                                                </div>
                                                                            </div>

                                                                            <h4 class="fw-bold mb-2">
                                                                                Supprimer cette configuration ?
                                                                            </h4>

                                                                            <p class="text-muted mb-4">
                                                                                Êtes-vous sûr de vouloir supprimer
                                                                                <strong>{{ $getRecord->nom }}</strong>
                                                                                ?
                                                                                <br>
                                                                                Cette configuration pourra être
                                                                                remplacée par une nouvelle.
                                                                            </p>

                                                                            <div
                                                                                class="d-flex justify-content-center gap-2">

                                                                                <button type="button"
                                                                                    class="btn btn-light px-4"
                                                                                    data-bs-dismiss="modal">
                                                                                    Annuler
                                                                                </button>

                                                                                <a href="{{ url('admin/parametre/delete/' . $getRecord->id) }}"
                                                                                    class="btn btn-danger px-4">
                                                                                    <i class="fas fa-trash me-1"></i>
                                                                                    Supprimer
                                                                                </a>

                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    <tr>
                                                        <td colspan="8" class="text-center py-4">
                                                            <div class="text-muted">
                                                                <i class="fas fa-school fa-2x mb-2"></i>
                                                                <br>
                                                                Votre configuration d'établissement existe bien.
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="8" class="text-center py-4">
                                                            <div class="text-muted">
                                                                <i class="fas fa-school fa-2x mb-2"></i>
                                                                <br>
                                                                Aucune configuration d'établissement n'a encore été
                                                                enregistrée.
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif



                                            </tbody>
                                        </table>
                                    </div>

                                </div>
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
</body>

</html>

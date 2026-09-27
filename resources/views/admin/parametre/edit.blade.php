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
                            <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                            <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
                        </div>
                        <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
                    </div>
                </div>
                @include('layouts.header')
            </div>

            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="mt-4 app-page-title d-inline-block px-3 py-1 rounded"
                                style="background-color:#28a745;color:#fff;">Espace Paramètre</h3>
                        </div>
                        <div class="ms-md-auto py-2 py-md-0">
                            <a href="{{ url('admin/parametre/etablissement') }}" class="btn btn-primary btn-round">
                                <i class="fas fa-list"></i> Voir la liste des configurations
                            </a>
                        </div>
                    </div>

                    @include('_message')

                    <div class="card my-4 p-4">
                        <div class="card-header" style="font-size:20px;">
                            <b>Modifier la configuration de l'établissement</b>
                        </div>

                        <div class="app-card app-card-settings shadow-sm p-4">
                            <div class="card-body">
                                <form class="settings-form" method="POST"
                                    action="{{ url('admin/parametre/edit/' . $getRecord->id) }}"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="nom" class="form-label"><b>Nom de
                                                    l'établissement</b></label>
                                            <input type="text" class="form-control" id="nom" name="nom"
                                                value="{{ old('nom', $getRecord->nom) }}"
                                                placeholder="Entrez le nom de l'établissement">
                                            @error('nom')
                                                <div class="text-danger"><b>{{ $message }}</b></div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="url" class="form-label"><b>URL de
                                                    l'établissement</b></label>
                                            <input type="text" class="form-control" id="url" name="url"
                                                value="{{ old('url', $getRecord->url) }}"
                                                placeholder="Entrez l'URL de l'établissement">
                                            @error('url')
                                                <div class="text-danger"><b>{{ $message }}</b></div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="logo" class="form-label"><b>Logo de
                                                    l'établissement</b></label>
                                            <input type="file" class="form-control" id="logo" name="logo">
                                            @error('logo')
                                                <div class="text-danger"><b>{{ $message }}</b></div>
                                            @enderror

                                            @if (!empty($getRecord->logo))
                                                <div class="mt-3">
                                                    <p class="mb-2"><b>Logo actuel :</b></p>
                                                    <img src="{{ asset('upload/etablissement/' . $getRecord->logo) }}"
                                                        alt="Logo établissement"
                                                        style="width:100px;height:100px;object-fit:cover;border-radius:10px;border:1px solid #ddd;">
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="adresse" class="form-label"><b>Adresse de
                                                    l'établissement</b></label>
                                            <input type="text" class="form-control" id="adresse" name="adresse"
                                                value="{{ old('adresse', $getRecord->adresse) }}"
                                                placeholder="Entrez l'adresse complète de l'établissement">
                                            @error('adresse')
                                                <div class="text-danger"><b>{{ $message }}</b></div>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> <b>Modifier</b>
                                    </button>
                                    <a href="{{ url('admin/parametre/etablissement') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Annuler
                                    </a>
                                </form>
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

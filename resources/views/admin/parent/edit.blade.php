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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
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
                            <h3 class="mt-4 app-page-title d-inline-block px-3 py-1 rounded"
                                style="background-color: #28a745; color: #fff;">
                                Espace Administrateur</h3>
                        </div>

                        <div class="ms-md-auto py-2 py-md-0">
                            {{-- <a href="#" class="btn btn-label-primary btn-round me-2">Liste Année</a> --}}
                            <a href="{{ url('admin/parent/list') }}" class="btn btn-primary btn-round">Voir Liste des
                                Parents</a>
                        </div>
                    </div>
                    @include('_message')
                    <div class="card my-4 p-4">
                        <div class="card-header" style="font-size: 20px;"><b>Formulaire d'édition des parents</b>
                        </div>
                        <div class="app-card app-card-settings shadow-sm p-4">
                            <div class="card-body">
                                <form class="settings-form" method="POST" action="" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    {{-- Prémière ligne --}}
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="setting-input-1" class="form-label"><b>Nom</b> <span
                                                    style="color: red"><b>*</b></span></label>
                                            <input type="text" class="form-control" id="setting-input-1"
                                                name="name" value="{{ old('name', $getRecord->name) }}"
                                                placeholder="Entrez le Nom">
                                            @error('name')
                                                <div class="text-danger"><b>{{ $message }}</b></div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="setting-input-1" class="form-label"><b>Prénom</b> <span
                                                    style="color: red"><b>*</b></span></label>
                                            <input type="text" class="form-control" id="setting-input-1"
                                                name="last_name" value="{{ old('last_name', $getRecord->last_name) }}"
                                                placeholder="Entrez le Prénom">
                                            @error('last_name')
                                                <div class="text-danger"><b>{{ $message }}</b></div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="setting-input-3" class="form-label"><b>Genre</b> <span
                                                    style="color: red"><b>*</b></span></label>
                                            <select name="gender" class="form-control">
                                                <option value="">
                                                    ~~~~~~~~~~Veillez
                                                    choisir un
                                                    genre~~~~~~~~~~~
                                                </option>
                                                <option
                                                    {{ old('gender', $getRecord->gender) == 'Male' ? 'selected' : '' }}
                                                    value="Male">
                                                    Male</option>
                                                <option
                                                    {{ old('gender', $getRecord->gender) == 'Femelle' ? 'selected' : '' }}
                                                    value="Femelle">
                                                    Femelle</option>
                                                <option
                                                    {{ old('gender', $getRecord->gender) == 'Autre' ? 'selected' : '' }}
                                                    value="Autre">
                                                    Autre</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="setting-input-3" class="form-label"><b>Contact
                                                    Téléphonique</b></label>
                                            <input type="text" class="form-control" id="setting-input-3"
                                                name="mobile_number"
                                                value="{{ old('mobile_number', $getRecord->mobile_number) }}"
                                                placeholder="Entrez le contact">
                                            @error('mobile_number')
                                                <div class="text-danger"><b>{{ $message }}</b></div>
                                            @enderror
                                        </div>

                                    </div>

                                    {{-- Troisième ligne --}}
                                    <div class="row">

                                        <div class="col-md-3 mb-3">
                                            <label for="setting-input-3" class="form-label"><b>Telecharger une
                                                    photo</b></label>
                                            <input type="file" class="form-control" id="setting-input-3"
                                                name="profile_pic">

                                            @if (!empty($getRecord->getProfile()))
                                                <img src="{{ $getRecord->getProfile() }}" style="auto; width: 50px;">
                                            @endif

                                            @error('profile_pic')
                                                <div class="text-danger"><b>{{ $message }}</b></div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="setting-input-3" class="form-label"><b>Profession
                                                </b></label>
                                            <input type="text" class="form-control" id="setting-input-3"
                                                name="occupation"
                                                value="{{ old('occupation', $getRecord->occupation) }}"
                                                placeholder="Entrez la profession">
                                            @error('occupation')
                                                <div class="text-danger"><b>{{ $message }}</b></div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="setting-input-3" class="form-label"><b>Addresse Postal
                                                </b></label>
                                            <input type="text" class="form-control" id="setting-input-3"
                                                name="address" value="{{ old('address', $getRecord->address) }}"
                                                placeholder="Entrez l'Addresse Postal">
                                            @error('address')
                                                <div class="text-danger"><b>{{ $message }}</b></div>
                                            @enderror
                                        </div>


                                        <div class="col-md-3 mb-3">
                                            <label for="setting-input-3" class="form-label"><b>Status</b><span
                                                    style="color: red"><b>*</b></span></label>
                                            <select name="status" class="form-control">
                                                <option value="">
                                                    ~~~~~~~~~~Veillez
                                                    choisir un
                                                    status~~~~~~~~~~~
                                                </option>
                                                <option {{ old('status', $getRecord->status) == 0 ? 'selected' : '' }}
                                                    value="0">
                                                    Active</option>
                                                <option {{ old('status', $getRecord->status) == 1 ? 'selected' : '' }}
                                                    value="1">
                                                    Inactive</option>
                                            </select>
                                        </div>

                                    </div>

                                    <hr>
                                    {{-- Cinquième ligne --}}
                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label for="setting-input-3" class="form-label"><b>Email</b><span
                                                    style="color: red"><b>*</b></span></label>
                                            <input type="email" class="form-control" id="setting-input-3"
                                                name="email" value="{{ old('email', $getRecord->email) }}"
                                                placeholder="Entrez l'email">
                                            @error('email')
                                                <div class="text-danger"><b>{{ $message }}</b></div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="setting-input-3" class="form-label"><b>Mot de
                                                    passe</b><span style="color: red"><b></b></span></label>
                                            <input type="text" class="form-control" id="setting-input-3"
                                                name="password" placeholder="Entrez un mot de passe">
                                            <p style="color: rgb(235, 72, 72)"><b>Pour modifier votre mot de passe,
                                                    veuillez en
                                                    ajouter un
                                                    nouveau.</b></p>
                                            @error('password')
                                                <div class="text-danger"><b>{{ $message }}</b></div>
                                            @enderror
                                        </div>

                                    </div>

                                    <button type="submit" class="btn btn-primary"><b>Enregistrer</b></button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

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
</body>

</html>

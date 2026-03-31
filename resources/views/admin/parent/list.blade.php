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

                        <div class="ms-md-auto py-2 py-md-0">
                            {{-- <a href="#" class="btn btn-label-primary btn-round me-2">Liste Année</a> --}}
                            <a href="{{ url('admin/parent/add') }}" class="btn btn-primary btn-round">Ajouter
                                un Parent</a>
                        </div>
                    </div>
                    @include('_message')
                    <div class="card my-4 p-2">
                        <div class="card-header" style="font-size: 20px;"><b>Espace de recherche...</b>
                        </div>
                        <div class="app-card app-card-settings shadow-sm p-4"
                            style="background-color:#d8e0de; color:#fff;">

                            <div class="card-body">
                                <form class="settings-form" method="GET" action="">
                                    {{ csrf_field() }}
                                    <div class="container-fluid">

                                        <!-- ROW 1 -->
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label"><b>Nom</b></label>
                                                <input type="text" name="name" value="{{ Request::get('name') }}"
                                                    class="form-control" placeholder="Entrer un Nom">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-label"><b>Prénom</b></label>
                                                <input type="text" name="last_name"
                                                    value="{{ Request::get('last_name') }}" class="form-control"
                                                    placeholder="Entrer un Prénom">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-label"><b>Email</b></label>
                                                <input type="email" name="email"
                                                    value="{{ Request::get('email') }}" class="form-control"
                                                    placeholder="Entrer un Email">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-label"><b>Genre</b></label>
                                                <select name="gender" class="form-control">
                                                    <option value="">~~~~~~~~~~~~Selection un
                                                        genre~~~~~~~~~~~~~
                                                    </option>
                                                    <option
                                                        {{ Request::get('gender') == 'Male' ? 'selected' : '' }}value="Male">
                                                        Male</option>
                                                    <option
                                                        {{ Request::get('gender') == 'Femelle' ? 'selected' : '' }}value="Femelle">
                                                        Femelle</option>
                                                    <option
                                                        {{ Request::get('gender') == 'Autre' ? 'selected' : '' }}value="Autre">
                                                        Autre</option>
                                                </select>
                                            </div>


                                        </div>


                                        <!-- ROW 2 -->
                                        <div class="row">

                                            {{-- <div class="col-md-3 mb-3">
                                                <label class="form-label"><b>Profession</b></label>
                                                <input type="text" name="occupation"
                                                    value="{{ Request::get('occupation') }}" class="form-control"
                                                    placeholder="Entrer une profession">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-label"><b>Contact</b></label>
                                                <input type="text" name="mobile_number"
                                                    value="{{ Request::get('mobile_number') }}" class="form-control"
                                                    placeholder="Entrer le Contact">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-label"><b>Addresse Postale</b></label>
                                                <input type="text" name="address"
                                                    value="{{ Request::get('address') }}" class="form-control"
                                                    placeholder="Entrer l'addresse postale">
                                            </div> --}}

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label"><b>Status</b></label>
                                                <select name="status" class="form-control">
                                                    <option value="">~~~~~~~~~~~~Selection un
                                                        status~~~~~~~~~
                                                    </option>
                                                    <option {{ Request::get('status') == 100 ? 'selected' : '' }}
                                                        value="100">
                                                        Active</option>
                                                    <option {{ Request::get('status') == 1 ? 'selected' : '' }}
                                                        value="1">
                                                        Inactive</option>

                                                </select>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label"><b>Date De creation</b></label>
                                                <input type="date" name="created_at"
                                                    value="{{ Request::get('created_at') }}" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label"><b>Date de modification</b></label>
                                                <input type="date" name="updated_at"
                                                    value="{{ Request::get('updated_at') }}" class="form-control">
                                            </div>
                                        </div>


                                        <!-- ROW 4 -->
                                        <div class="row">

                                            {{-- <div class="col-md-6 mb-3">
                                                <label class="form-label"><b>Date De creation</b></label>
                                                <input type="date" name="created_at"
                                                    value="{{ Request::get('created_at') }}" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label"><b>Date de modification</b></label>
                                                <input type="date" name="updated_at"
                                                    value="{{ Request::get('updated_at') }}" class="form-control">
                                            </div> --}}
                                        </div>

                                        <!-- ROW 5 (BOUTONS) -->
                                        <div class="row">

                                            <div class="col-md-12 d-flex justify-content-end gap-3 mt-2">

                                                <button type="submit" class="btn btn-primary px-5">
                                                    🔍 Rechercher
                                                </button>

                                                <a href="{{ url()->current() }}" class="btn btn-danger px-5">
                                                    ❌ Effacer
                                                </a>

                                            </div>

                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="card my-4 p-4">
                        <div class="card-header d-flex justify-content-between align-items-center"
                            style="font-size: 20px;">

                            <b>Liste des parents</b>

                            <span class="app-page-title px-3 py-1 rounded"
                                style="background-color: #28a745; color: #fff; font-size:14px;">
                                <b> Total Parent : {{ $getRecord->total() }}</b>
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
                                                        <th>N°##</th>
                                                        <th>photo</th>
                                                        <th>Nom </th>
                                                        <th>Prénom</th>
                                                        <th class="text-center">>Email</th>
                                                        <th>Genre</th>
                                                        <th>Profession</th>
                                                        <th>Contact</th>
                                                        <th>Address Postal</th>
                                                        <th>Status</th>
                                                        <th>Date création</th>
                                                        <th>Date modification</th>
                                                        <th class="text-center">Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($getRecord as $value)
                                                        <tr>
                                                            <td>{{ $value->id }}</td>
                                                            <td>
                                                                @if (!empty($value->getProfile()))
                                                                    <img src="{{ $value->getProfile() }}"
                                                                        style="heigth:50px; width: 50px; border-radius: 50px;">
                                                                @endif
                                                            </td>
                                                            <td>{{ $value->name }}</td>
                                                            <td>{{ $value->last_name }}</td>
                                                            <td>{{ $value->email }}</td>
                                                            <td>{{ $value->gender }}</td>
                                                            <td>{{ $value->occupation }}</td>
                                                            <td>{{ $value->mobile_number }}</td>
                                                            <td>{{ $value->address }}</td>
                                                            <td>{{ $value->status == 0 ? 'Active ' : 'Inactive' }}</td>
                                                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}
                                                            </td>
                                                            <td>{{ date('d-m-Y H:i A', strtotime($value->updated_at)) }}
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center gap-2">
                                                                    <a href="{{ url('admin/parent/edit/' . $value->id) }}"
                                                                        class="btn btn-sm btn-primary">
                                                                        Modifier
                                                                    </a>
                                                                    <a href="{{ url('admin/parent/delete/' . $value->id) }}"
                                                                        class="btn btn-sm btn-danger">
                                                                        Supprimer
                                                                    </a>
                                                                    <a href="{{ url('admin/parent/my_student/' . $value->id) }}"
                                                                        class="btn btn-sm btn-warning">
                                                                        élève
                                                                    </a>

                                                                </div>
                                                            </td>
                                                    @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-end mt-1">
                                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                            </div>

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
</body>

</html>

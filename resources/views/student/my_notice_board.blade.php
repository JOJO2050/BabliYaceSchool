<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ !empty($header_title) ? $header_title : 'Read Message' }}-BabliYaceSchoolDashboard</title>
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
    <link rel="stylesheet" href="{{ asset('assets1/css/message.css') }}">

</head>

<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <div class="logo-header" data-background-color="dark">
                        <a href="{{ url('/') }}" class="logo">
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
                    <div
                        class="d-flex align-items-center justify-content-between flex-column flex-md-row pt-3 pb-3 message-page-header">
                        <div>
                            <h3 class="mt-1 app-page-title d-inline-block px-3 py-1 rounded"
                                style="background-color: #28a745; color: #fff;">
                                Espace Eleve
                            </h3>
                        </div>
                    </div>
                    @include('_message')

                    <div class="card my-4 p-2">
                        <div class="card-header" style="font-size: 20px;"><b>Espace de recherche...</b>
                        </div>
                        <div class="app-card app-card-settings shadow-sm p-4"
                            style="background-color:#d8e0de; color:#fff;">

                            <div class="card-body">

                                <form method="GET" action="{{ url('student/my_notice_board') }}">
                                    <div class="row align-items-end">

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">
                                                <b>Titre de l'information</b>
                                            </label>

                                            <input type="text" class="form-control" name="title"
                                                value="{{ request()->input('title', '') }}"
                                                placeholder="Entrez le titre de l'information">
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">
                                                <b>Date de publication à partir du ?</b>
                                            </label>

                                            <input type="date" class="form-control" name="notice_date_from"
                                                value="{{ request()->input('notice_date_from', '') }}">
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">
                                                <b>Date de publication jusqu'au ?</b>
                                            </label>

                                            <input type="date" class="form-control" name="notice_date_to"
                                                value="{{ request()->input('notice_date_to', '') }}">
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <div class="d-flex align-items-end gap-2" style="height: 100%;">
                                                <button type="submit" class="btn btn-primary" title="Rechercher">
                                                    <i class="fas fa-search"></i>
                                                </button>

                                                <a href="{{ url('student/my_notice_board') }}" class="btn btn-danger"
                                                    title="Effacer les filtres">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>


                    <div class="information-header">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <h3 class="message-subject">
                                        Ma liste d'information
                                    </h3>
                                    <span class="app-page-title px-3 py-1 rounded"
                                        style="background-color: #28a745; color: #fff; font-size:14px;">
                                        <b>Total d'information reçu : {{ $getRecord->total() }}</b>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($getRecord as $value)
                        <div class="card read-message-card mb-4">
                            <div class="card-body">
                                <div class="sender-info">
                                    <div class="flex-grow-1">
                                        <h5 class="mt-1 app-page-title d-inline-block px-3 py-1 rounded"
                                            style="background-color: #ca8f4f; color: #fff;">
                                            {{ $value->title }}
                                        </h5>
                                    </div>
                                    <div class="message-date"
                                        style="font-weight: bold; color: #575656; font-size: 14px;">
                                        {{ date('d-m-y', strtotime($value->notice_date)) }}
                                        &middot;
                                        {{ \Carbon\Carbon::parse($value->notice_date)->locale('fr')->diffForHumans() }}
                                    </div>


                                </div>
                                <div class="message-content">
                                    {!! $value->message !!}
                                </div>

                            </div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-end mt-3">
                        {{ $getRecord->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
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
        $("#lineChart").sparkline(
            [102, 109, 120, 99, 110, 105, 115], {
                type: "line",
                height: "70",
                width: "100%",
                lineWidth: "2",
                lineColor: "#177dff",
                fillColor: "rgba(23, 125, 255, 0.14)",
            }
        );
        $("#lineChart2").sparkline(
            [99, 125, 122, 105, 110, 124, 115], {
                type: "line",
                height: "70",
                width: "100%",
                lineWidth: "2",
                lineColor: "#f3545d",
                fillColor: "rgba(243, 84, 93, .14)",
            }
        );
        $("#lineChart3").sparkline(
            [105, 103, 123, 100, 95, 105, 115], {
                type: "line",
                height: "70",
                width: "100%",
                lineWidth: "2",
                lineColor: "#ffa534",
                fillColor: "rgba(255, 165, 52, 0.14)",
            }
        );
    </script>
</body>

</html>

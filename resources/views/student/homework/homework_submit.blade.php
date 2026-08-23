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

    <link rel="stylesheet" href="{{ asset('assets1/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets1/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets1/css/notice_board_adm.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets1/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets1/css/send_email.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />

</head>

<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">

            <div class="main-header">

                <div class="main-header-logo">

                    <div class="logo-header" data-background-color="dark">

                        <a href="{{ url('admin/dashboard') }}" class="logo">
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
                                style="background-color:#28a745;color:#fff;">Espace Elève</h3>
                        </div>
                        <div class="ms-md-auto py-2py-md-0">
                            <a href="{{ url('student/homework/homework_list') }}"
                                class="btn btn-primary btn-round">Retour sur la
                                liste
                                des devoirs</a>
                        </div>
                    </div>

                    @include('_message')
                    <div class="card my-4 p-4">

                        <div class="card-header" style="font-size:20px;">
                            <b>Formulaire d'ajout de devoir</b>
                        </div>

                        <div class="app-card app-card-settings shadow-sm p-4">

                            <div class="card-body">

                                <form class="settings-form" method="POST" action="" enctype="multipart/form-data">

                                    @csrf
                                    <div class="row">

                                        <div class="col-md-3 mb-4">
                                            <label><b>Fichier du devoir<span style="color: red">*</span></b></label>
                                            <input type="file" class="form-control" name="document_file" required>
                                            @error('document_file')
                                                <div class="text-danger mt-1"><b>{{ $message }}</b></div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="compose-textarea" class="form-label"><b>Description <span
                                                    style="color: red">*</span></b></label>
                                        <textarea name="description" id="compose-textarea" class="form-control" rows="15" required>{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="text-danger mt-2"><b>{{ $message }}</b></div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <b><i class="fas fa-save"></i> Enregistrer</b>
                                    </button>

                                </form>

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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#compose-textarea').summernote({
                height: 200,
                minHeight: 200,
                maxHeight: 800,
                focus: false,
                placeholder: 'Écrivez votre message ici...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '28', '32', '36',
                    '48', '64'
                ]
            });

        });
    </script>
</body>

</html>

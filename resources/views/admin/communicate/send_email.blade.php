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
                                style="background-color:#28a745;color:#fff;">Espace Administrateur</h3>
                        </div>
                        <div class="ms-md-auto py-2py-md-0">
                            <a href="{{ url('admin/dashboard') }}" class="btn btn-primary btn-round">Retour sur le
                                dashboard</a>
                        </div>
                    </div>

                    @include('_message')
                    <div class="card my-4 p-4">

                        <div class="card-header" style="font-size:20px;">
                            <b>Formulaire d'envoie d'email</b>
                        </div>

                        <div class="app-card app-card-settings shadow-sm p-4">

                            <div class="card-body">

                                <form class="settings-form" method="POST"
                                    action="{{ url('admin/communicate/send_email') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-4 mb-4">
                                            <label for="subject" class="form-label"><b>Objet</b></label>
                                            <input type="text" class="form-control" id="subject" name="subject"
                                                value="{{ old('subject') }}" required
                                                placeholder="Veuillez saisir l'objet" />
                                            @error('subject')
                                                <div class="text-danger mt-1"><b>{{ $message }}</b></div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <label for="message_to" class="form-label"
                                                style="display:block;"><b>Destinataire du message</b></label>

                                            <div class="messageDestination-options">

                                                <label class="messageDestination-option">
                                                    <input type="checkbox" name="message_to" value="2"
                                                        {{ old('message_to') == '2' ? 'checked' : '' }} />
                                                    <span class="messageDestination-content">
                                                        <i class="fas fa-chalkboard-teacher"></i>
                                                        <span>Professeur</span>
                                                    </span>
                                                </label>

                                                <label class="messageDestination-option">
                                                    <input type="checkbox" name="message_to" value="3"
                                                        {{ old('message_to') == '3' ? 'checked' : '' }} />
                                                    <span class="messageDestination-content">
                                                        <i class="fas fa-user-graduate"></i>
                                                        <span>Élève</span>
                                                    </span>
                                                </label>

                                                <label class="messageDestination-option">
                                                    <input type="checkbox" name="message_to" value="4"
                                                        {{ old('message_to') == '4' ? 'checked' : '' }} />
                                                    <span class="messageDestination-content">
                                                        <i class="fas fa-users"></i>
                                                        <span>Parent</span>
                                                    </span>
                                                </label>

                                            </div>
                                            @error('message_to')
                                                <div class="text-danger mt-1"><b>{{ $message }}</b></div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <label for="user-select" class="form-label"><b>Utilisateur</b></label>
                                            <select name="user_id" id="user-select" class="form-control select2"
                                                style="width:100%;"></select>
                                            @error('user_id')
                                                <div class="text-danger mt-1"><b>{{ $message }}</b></div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="compose-textarea" class="form-label"><b>Message</b></label>
                                        <textarea name="message" id="compose-textarea" class="form-control" rows="15">{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="text-danger mt-2"><b>{{ $message }}</b></div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <b><i class="fas fa-paper-plane"></i> Envoyer</b>
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
            $('#user-select').select2({
                placeholder: '~~~~~~~~~~ Veuillez sélectionner un utilisateur ~~~~~~~~~~',
                allowClear: true,
                width: '100%',
                minimumInputLength: 2,
                language: {
                    inputTooShort: function(args) {
                        return 'Veuillez saisir au moins ' + args.minimum + ' caractères';
                    },
                    noResults: function() {
                        return 'Aucun résultat trouvé';
                    },
                    searching: function() {
                        return 'Recherche en cours...';
                    },
                    errorLoading: function() {
                        return 'Impossible de charger les résultats';
                    }
                },
                ajax: {
                    url: "{{ url('admin/communicate/search_user') }}",
                    type: 'GET',
                    dataType: 'json',
                    delay: 300,
                    data: function(params) {
                        return {
                            search: params.term,
                            user_type: $('input[name="message_to"]:checked').val()
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
            $('input[name="message_to"]').on('change', function() {
                $('input[name="message_to"]').not(this).prop('checked', false);
                $('#user-select').val(null).trigger('change');
            });
        });
    </script>
</body>

</html>

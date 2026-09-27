<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ !empty($header_title) ? $header_title : 'Dashboard' }} - BabliYaceSchoolDashboard</title>
    <meta content="width=device-width,initial-scale=1.0,shrink-to-fit=no" name="viewport">
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
    <link rel="stylesheet" href="{{ asset('assets1/css/dashboard.css') }}">
</head>

<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <div class="logo-header" data-background-color="dark">
                        <a href="{{ url('admin/dashboard') }}" class="logo">
                            <img src="{{ asset('assets1/img/kaiadmin/logo_light.svg') }}" alt="logo"
                                class="navbar-brand" height="20">
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

                    <div class="dashboard-header">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <div>
                                <h2>Tableau de bord</h2>
                                <p>Bienvenue dans votre espace de gestion scolaire</p>
                            </div>
                            <div class="mt-3 mt-md-0">
                                <span class="badge bg-white text-primary px-3 py-2">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    {{ now()->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">

                        <div class="col-sm-6 col-xl-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="stat-title">Administrateurs</div>
                                            <div class="stat-number">{{ $TotalAdmin }}</div>
                                            <a href="{{ url('admin/admin/list') }}" class="stat-link text-danger">Voir
                                                les administrateurs <i class="fas fa-arrow-right ms-1"></i></a>
                                        </div>
                                        <div class="stat-icon icon-red"><i class="fas fa-user-shield"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="stat-title">Élèves</div>
                                            <div class="stat-number">{{ $TotalStudent }}</div>
                                            <a href="{{ url('admin/student/list') }}"
                                                class="stat-link text-primary">Voir les élèves <i
                                                    class="fas fa-arrow-right ms-1"></i></a>
                                        </div>
                                        <div class="stat-icon icon-blue"><i class="fas fa-child"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="stat-title">Professeurs</div>
                                            <div class="stat-number">{{ $TotalTeacher }}</div>
                                            <a href="{{ url('admin/teacher/list') }}"
                                                class="stat-link text-success">Voir les professeurs <i
                                                    class="fas fa-arrow-right ms-1"></i></a>
                                        </div>
                                        <div class="stat-icon icon-green"><i class="fas fa-chalkboard-teacher"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="stat-title">Parents</div>
                                            <div class="stat-number">{{ $TotalParent }}</div>
                                            <a href="{{ url('admin/parent/list') }}"
                                                class="stat-link text-warning">Voir les parents <i
                                                    class="fas fa-arrow-right ms-1"></i></a>
                                        </div>
                                        <div class="stat-icon icon-orange"><i class="fas fa-user-friends"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="stat-title">Classes</div>
                                            <div class="stat-number">{{ $TotalClass }}</div>
                                            <a href="{{ url('admin/class/list') }}" class="stat-link text-purple">Voir
                                                les classes <i class="fas fa-arrow-right ms-1"></i></a>
                                        </div>
                                        <div class="stat-icon icon-purple"><i class="fas fa-school"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="stat-title">Matières</div>
                                            <div class="stat-number">{{ $TotalSubject }}</div>
                                            <a href="{{ url('admin/subject/list') }}"
                                                class="stat-link text-secondary">Voir les matières <i
                                                    class="fas fa-arrow-right ms-1"></i></a>
                                        </div>
                                        <div class="stat-icon icon-gray"><i class="fas fa-book-open"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="stat-title">Scolarité reçue ce jour</div>
                                            <div class="stat-number">{{ number_format($getTotalTodayFees) }} FCFA
                                            </div>
                                            <a href="{{ url('admin/fees_collection/collect_fees') }}"
                                                class="stat-link" style="color: #8674f0;">Voir les paiements <i
                                                    class="fas fa-arrow-right ms-1"></i></a>
                                        </div>
                                        <div class="stat-icon icon-purple"><i class="fas fa-money-bill-wave"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="stat-title">Information</div>
                                            <div class="stat-number">{{ $TotalNoticeBoard }}</div>
                                            <a href="{{ url('admin/communicate/notice_board/list') }}"
                                                class="stat-link" style="color: #795548;">
                                                Voir les informations
                                                <i class="fas fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>

                                        <div class="stat-icon icon-brown">
                                            <i class="fas fa-bullhorn"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row g-3 mb-4">

                        <div class="col-md-4">
                            <div class="card dashboard-card">
                                <div class="card-header">
                                    <div class="card-title mb-1">Scolarité</div>
                                    <div class="text-muted small">Situation globale des paiements</div>
                                </div>
                                <div class="card-body">

                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted"><i
                                                class="fas fa-coins text-warning me-1"></i>Scolarité totale</span>
                                        <strong>{{ number_format($feesTotal) }} FCFA</strong>
                                    </div>

                                    <div class="progress mb-4" style="height:10px;">
                                        <div class="progress-bar bg-warning" style="width:100%"></div>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted"><i
                                                class="fas fa-money-bill-wave text-success me-1"></i>Scolarité
                                            reçue</span>
                                        <strong>{{ number_format($feesCollected) }} FCFA</strong>
                                    </div>

                                    <div class="progress mb-4" style="height:10px;">
                                        <div class="progress-bar bg-success"
                                            style="width:{{ min(100, max(0, $feesPercentage)) }}%"></div>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted"><i
                                                class="fas fa-hourglass-half text-danger me-1"></i>Scolarité
                                            restante</span>
                                        <strong>{{ number_format($feesRemaining) }} FCFA</strong>
                                    </div>

                                    <div class="progress mb-4" style="height:10px;">
                                        <div class="progress-bar bg-danger"
                                            style="width:{{ min(100, max(0, $remainingPercentage)) }}%"></div>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <a href="{{ url('admin/fees_collection/collect_fees') }}"
                                            class="btn btn-primary btn-round">
                                            <i class="fas fa-file-invoice-dollar me-1"></i>Gérer la scolarité
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card dashboard-card">
                                <div class="card-header">
                                    <div class="card-title mb-1">Examens</div>
                                    <div class="text-muted small">Activité des évaluations</div>
                                </div>
                                <div class="card-body">

                                    <div class="info-item">
                                        <div class="info-icon badge-soft-primary"><i class="fas fa-book"></i></div>
                                        <div class="flex-grow-1">
                                            <div class="info-title">Type de session</div>
                                            <div class="info-date">Configuré par trimestre</div>
                                        </div>
                                        <strong>{{ $TotalSession }}</strong>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-icon badge-soft-info"><i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="info-title">Calendriers</div>
                                            <div class="info-date">Examens programmés</div>
                                        </div>
                                        <strong>{{ $examScheduleCount }}</strong>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-icon badge-soft-success"><i
                                                class="fas fa-graduation-cap"></i></div>
                                        <div class="flex-grow-1">
                                            <div class="info-title">Évaluations</div>
                                            <div class="info-date">Notes enregistrées</div>
                                        </div>
                                        <strong>{{ $markCount ?? 0 }}</strong>
                                    </div>

                                    <a href="{{ url('admin/examination/exam/list') }}"
                                        class="btn btn-label-primary btn-round w-100 mt-3">Gérer les examens</a>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card dashboard-card">
                                <div class="card-header">
                                    <div class="card-title mb-1">Devoirs</div>
                                    <div class="text-muted small">Suivi des devoirs</div>
                                </div>
                                <div class="card-body">

                                    <div class="info-item">
                                        <div class="info-icon badge-soft-primary"><i class="fas fa-book"></i></div>
                                        <div class="flex-grow-1">
                                            <div class="info-title">Devoirs créés</div>
                                            <div class="info-date">Total des devoirs</div>
                                        </div>
                                        <strong>{{ $homeworkCount ?? 0 }}</strong>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-icon badge-soft-success"><i class="fas fa-check-circle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="info-title">Devoirs remis</div>
                                            <div class="info-date">Travaux envoyés</div>
                                        </div>
                                        <strong>{{ $homeworkSubmitted ?? 0 }}</strong>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-icon badge-soft-warning"><i class="fas fa-clock"></i></div>
                                        <div class="flex-grow-1">
                                            <div class="info-title">En attente</div>
                                            <div class="info-date">À corriger</div>
                                        </div>
                                        <strong>{{ $homeworkPending ?? 0 }}</strong>
                                    </div>

                                    <a href="{{ url('admin/homework/homework_list') }}"
                                        class="btn btn-label-primary btn-round w-100 mt-3">Gérer les devoirs</a>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <div class="card dashboard-card class-statistics-card">

                                <div class="card-header py-3">
                                    <div class="card-title mb-1">Effectif par classe</div>
                                    <div class="text-muted small">Répartition des élèves</div>
                                </div>

                                <div class="card-body py-3">
                                    <div class="class-grid">

                                        @forelse($classStatistics ?? [] as $class)
                                            <a href="{{ url('admin/student/class/' . $class->id) }}"
                                                class="class-box text-decoration-none">
                                                <div class="class-icon"><i class="fas fa-school"></i></div>
                                                <div class="class-name">{{ $class->name }}</div>
                                                <div class="class-count">{{ $class->student_count }} élèves</div>
                                            </a>
                                        @empty
                                            <div class="col-12 text-center py-5 text-muted">
                                                <i class="fas fa-school fa-2x mb-3"></i>
                                                <p class="mb-0">Aucune classe disponible</p>
                                            </div>
                                        @endforelse

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>

            @include('layouts.footer')

        </div>

        <div class="custom-template">
            <div class="title">Settings</div>

            <div class="custom-content">
                <div class="switcher">

                    <div class="switch-block">
                        <h4>Logo Header</h4>
                        <div class="btnSwitch">

                            <button type="button" class="selected changeLogoHeaderColor" data-color="dark"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="white"></button>

                            <br>

                            <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>

                        </div>
                    </div>

                    <div class="switch-block">
                        <h4>Navbar Header</h4>
                        <div class="btnSwitch">

                            <button type="button" class="changeTopBarColor" data-color="dark"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="green"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange"></button>
                            <button type="button" class="changeTopBarColor" data-color="red"></button>
                            <button type="button" class="selected changeTopBarColor" data-color="white"></button>

                            <br>

                            <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="green2"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                            <button type="button" class="changeTopBarColor" data-color="red2"></button>

                        </div>
                    </div>

                    <div class="switch-block">
                        <h4>Sidebar</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeSideBarColor" data-color="white"></button>
                            <button type="button" class="selected changeSideBarColor" data-color="dark"></button>
                            <button type="button" class="changeSideBarColor" data-color="dark2"></button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="custom-toggle">
                <i class="icon-settings"></i>
            </div>

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
        const studentsData = {!! json_encode($studentsChartData ?? [120, 135, 142, 155, 168, 175, 184, 192, 205, 214, 225, 238]) !!};
        const classesLabels = {!! json_encode($classesChartLabels ?? ['6ème', '5ème', '4ème', '3ème', '2nde', '1ère', 'Tle']) !!};
        const classesData = {!! json_encode($classesChartData ?? [30, 38, 35, 42, 36, 31, 26]) !!};
        const attendanceData = {!! json_encode($attendanceChartData ?? [92, 95, 88, 94, 91, 96, 93]) !!};
        const resultsData = {!! json_encode($resultsChartData ?? [11.8, 12.4, 12.9, 13.2, 13.8, 14.1]) !!};

        const studentsChartElement = document.getElementById('studentsChart');
        if (studentsChartElement) {
            new Chart(studentsChartElement, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                    datasets: [{
                        label: 'Élèves',
                        data: studentsData,
                        borderColor: '#177dff',
                        backgroundColor: 'rgba(23,125,255,.10)',
                        borderWidth: 3,
                        fill: true,
                        tension: .4,
                        pointRadius: 4,
                        pointBackgroundColor: '#177dff',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            grid: {
                                color: '#eef1f5'
                            },
                            ticks: {
                                color: '#8b95a5'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#8b95a5'
                            }
                        }
                    }
                }
            });
        }

        const classesChartElement = document.getElementById('classesChart');
        if (classesChartElement) {
            new Chart(classesChartElement, {
                type: 'doughnut',
                data: {
                    labels: classesLabels,
                    datasets: [{
                        data: classesData,
                        backgroundColor: ['#177dff', '#28a745', '#ff9800', '#7b4dff', '#f3545d', '#00a6c7',
                            '#e83e8c'
                        ],
                        borderWidth: 3,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '68%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 15
                            }
                        }
                    }
                }
            });
        }

        const attendanceChartElement = document.getElementById('attendanceChart');
        if (attendanceChartElement) {
            new Chart(attendanceChartElement, {
                type: 'bar',
                data: {
                    labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                    datasets: [{
                        label: 'Présence %',
                        data: attendanceData,
                        backgroundColor: ['#177dff', '#28a745', '#ff9800', '#7b4dff', '#00a6c7', '#e83e8c',
                            '#f3545d'
                        ],
                        borderRadius: 8,
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            grid: {
                                color: '#eef1f5'
                            },
                            ticks: {
                                color: '#8b95a5',
                                callback: value => value + '%'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#8b95a5'
                            }
                        }
                    }
                }
            });
        }

        const resultsChartElement = document.getElementById('resultsChart');
        if (resultsChartElement) {
            new Chart(resultsChartElement, {
                type: 'line',
                data: {
                    labels: ['Période 1', 'Période 2', 'Période 3', 'Période 4', 'Période 5', 'Période 6'],
                    datasets: [{
                        label: 'Moyenne générale',
                        data: resultsData,
                        borderColor: '#7b4dff',
                        backgroundColor: 'rgba(123,77,255,.10)',
                        borderWidth: 3,
                        fill: true,
                        tension: .4,
                        pointRadius: 5,
                        pointBackgroundColor: '#7b4dff',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            min: 0,
                            max: 20,
                            grid: {
                                color: '#eef1f5'
                            },
                            ticks: {
                                color: '#8b95a5'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#8b95a5'
                            }
                        }
                    }
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            let requestRunning = false;
            let lastCount = null;

            function updateChatBadge(count) {
                count = parseInt(count || 0, 10);
                let badge = $("#globalChatCount");
                if (count <= 0) {
                    if (badge.length) {
                        badge.text("").hide();
                    }
                    return;
                }
                if (!badge.length) {
                    let dropdown = $("#messageDropdown");
                    if (!dropdown.length) return;
                    dropdown.append('<span class="notification" id="globalChatCount"></span>');
                    badge = $("#globalChatCount");
                }
                badge.text(count).show();
            }

            function loadChatCount() {
                if (requestRunning) return;
                requestRunning = true;
                $.ajax({
                    type: "POST",
                    url: "{{ url('get_new_chat_messages') }}",
                    data: {
                        receiver_id: "",
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    cache: false,
                    success: function(data) {
                        if (data && data.status === true) {
                            let count = parseInt(data.count || 0, 10);
                            if (count !== lastCount) {
                                lastCount = count;
                                updateChatBadge(count);
                            }
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    },
                    complete: function() {
                        requestRunning = false;
                    }
                });
            }
            loadChatCount();
            setInterval(loadChatCount, 1500);
        });
    </script>

</body>

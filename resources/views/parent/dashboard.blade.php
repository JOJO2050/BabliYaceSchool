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
    <div class="wrapper"> @include('layouts.sidebar') <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <div class="logo-header" data-background-color="dark"> <a href="{{ url('parent/dashboard') }}"
                            class="logo"> <img src="{{ asset('assets1/img/kaiadmin/logo_light.svg') }}" alt="logo"
                                class="navbar-brand" height="20"> </a>
                        <div class="nav-toggle"> <button class="btn btn-toggle toggle-sidebar"><i
                                    class="gg-menu-right"></i></button> <button
                                class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button> </div>
                        <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
                    </div>
                </div> @include('layouts.header_parent')
            </div>
            <div class="container">
                <div class="page-inner">
                    <div class="dashboard-header">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <div>
                                <h2>Tableau de bord</h2>
                                <p>Bienvenue dans votre espace parent</p>
                            </div>
                            <div class="mt-3 mt-md-0"> <span class="badge bg-white text-primary px-3 py-2"> <i
                                        class="fas fa-calendar-alt me-1"></i> {{ now()->format('d/m/Y') }} </span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6 col-xl-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="stat-title">Mes enfants</div>
                                            <div class="stat-number">{{ $total_student ?? 0 }}</div> <a
                                                href="{{ url('parent/my_student') }}"
                                                class="stat-link text-primary">Voir mes enfants <i
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
                                            <div class="stat-title">Présences</div>
                                            <div class="stat-number">{{ $total_present ?? 0 }}</div> <a
                                                href="{{ url('parent/attendance') }}"
                                                class="stat-link text-success">Voir les présences <i
                                                    class="fas fa-arrow-right ms-1"></i></a>
                                        </div>
                                        <div class="stat-icon icon-green"><i class="fas fa-user-check"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="stat-title">Absences</div>
                                            <div class="stat-number">{{ $total_absent ?? 0 }}</div> <a
                                                href="{{ url('parent/attendance') }}"
                                                class="stat-link text-danger">Voir les absences <i
                                                    class="fas fa-arrow-right ms-1"></i></a>
                                        </div>
                                        <div class="stat-icon icon-red"><i class="fas fa-user-times"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="stat-title">Examens</div>
                                            <div class="stat-number">{{ $total_exam ?? 0 }}</div> <a
                                                href="{{ url('parent/examination/exam') }}"
                                                class="stat-link text-purple">Voir les examens <i
                                                    class="fas fa-arrow-right ms-1"></i></a>
                                        </div>
                                        <div class="stat-icon icon-purple"><i class="fas fa-graduation-cap"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="card dashboard-card">
                                <div class="card-header">
                                    <div class="card-title mb-1">Présence</div>
                                    <div class="text-muted small">Situation globale de vos enfants</div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2"> <span class="text-muted"><i
                                                class="fas fa-calendar-check text-primary me-1"></i> Total</span>
                                        <strong>{{ $total_attendance ?? 0 }}</strong>
                                    </div>
                                    <div class="progress mb-4" style="height:10px;">
                                        <div class="progress-bar bg-primary" style="width:100%"></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2"> <span class="text-muted"><i
                                                class="fas fa-check-circle text-success me-1"></i> Présent</span>
                                        <strong>{{ $total_present ?? 0 }}</strong>
                                    </div>
                                    <div class="progress mb-4" style="height:10px;">
                                        <div class="progress-bar bg-success"
                                            style="width:{{ ($total_attendance ?? 0) > 0 ? (($total_present ?? 0) / $total_attendance) * 100 : 0 }}%">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2"> <span class="text-muted"><i
                                                class="fas fa-times-circle text-danger me-1"></i> Absent</span>
                                        <strong>{{ $total_absent ?? 0 }}</strong>
                                    </div>
                                    <div class="progress mb-4" style="height:10px;">
                                        <div class="progress-bar bg-danger"
                                            style="width:{{ ($total_attendance ?? 0) > 0 ? (($total_absent ?? 0) / $total_attendance) * 100 : 0 }}%">
                                        </div>
                                    </div> <a href="{{ url('parent/attendance') }}"
                                        class="btn btn-primary btn-round w-100"> <i
                                            class="fas fa-clipboard-check me-1"></i> Voir les présences </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card dashboard-card">
                                <div class="card-header">
                                    <div class="card-title mb-1">Examens</div>
                                    <div class="text-muted small">Suivi des examens de vos enfants</div>
                                </div>
                                <div class="card-body">
                                    <div class="info-item">
                                        <div class="info-icon badge-soft-primary"><i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="info-title">Examens</div>
                                            <div class="info-date">Examens programmés</div>
                                        </div> <strong>{{ $total_exam ?? 0 }}</strong>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon badge-soft-success"><i
                                                class="fas fa-graduation-cap"></i></div>
                                        <div class="flex-grow-1">
                                            <div class="info-title">Résultats</div>
                                            <div class="info-date">Résultats disponibles</div>
                                        </div> <strong>{{ $total_result ?? 0 }}</strong>
                                    </div> <a href="{{ url('parent/examination/exam') }}"
                                        class="btn btn-label-primary btn-round w-100 mt-3"> Voir les examens </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card dashboard-card">
                                <div class="card-header">
                                    <div class="card-title mb-1">Mes enfants</div>
                                    <div class="text-muted small">Suivi de la scolarité</div>
                                </div>
                                <div class="card-body">
                                    <div class="info-item">
                                        <div class="info-icon badge-soft-primary"><i class="fas fa-child"></i></div>
                                        <div class="flex-grow-1">
                                            <div class="info-title">Enfants inscrits</div>
                                            <div class="info-date">Élèves rattachés à votre compte</div>
                                        </div> <strong>{{ $total_student ?? 0 }}</strong>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon badge-soft-warning"><i class="fas fa-award"></i></div>
                                        <div class="flex-grow-1">
                                            <div class="info-title">Résultats</div>
                                            <div class="info-date">Notes enregistrées</div>
                                        </div> <strong>{{ $total_result ?? 0 }}</strong>
                                    </div> <a href="{{ url('parent/my_student') }}"
                                        class="btn btn-label-primary btn-round w-100 mt-3"> Voir mes enfants </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <div class="card dashboard-card">
                                <div class="card-header">
                                    <div class="card-title mb-1">Mes enfants</div>
                                    <div class="text-muted small">Vue d'ensemble de vos enfants</div>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">

                                        @forelse($students ?? [] as $student)
                                            <div class="col-sm-6 col-md-4 col-xl-3"> <a
                                                    href="{{ url('parent/student/' . $student->id) }}"
                                                    class="quick-card">
                                                    <div class="quick-icon icon-blue"> <i class="fas fa-child"></i>
                                                    </div>
                                                    <div class="quick-title">{{ $student->name }}
                                                        {{ $student->last_name ?? '' }}</div>
                                                    <div class="quick-text"> {{ $student->class_name ?? 'Élève' }}
                                                    </div>
                                            </a> </div> @empty <div class="col-12">
                                                <div class="text-center py-5 text-muted"> <i
                                                        class="fas fa-child fa-2x mb-3"></i>
                                                    <p class="mb-0">Aucun enfant associé à votre compte</p>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <div class="card dashboard-card">
                                <div class="card-header">
                                    <div class="card-title mb-1">Accès rapide</div>
                                    <div class="text-muted small">Accédez rapidement aux principales fonctionnalités
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-6 col-md-3"> <a href="{{ url('parent/my_student') }}"
                                                class="quick-card">
                                                <div class="quick-icon icon-blue"><i class="fas fa-child"></i></div>
                                                <div class="quick-title">Enfants</div>
                                                <div class="quick-text">Voir mes enfants</div>
                                            </a> </div>
                                        <div class="col-6 col-md-3"> <a href="{{ url('parent/attendance') }}"
                                                class="quick-card">
                                                <div class="quick-icon icon-green"><i
                                                        class="fas fa-clipboard-check"></i></div>
                                                <div class="quick-title">Présences</div>
                                                <div class="quick-text">Suivre les présences</div>
                                            </a> </div>
                                        <div class="col-6 col-md-3"> <a href="{{ url('parent/examination/exam') }}"
                                                class="quick-card">
                                                <div class="quick-icon icon-purple"><i
                                                        class="fas fa-graduation-cap"></i></div>
                                                <div class="quick-title">Examens</div>
                                                <div class="quick-text">Voir les examens</div>
                                            </a> </div>
                                        <div class="col-6 col-md-3"> <a href="{{ url('parent/result') }}"
                                                class="quick-card">
                                                <div class="quick-icon icon-red"><i class="fas fa-award"></i></div>
                                                <div class="quick-title">Résultats</div>
                                                <div class="quick-text">Consulter les résultats</div>
                                            </a> </div>
                                        <div class="col-6 col-md-3"> <a href="{{ url('parent/homework') }}"
                                                class="quick-card">
                                                <div class="quick-icon icon-orange"><i class="fas fa-book"></i></div>
                                                <div class="quick-title">Devoirs</div>
                                                <div class="quick-text">Suivre les devoirs</div>
                                            </a> </div>
                                        <div class="col-6 col-md-3"> <a href="{{ url('parent/fees') }}"
                                                class="quick-card">
                                                <div class="quick-icon icon-green"><i
                                                        class="fas fa-file-invoice-dollar"></i></div>
                                                <div class="quick-title">Scolarité</div>
                                                <div class="quick-text">Suivre les paiements</div>
                                            </a> </div>
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
    <script src="{{ asset('assets1/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets1/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
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

</html>

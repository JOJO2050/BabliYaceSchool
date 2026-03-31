<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="{{ url('admin/dashboard') }}" class="logo">
                <img src="{{ asset('assets1/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
            </div>
            <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
        </div>
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                {{--  ESPACE ADMIN --}}
                @if (Auth::user()->user_type == 1)
                    <li class="nav-item">
                        <a href="{{ url('admin/dashboard') }}"
                            class="nav-link {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-section">
                        <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                        <h4 class="text-section">Menu de l'Administrateur</h4>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('admin/admin/list') }}"
                            class="nav-link {{ Request::segment(2) == 'admin' ? 'active' : '' }}">
                            <i class="fas fa-user"></i>
                            <p>Admin</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('admin/teacher/list') }}"
                            class="nav-link {{ Request::segment(2) == 'teacher' ? 'active' : '' }}">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>Professeur</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('admin/student/list') }}"
                            class="nav-link {{ Request::segment(2) == 'student' ? 'active' : '' }}">
                            <i class="fas fa-child"></i>
                            <p>Elève</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('admin/parent/list') }}"
                            class="nav-link {{ Request::segment(2) == 'parent' ? 'active' : '' }}">
                            <i class="fas fa-user-friends"></i>
                            <p>Parent</p>
                        </a>
                    </li>

                    {{-- Menu parent Academique --}}
                    @php
                        $academicPages = [
                            'class',
                            'subject',
                            'assign_subject',
                            'assign_class_teacher',
                            'class_timetable',
                        ];
                        $academicActive = in_array(Request::segment(2), $academicPages);
                    @endphp
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#base"
                            class="nav-link {{ $academicActive ? 'active' : '' }}">
                            <i class="fas fa-layer-group"></i>
                            <p>Academique</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ $academicActive ? 'show' : '' }}" id="base">
                            <ul class="nav nav-collapse">
                                <li class="nav-item">
                                    <a href="{{ url('admin/class/list') }}"
                                        class="nav-link {{ Request::segment(2) == 'class' ? 'active-child' : '' }}">
                                        <i class="fas fa-school"></i>
                                        <p>Classe</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/subject/list') }}"
                                        class="nav-link {{ Request::segment(2) == 'subject' ? 'active-child' : '' }}">
                                        <i class="fas fa-book"></i>
                                        <p>Matière</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/assign_subject/list') }}"
                                        class="nav-link {{ Request::segment(2) == 'assign_subject' ? 'active-child' : '' }}">
                                        <i class="fas fa-sitemap"></i>
                                        <p>Classe + Matière</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/assign_teacher_subject/list') }}"
                                        class="nav-link {{ Request::segment(2) == 'assign_teacher_subject' ? 'active-child' : '' }}">
                                        <i class="fas fa-sitemap"></i>
                                        <p>Professeur + Matière</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/assign_class_teacher/list') }}"
                                        class="nav-link {{ Request::segment(2) == 'assign_class_teacher' ? 'active-child' : '' }}">
                                        <i class="fas fa-sitemap"></i>
                                        <p>Classe + Professeur</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/class_timetable/list') }}"
                                        class="nav-link {{ Request::segment(2) == 'class_timetable' ? 'active-child' : '' }}">
                                        <i class="fas fa-calendar-alt"></i>
                                        <p>Emploie de temps</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    @php
                        $examinationPages = ['exam', 'examSchedule'];
                        $examinationActive = in_array(Request::segment(3), $examinationPages);
                    @endphp

                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#examMenu"
                            class="nav-link {{ $examinationActive ? 'active' : '' }}">
                            <i class="fas fa-layer-group"></i>
                            <p>Examens</p>
                            <span class="caret"></span>
                        </a>

                        <div class="collapse {{ $examinationActive ? 'show' : '' }}" id="examMenu">
                            <ul class="nav nav-collapse">

                                <li class="nav-item">
                                    <a href="{{ url('admin/examination/exam/list') }}"
                                        class="nav-link {{ Request::segment(3) == 'exam' ? 'active-child' : '' }}">
                                        <i class="fas fa-book"></i>
                                        <p>Devoir</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('admin/examination/exam_schedule') }}"
                                        class="nav-link {{ Request::segment(3) == 'exam_schedule' ? 'active-child' : '' }}">
                                        <i class="fas fa-calendar-alt"></i>
                                        <p>Calendrier des examens</p>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a href="{{ url('admin/parameter') }}"
                            class="nav-link {{ Request::segment(2) == 'parameter' ? 'active' : '' }}">
                            <i class="fas fa-cog"></i>
                            <p>Paramètre Profile</p>
                        </a>
                    </li>
                @endif

                {{-- ESPACE PROFESSEUR --}}
                @if (Auth::user()->user_type == 2)
                    <li class="nav-item">
                        <a href="{{ url('teacher/dashboard') }}"
                            class="nav-link {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                        <h4 class="text-section">Menu du Professeur</h4>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('teacher/my_class_subject') }}"
                            class="nav-link {{ Request::segment(2) == 'my_class_subject' ? 'active' : '' }}">
                            <i class="fas fa-book-open"></i>
                            <p>Mes classes & matières</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('teacher/my_student') }}"
                            class="nav-link {{ Request::segment(2) == 'my_student' ? 'active' : '' }}">
                            <i class="fas fa-child"></i>
                            <p>Mes élèves</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('teacher/my_exam_timetable') }}"
                            class="nav-link {{ Request::segment(2) == 'my_exam_timetable' ? 'active' : '' }}">
                            <i class="fas fa-calendar-alt"></i>
                            <p>Calendrier examen </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('teacher/parameter') }}"
                            class="nav-link {{ Request::segment(2) == 'parameter' ? 'active' : '' }}">
                            <i class="fas fa-cog"></i>
                            <p>Paramètre Profile</p>
                        </a>
                    </li>
                @endif

                {{--  ESPACE ELEVÉ --}}
                @if (Auth::user()->user_type == 3)
                    <li class="nav-item">
                        <a href="{{ url('student/dashboard') }}"
                            class="nav-link {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                        <h4 class="text-section">Menu de l'Elève</h4>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('student/my_calendar') }}"
                            class="nav-link {{ Request::segment(2) == 'my_calendar' ? 'active' : '' }}">
                            <i class="fas fa-calendar-alt"></i>
                            <p>Mon Calendrier</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('student/my_subject') }}"
                            class="nav-link {{ Request::segment(2) == 'my_subject' ? 'active' : '' }}">
                            <i class="fas fa-book"></i>
                            <p>Mes matières</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('student/my_timetable') }}"
                            class="nav-link {{ Request::segment(2) == 'my_timetable' ? 'active' : '' }}">
                            <i class="fas fa-calendar-alt"></i>
                            <p>Mon emplois du temps</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('student/my_exam_timetable') }}"
                            class="nav-link {{ Request::segment(2) == 'my_exam_timetable' ? 'active' : '' }}">
                            <i class="fas fa-calendar-alt"></i>
                            <p>Calendrier examen </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ url('student/parameter') }}"
                            class="nav-link {{ Request::segment(2) == 'parameter' ? 'active' : '' }}">
                            <i class="fas fa-cog"></i>
                            <p>Paramètre Profile</p>
                        </a>
                    </li>
                @endif

                {{--  ESPACE PARENT --}}
                @if (Auth::user()->user_type == 4)
                    <li class="nav-item">
                        <a href="{{ url('parent/dashboard') }}"
                            class="nav-link {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                        <h4 class="text-section">Menu du Parent</h4>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('parent/my_student') }}"
                            class="nav-link {{ Request::segment(2) == 'my_student' ? 'active' : '' }}">
                            <i class="fas fa-child"></i>
                            <p>Mes Enfants</p>
                        </a>
                    </li>



                    <li class="nav-item">
                        <a href="{{ url('parent/parameter') }}"
                            class="nav-link {{ Request::segment(2) == 'parameter' ? 'active' : '' }}">
                            <i class="fas fa-cog"></i>
                            <p>Paramètre Profile</p>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>

    {{-- Styles pour parent/enfant actif --}}

    <style>
        /* Parent actif */
        .nav-link.active {
            background-color: #3a3f51;
            color: #fff;
        }

        /* Parent du collapse ouvert (ex : Academique) */
        .nav-link.active-parent {
            background-color: #3a3f51;
            color: #fff;
        }

        /* Enfants du menu collapse */
        .nav-item>.nav-collapse>.nav-item>.nav-link,
        .nav-collapse .nav-item>.nav-link {
            padding-left: 2.5rem !important;
            /* décalage réel */
            font-size: 0.85rem !important;
            /* texte plus petit */
            height: auto !important;
            /* ajuste la hauteur */
            display: flex;
            align-items: center;
        }

        /* Icônes enfants plus petites */
        .nav-collapse .nav-item>.nav-link i {
            font-size: 0.85rem !important;
        }

        /* Enfant actif */
        .nav-link.active-child {
            background-color: #525967 !important;
            color: #fff !important;
        }

        /* Flèche caret */
        .nav-link .caret {
            display: inline-block;
            transition: transform 0.3s ease;
            font-size: 0.8rem;
            margin-left: 5px;
        }

        /* Rotation flèche quand ouvert */
        .nav-link.active .caret {
            transform: rotate(-180deg);
        }
    </style>
</div>

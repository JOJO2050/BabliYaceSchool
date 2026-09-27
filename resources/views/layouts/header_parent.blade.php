<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pe-1"><i class="fa fa-search search-icon"></i></button>
                </div>
                <input type="text" placeholder="Zone de recherche ..." class="form-control">
            </div>
        </nav>
        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false" aria-haspopup="true">
                    <i class="fa fa-search"></i>
                </a>
                <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <form class="navbar-left navbar-form nav-search">
                        <div class="input-group">
                            <input type="text" placeholder="Search ..." class="form-control">
                        </div>
                    </form>
                </ul>
            </li>
            @php
                $AllChatUserCount = App\Models\ChatModel::getAllChatUserCount();
                $isChatPage = request()->is('chat') || request()->is('chat/*');
            @endphp

            <li class="nav-item topbar-icon hidden-caret">
                <a class="nav-link" href="{{ url('chat') }}" id="messageDropdown">
                    <i class="fa fa-comments" style="font-size:23px;"></i>

                    <span class="notification" id="globalChatCount"
                        style="{{ !$isChatPage && $AllChatUserCount > 0 ? '' : 'display:none;' }}">
                        {{ $AllChatUserCount }}
                    </span>
                </a>
            </li>


            <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fas fa-layer-group" style="font-size:23px;"></i>
                </a>
                <div class="dropdown-menu quick-actions animated fadeIn">
                    <div class="quick-actions-header">
                        <span class="title mb-1">Accès rapide</span>
                        <span class="subtitle op-7">Accédez rapidement aux principales fonctionnalités</span>
                    </div>
                    <div class="quick-actions-scroll scrollbar-outer">
                        <div class="quick-actions-items">
                            <div class="row m-0">
                                <a class="col-6 col-md-4 p-0" href="{{ url('admin/admin/list') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-danger rounded-circle"><i
                                                class="fas fa-user-shield"></i></div><span
                                            class="text">Administrateur</span>
                                    </div>
                                </a>
                                <a class="col-6 col-md-4 p-0" href="{{ url('admin/student/list') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-blue rounded-circle"><i class="fas fa-child"></i>
                                        </div><span class="text">Elèves</span>
                                    </div>
                                </a>
                                <a class="col-6 col-md-4 p-0" href="{{ url('admin/teacher/list') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-warning rounded-circle"><i
                                                class="fas fa-chalkboard-teacher"></i></div><span
                                            class="text">Professeurs</span>
                                    </div>
                                </a>
                                <a class="col-6 col-md-4 p-0" href="{{ url('admin/parent/list') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-info rounded-circle"><i
                                                class="fas fa-user-friends"></i></div><span
                                            class="text">Parents</span>
                                    </div>
                                </a>
                                <a class="col-6 col-md-4 p-0" href="{{ url('admin/class/list') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-success rounded-circle"><i class="fas fa-school"></i>
                                        </div><span class="text">Classe</span>
                                    </div>
                                </a>
                                <a class="col-6 col-md-4 p-0" href="{{ url('admin/subject/list') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item rounded-circle" style="background-color:#6c757d;"><i
                                                class="fas fa-book-open"></i></div><span class="text">Matières</span>
                                    </div>
                                </a>
                                <a class="col-6 col-md-4 p-0" href="{{ url('admin/fees_collection/collect_fees') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-secondary rounded-circle"><i
                                                class="fas fa-file-invoice-dollar"></i></div><span
                                            class="text">Scolarité</span>
                                    </div>
                                </a>
                                <a class="col-6 col-md-4 p-0" href="{{ url('admin/examination/exam/list') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item rounded-circle" style="background-color:#b9569b;"><i
                                                class="fas fa-graduation-cap"></i></div><span
                                            class="text">Examens</span>
                                    </div>
                                </a>
                                <a class="col-6 col-md-4 p-0" href="{{ url('admin/attendance/report') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item rounded-circle" style="background-color:#a7b956;"><i
                                                class="fas fa-clipboard-check"></i></div><span
                                            class="text">Présences</span>
                                    </div>
                                </a>
                                <a class="col-6 col-md-4 p-0" href="{{ url('admin/homework/homework_list') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item rounded-circle" style="background-color:#56b9a0;"><i
                                                class="fas fa-book"></i></div><span class="text">Devoirs</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                    aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="{{ Auth::user()->getProfile() }}" alt="image profile"
                            class="avatar-img rounded-circle">
                    </div>
                    <span class="profile-username">
                        <span class="op-7">Bienvenue,</span>
                        <span class="fw-bold">{{ Auth::user()->name }}</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg">
                                    <img src="{{ Auth::user()->getProfile() }}" alt="image profile"
                                        class="avatar-img rounded">
                                </div>
                                <div class="u-text">
                                    <h4>{{ Auth::user()->name }}</h4>
                                    <p class="text-muted">{{ Auth::user()->email }}</p>
                                    <a href="{{ url('profile/profil_detail') }}"
                                        class="btn btn-xs btn-secondary btn-sm">Voir mon Profil</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('logout') }}">Se deconnecter</a>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>

            <!--APP-SIDEBAR-->
            <div class="sticky">
                <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
                <div class="app-sidebar">
                    <div class="side-header">
                        <a class="header-brand1" href="{{ route('index.dashboard') }}">
                            <img src="{{asset('assets/images/brand/logo.png')}}" class="header-brand-img desktop-logo" alt="logo">
                            <img src="{{asset('assets/images/brand/logo-1.png')}}" class="header-brand-img toggle-logo" alt="logo">
                            <img src="{{asset('assets/images/brand/logo-2.png')}}" class="header-brand-img light-logo" alt="logo">
                            <img src="{{asset('assets/images/brand/logo-3.png')}}" class="header-brand-img light-logo1" alt="logo">
                        </a><!-- LOGO -->
                    </div>
                    <div class="main-sidemenu">
                        <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                            </svg>
                        </div>
                        <ul class="side-menu">
                            <?php $Access = session()->get('Access'); ?>
                            <li>
                                <h3>Menu</h3>
                            </li>
                            @if (in_array('index.dashboard', $Access))
                            <li class="slide">
                                <a class="side-menu__item" href="{{ route('index.dashboard') }}">
                                    <div class="fe fe-grid side-menu__icon"></div>
                                    <span class="side-menu__label">Home</span>
                                </a>
                            </li>
                            @endif

                            @if (in_array('cardio.index', $Access))
                            <li class="slide">
                                <a class="side-menu__item" href="{{ route('cardio.index') }}">
                                    <div class="fe fe-users side-menu__icon"></div>
                                    <span class="side-menu__label">Waiting Patients</span>
                                </a>
                            </li>
                            @endif
                            @if (in_array('surgeryType.index', $Access))
                            <li class="slide">
                                <a class="side-menu__item" href="{{ route('surgeryType.index') }}">
                                    <div class="fe fe-scissors side-menu__icon"></div>
                                    <span class="side-menu__label">Surgery Types</span>
                                </a>
                            </li>
                            @endif

                            @if (in_array('user.index', $Access) || in_array('cardio.cardioReport', $Access))
                            <li>
                                <h3>Reports</h3>
                            </li>

                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="#">
                                    <div class="fe fe-lock side-menu__icon"></div>
                                    <span class="side-menu__label">Reports</span><i class="angle fa fa-angle-right"></i>
                                </a>
                                <ul class="slide-menu">
                                    @if (in_array('cardio.cardioReport', $Access))
                                    <li><a href="{{ route('cardio.cardioReport') }}" class="slide-item">Cardio by Status</a></li>
                                    @endif
                                </ul>
                            </li>
                            @endif

                            @if (in_array('user.index', $Access) || in_array('access_model.index', $Access))
                            <li>
                                <h3>Setting</h3>
                            </li>

                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="#">
                                    <div class="fe fe-lock side-menu__icon"></div>
                                    <span class="side-menu__label">Auth</span><i class="angle fa fa-angle-right"></i>
                                </a>
                                <ul class="slide-menu">
                                    @if (in_array('access_model.index', $Access))
                                    <li><a href="{{ route('access_model.index') }}" class="slide-item">Access Model</a></li>
                                    @endif
                                    @if (in_array('user.index', $Access))
                                    <li><a href="{{ route('user.index') }}" class="slide-item">User</a></li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                        </ul>

                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!--/APP-SIDEBAR-->
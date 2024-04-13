        <!--=================================
 header start-->
        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->
            <div class="text-left navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}"><img
                        src="{{ URL::asset('assets/images/logo-dark.png') }}" alt=""></a>
                <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}"><img
                        src="{{ URL::asset('assets/images/logo-icon-dark.png') }}" alt=""></a>
            </div>
            <!-- Top bar left -->
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                        href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
                </li>
                <li class="nav-item">
                    <div class="search">
                        <a class="search-btn not_click" href="javascript:void(0);"></a>
                        <div class="search-box not-click">
                            <input type="text" class="not-click form-control" placeholder="Search" value=""
                                name="search">
                            <button class="search-button" type="submit"> <i
                                    class="fa fa-search not-click"></i></button>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- top bar right -->
            <ul class="nav navbar-nav ml-auto">
                <div class="btn-group mb-1">
                    <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        @if (App::getLocale() == 'ar')
                            {{ LaravelLocalization::getCurrentLocaleName() }}
                            <img src="{{ URL::asset('assets/images/flags/EG.png') }}" alt="">
                        @else
                            {{ LaravelLocalization::getCurrentLocaleName() }}
                            <img src="{{ URL::asset('assets/images/flags/US.png') }}" alt="">
                        @endif
                    </button>
                    <div class="dropdown-menu">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <li class="nav-item fullscreen">
                    <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="ti-bell"></i>
                        <span class="badge badge-danger notification-status"> </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                        <div class="dropdown-header notifications">
                            <strong>Notifications</strong>
                            <a href="{{ route('Quizzes.MarkAsRead_all') }}"
                                class="badge badge-pill badge-warning mr-auto my-auto float-right">قراءة الكل</a>
                            <div class="d-flex mt-3">
                                <p class="dropdown-title-text subtext mb-0 op-6 pb-0 tx-12 ">
                                    عدد الاشعارات غير المقروءة:</p>
                                <span
                                    class="badge badge-pill badge-warning ml-2">({{ auth()->user()->unreadNotifications->count() < 10? '0' .auth()->user()->unreadNotifications->count(): auth()->user()->unreadNotifications->count() }})</span>
                            </div>
                        </div>
                        @foreach (auth()->user()->unreadNotifications as $notification)
                            <div class="dropdown-divider"></div>
                            <a href="{{-- route('InvoicesDetails', $notification->data['id']) --}}" class="dropdown-item">{{ $notification->data['title'] }}
                                {{ $notification->data['user'] }} <small
                                    class="float-right text-muted time">{{ $notification->created_at }}</small> </a>
                        @endforeach
                    </div>
                </li>
                @if (auth('student')->check())
                    <li class="nav-item dropdown ">
                        <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="true"> <i class=" ti-view-grid"></i> </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-big">
                            <div class="dropdown-header">
                                <strong>Quick Links</strong>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="nav-grid">
                                <a href="{{ route('exam.index') }}" class="nav-grid-item"><i
                                        class="ti-check-box text-success"></i>
                                    <h5>Assign Task</h5>
                                </a>
                            </div>
                        </div>
                    </li>
                @elseif(auth('teacher')->check())
                    <li class="nav-item dropdown ">
                        <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="true"> <i class=" ti-view-grid"></i> </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-big">
                            <div class="dropdown-header">
                                <strong>Quick Links</strong>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="nav-grid">
                                <a href="{{ route('quizze.create') }}" class="nav-grid-item"><i
                                        class="ti-files text-primary"></i>
                                    <h5>New Task</h5>
                                </a>
                            </div>
                        </div>
                    </li>
                @else
                    <li class="nav-item dropdown ">
                        <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="true"> <i class=" ti-view-grid"></i> </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-big">
                            <div class="dropdown-header">
                                <strong>Quick Links</strong>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="nav-grid">
                                <a href="{{ route('Quizzes.create') }}" class="nav-grid-item"><i
                                        class="ti-files text-primary"></i>
                                    <h5>New Task</h5>
                                </a>
                            </div>
                        </div>
                    </li>
                @endif

                <li class="nav-item dropdown mr-30">
                    <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        @if (auth('student')->check())
                            @if (Auth::user()->avatar == null)
                                <img src="{{ URL::asset('attachments/profile/user_icon.png') }}">
                            @else
                                <img src="{{ URL::asset('attachments/profile/student/' . Auth::user()->id . '/' . Auth::user()->avatar) }}"
                                    alt="avatar">
                            @endif
                        @elseif(auth('teacher')->check())
                            @if (Auth::user()->avatar == null)
                                <img src="{{ URL::asset('attachments/profile/user_icon.png') }}">
                            @else
                                <img src="{{ URL::asset('attachments/profile/teacher/' . Auth::user()->id . '/' . Auth::user()->avatar) }}"
                                    alt="avatar">
                            @endif
                        @elseif(auth('parent')->check())
                            @if (Auth::user()->avatar == null)
                                <img src="{{ URL::asset('attachments/profile/user_icon.png') }}">
                            @else
                                <img src="{{ URL::asset('attachments/profile/parent/' . Auth::user()->id . '/' . Auth::user()->avatar) }}"
                                    alt="avatar">
                            @endif
                        @else
                            @if (Auth::user()->avatar == null)
                                <img src="{{ URL::asset('attachments/profile/user_icon.png') }}">
                            @else
                                <img src="{{ URL::asset('attachments/profile/Admin/' . Auth::user()->id . '/' . Auth::user()->avatar) }}"
                                    alt="avatar">
                            @endif
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <div class="media">
                                <div class="media-body">
                                    @if (auth('student')->check())
                                        <h5 class="mt-0 mb-0">{{ Auth::user()->name }}</h5>
                                        <span>{{ Auth::user()->email }}</span>
                                    @elseif(auth('teacher')->check())
                                        <h5 class="mt-0 mb-0">{{ Auth::user()->Name }}</h5>
                                        <span>{{ Auth::user()->email }}</span>
                                    @elseif(auth('parent')->check())
                                        <h5 class="mt-0 mb-0">{{ Auth::user()->Name_Father }}</h5>
                                        <span>{{ Auth::user()->email }}</span>
                                    @else
                                        <h5 class="mt-0 mb-0">{{ Auth::user()->name }}</h5>
                                        <span>{{ Auth::user()->email }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        @if (auth('student')->check())
                            <a class="dropdown-item" href="{{ route('profileStudent.index') }}"><i
                                    class="text-warning ti-user"></i>الملف الشحصي</a>
                        @elseif(auth('teacher')->check())
                            <a class="dropdown-item" href="{{ route('profile.index') }}"><i
                                    class="text-warning ti-user"></i>الملف الشحصي</a>
                        @elseif(auth('parent')->check())
                            <a class="dropdown-item" href="{{ route('profileParent.index') }}"><i
                                    class="text-warning ti-user"></i>الملف الشحصي</a>
                        @else
                            <a class="dropdown-item" href="{{ route('profileUser.index') }}"><i
                                    class="text-warning ti-user"></i>الملف الشحصي</a>
                        @endif


                        @if (auth('web')->check())
                            <a class="dropdown-item" href="{{ route('settings.index') }}"><i
                                    class="text-info ti-settings"></i>الاعدادات</a>
                        @endif
                        @if (auth('student')->check())
                            <form method="GET" action="{{ route('logout', 'student') }}">
                            @elseif(auth('teacher')->check())
                                <form method="GET" action="{{ route('logout', 'teacher') }}">
                                @elseif(auth('parent')->check())
                                    <form method="GET" action="{{ route('logout', 'parent') }}">
                                    @else
                                        <form method="GET" action="{{ route('logout', 'web') }}">
                        @endif

                        @csrf
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault();this.closest('form').submit();">
                            <i class='fas fa-lock'></i>
                            تسجيل الخروج</a>
                        </form>

                    </div>
                </li>
            </ul>
        </nav>

        <!--================================= header End =================================-->

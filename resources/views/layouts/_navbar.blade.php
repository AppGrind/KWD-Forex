
<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
                data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        {{--<button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"--}}
                {{--data-toggle="collapse">--}}
            {{--<i class="icon md-more" aria-hidden="true"></i>--}}
        {{--</button>--}}
        <div class="navbar-brand navbar-brand-center">
            <img class="navbar-brand-logo" src="{{ asset('images/logo/KWD-FOREX-LOGO-white.png') }}" title="KWD Forex">
        </div>
        {{--<button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"--}}
                {{--data-toggle="collapse">--}}
            {{--<span class="sr-only">Toggle Search</span>--}}
            {{--<i class="icon md-search" aria-hidden="true"></i>--}}
        {{--</button>--}}
    </div>
    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="nav-item hidden-float" id="toggleMenubar">
                    <a class="nav-link" data-toggle="menubar" href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left">
                            <span class="sr-only">Toggle menubar</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>
                <li class="nav-item hidden-sm-down" id="toggleFullscreen">
                    <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                        <span class="sr-only">Toggle fullscreen</span>
                    </a>
                </li>
            </ul>
            <!-- End Navbar Toolbar -->
            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                       data-animation="scale-up" role="button">
  <span class="avatar avatar-online">
    <img src="{{ Avatar::create(Auth::user()->firstname)->toBase64() }}" alt="...">
    <i></i>
  </span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="{{ url('users/'. Auth::id()) }}" role="menuitem"><i class="icon md-account"
                                                                                              aria-hidden="true"></i>
                            Profile</a>
                        <a class="dropdown-item" href="{{ route('password.edit', Auth::id()) }}" role="menuitem"><i class="icon md-key"
                                                                                              aria-hidden="true"></i>
                            Update Password</a>
                        {{--<a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-settings"--}}
                                                                                              {{--aria-hidden="true"></i>--}}
                            {{--Settings</a>--}}
                        <div class="dropdown-divider" role="presentation"></div>

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="menuitem"><i class="icon md-power"
                                                                                                                                                                                     aria-hidden="true"></i>
                            Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Notifications"
                       aria-expanded="false" data-animation="scale-up" role="button">
                        <i class="icon md-notifications" aria-hidden="true"></i>
                        <span class="badge badge-pill badge-danger up">{{ Auth::user()->unreadNotifications->count() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                        <div class="dropdown-menu-header">
                            <h5>NOTIFICATIONS</h5>
                            <span class="badge badge-round badge-danger">{{ Auth::user()->unreadNotifications->count() }} unread</span>
                        </div>
                        <div class="list-group">
                            <div data-role="container">
                                <div data-role="content">
                                    @foreach(Auth::user()->unreadNotifications as $notification)
                                    <a class="list-group-item dropdown-item" href="{{ route('notification.read', $notification->id) }}" role="menuitem">
                                        <div class="media">
                                            <div class="pr-10">
                                                <i class="icon md-notifications-active bg-red-600 white icon-circle"
                                                   aria-hidden="true"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">{{ $notification->data['subject'] }}</h6>
                                                <time class="media-meta" datetime="{{ $notification->created_at }}">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </time>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-menu-footer">
                            <a class="dropdown-menu-footer-btn" href="{{ route('users.show', Auth::id()) }}" role="button">
                                <i class="icon md-settings" aria-hidden="true"></i>
                            </a>
                            <a class="dropdown-item" href="{{ route('users.show', Auth::id()) }}" role="menuitem">
                                All notifications
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->
        <!-- End Site Navbar Seach -->
    </div>
</nav>
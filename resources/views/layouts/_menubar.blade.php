
<div class="site-menubar site-menubar-dark">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu">
                    <li class="site-menu-category">Main Site</li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{ url('/') }}">
                            <i class="site-menu-icon md-globe-alt" aria-hidden="true"></i>
                            <span class="site-menu-title">Home</span>
                        </a>
                    </li>
                    <li class="site-menu-category">Backend</li>
                    <li class="site-menu-item  {{{ (Request::is('dashboard') ? 'active' : '') }}}">
                        <a class="animsition-link" href="{{ route('dashboard') }}">
                            <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                            <span class="site-menu-title">Dashboard</span>
                        </a>
                    </li>
                    @if(Gate::allows('admin'))
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon md-palette" aria-hidden="true"></i>
                            <span class="site-menu-title">Administrator</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('users.index') }}">
                                    <span class="site-menu-title">Users</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('events.index') }}">
                                    <span class="site-menu-title">Events</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('items.index') }}">
                                    <span class="site-menu-title">Items</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('invoices.index') }}">
                                    <span class="site-menu-title">Invoices</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{ route('bookings.index') }}">
                            <i class="site-menu-icon md-border-color" aria-hidden="true"></i>
                            <span class="site-menu-title">Bookings</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{ route('users.show', ['id' => Auth::id()]) }}">
                            <i class="site-menu-icon md-account-box" aria-hidden="true"></i>
                            <span class="site-menu-title">Profile</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{ route('invoices.index') }}">
                            <i class="site-menu-icon md-receipt" aria-hidden="true"></i>
                            <span class="site-menu-title">Invoices</span>
                        </a>
                    </li>
                    {{--<li class="site-menu-item hidden-sm-down site-tour-trigger is-shown">--}}
                        {{--<a href="javascript:void(0)">--}}
                            {{--<i class="site-menu-icon md-compass" aria-hidden="true"></i>--}}

                            {{--<span class="site-menu-title">Tour</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </div>
    </div>
    @auth
    <div class="site-menubar-footer">
        {{--<a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip"--}}
           {{--data-original-title="Settings">--}}
            {{--<span class="icon md-settings" aria-hidden="true"></span>--}}
        {{--</a>--}}
        {{--<a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock">--}}
            {{--<span class="icon md-eye-off" aria-hidden="true"></span>--}}
        {{--</a>--}}
        <a href="{{ route('logout') }}" style="width: 100%;"
           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
            <span class="icon md-power" aria-hidden="true"></span>
        </a>
    </div>
    @endauth
</div>
{{--<div class="site-gridmenu">--}}
    {{--<div>--}}
        {{--<div>--}}
            {{--<ul>--}}
                {{--<li>--}}
                    {{--<a href="apps/mailbox/mailbox.html">--}}
                        {{--<i class="icon md-email"></i>--}}
                        {{--<span>Mailbox</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="apps/calendar/calendar.html">--}}
                        {{--<i class="icon md-calendar"></i>--}}
                        {{--<span>Calendar</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="apps/contacts/contacts.html">--}}
                        {{--<i class="icon md-account"></i>--}}
                        {{--<span>Contacts</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="apps/media/overview.html">--}}
                        {{--<i class="icon md-videocam"></i>--}}
                        {{--<span>Media</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="apps/documents/categories.html">--}}
                        {{--<i class="icon md-receipt"></i>--}}
                        {{--<span>Documents</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="apps/projects/projects.html">--}}
                        {{--<i class="icon md-image"></i>--}}
                        {{--<span>Project</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="apps/forum/forum.html">--}}
                        {{--<i class="icon md-comments"></i>--}}
                        {{--<span>Forum</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="index.html">--}}
                        {{--<i class="icon md-view-dashboard"></i>--}}
                        {{--<span>Dashboard</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
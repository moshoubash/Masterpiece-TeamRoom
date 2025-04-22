<nav class="pc-sidebar pc-trigger">
    <div class="navbar-wrapper" style="display: block;">
        <div class="m-header">
            <a href="/" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <img src="{{ asset('assets/dashboard/images/team-room-dashboard.svg') }}" width="150" class="img-fluid logo-lg" alt="logo">
            </a>
        </div>
        <div class="navbar-content pc-trigger active" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: -10px 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                            aria-label="scrollable content" style="height: 100%; overflow: hidden;">
                            <div class="simplebar-content" style="padding: 10px 0px;">
                                <ul class="pc-navbar" style="display: block;">
                                    <li class="pc-item">
                                        <a href="/" class="pc-link">
                                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                                            <span class="pc-mtext">Dashboard</span>
                                        </a>
                                    </li>

                                    <li class="pc-item pc-caption">
                                        <label>Users and Roles</label>
                                        <i class="ti ti-dashboard"></i>
                                    </li>
                                    <li class="pc-item">
                                        <a href="/dashboard/users" class="pc-link">
                                            <span class="pc-micon"><i class="ti ti-users"></i></span>
                                            <span class="pc-mtext">Users</span>
                                        </a>
                                    </li>
                                    <li class="pc-item">
                                        <a href="/dashboard/roles" class="pc-link">
                                            <span class="pc-micon"><i class="ti ti-shield"></i></span>
                                            <span class="pc-mtext">Roles</span>
                                        </a>
                                    </li>

                                    <li class="pc-item pc-caption">
                                        <label>Manage</label>
                                        <i class="ti ti-news"></i>
                                    </li>
                                    <li class="pc-item">
                                        <a href="/dashboard/bookings" class="pc-link">
                                            <span class="pc-micon"><i class="ti ti-calendar"></i></span>
                                            <span class="pc-mtext">Bookings</span>
                                        </a>
                                    </li>
                                    <li class="pc-item">
                                        <a href="/dashboard/spaces" class="pc-link">
                                            <span class="pc-micon"><i class="ti ti-home"></i></span>
                                            <span class="pc-mtext">Spaces</span>
                                        </a>
                                    </li>

                                    <li class="pc-item">
                                        <a href="/dashboard/activities" class="pc-link">
                                            <span class="pc-micon"><i class="ti ti-activity"></i></span>
                                            <span class="pc-mtext">Activities</span>
                                        </a>
                                    </li>

                                    <li class="pc-item">
                                        <a href="/dashboard/reviews" class="pc-link">
                                            <span class="pc-micon"><i class="ti ti-star"></i></span>
                                            <span class="pc-mtext">Reviews</span>
                                        </a>
                                    </li>

                                    <li class="pc-item">
                                        <a href="/dashboard/transactions" class="pc-link">
                                            <span class="pc-micon"><i class="ti ti-currency-dollar"></i></span>
                                            <span class="pc-mtext">Transactions</span>
                                        </a>
                                    </li>

                                    <li class="pc-item">
                                        <a href="/dashboard/notifications" class="pc-link">
                                            <span class="pc-micon"><i class="ti ti-bell"></i></span>
                                            <span class="pc-mtext">Notifications</span>
                                        </a>
                                    </li>

                                    {{-- <li class="pc-item">
                                        <a href="/dashboard/messages" class="pc-link">
                                            <span class="pc-micon"><i class="ti ti-message"></i></span>
                                            <span class="pc-mtext">Messages</span>
                                        </a>
                                    </li> --}}

                                    {{-- <li class="pc-item">
                                        <a href="/dashboard/reports" class="pc-link">
                                            <span class="pc-micon"><i class="ti ti-file-analytics"></i></span>
                                            <span class="pc-mtext">Reports</span>
                                        </a>
                                    </li> --}}

                                    <li class="pc-item pc-caption">
                                        <label>Account</label>
                                        <i class="ti ti-brand-chrome"></i>
                                    </li>

                                    {{-- <li class="pc-item">
                                        <a href="/user/settings/1" class="pc-link">
                                            <span class="pc-micon"><i class="ti ti-settings"></i></span>
                                            <span class="pc-mtext">Settings</span>
                                        </a>
                                    </li> --}}

                                    <li class="pc-item">
                                        <form action="{{route('logout')}}" method="POST">
                                            @csrf
                                            <button class="pc-link" style="border: none; background: none">
                                                <span class="pc-micon text-danger"><i class="ti ti-logout"></i></span>
                                                <span class="pc-mtext text-danger">Logout</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: 260px; height: 874px;"></div>
            </div>
        </div>
    </div>
</nav>

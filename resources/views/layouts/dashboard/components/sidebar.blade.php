<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <!-- Logo Section -->
        <div class="m-header d-flex align-items-center py-3">
            <a href="/dashboard" class="b-brand text-primary">
                <img src="{{ asset('assets/dashboard/images/team-room-dashboard.svg') }}" class="img-fluid" width="160" alt="TeamRoom">
            </a>
        </div>
        
            <!-- Navigation Content -->
        <div class="navbar-content" data-simplebar>
            <ul class="pc-navbar">
                <!-- Dashboard -->
                <li class="pc-item">
                    <a href="/dashboard" class="pc-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Manage Companies</label>
                </li>

                <li class="pc-item">
                    <a href="/dashboard/companies" class="pc-link {{ request()->is('companies') ? 'active' : '' }}" aria-disabled="true">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <div class="d-flex align-items-center">
                                <span class="pc-micon"><i class="ti ti-building"></i></span>
                                <span class="pc-mtext">Companies</span>
                            </div>
                        </div>
                    </a>
                </li>

                <!-- Booking Management Section -->
                <li class="pc-item pc-caption">
                    <label>Booking Management</label>
                </li>
                <li class="pc-item">
                    <a href="/dashboard/bookings" class="pc-link {{ request()->is('dashboard/bookings*') ? 'active' : '' }}">
                        <span class="pc-micon"><i class="ti ti-calendar"></i></span>
                        <span class="pc-mtext">Bookings</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="/dashboard/spaces" class="pc-link {{ request()->is('dashboard/spaces*') ? 'active' : '' }}">
                        <span class="pc-micon"><i class="ti ti-home"></i></span>
                        <span class="pc-mtext">Spaces</span>
                    </a>
                </li>
                
                <!-- Financial Section -->
                <li class="pc-item pc-caption">
                    <label>Financial</label>
                </li>
                <li class="pc-item">
                    <a href="/dashboard/transactions" class="pc-link {{ request()->is('dashboard/transactions*') ? 'active' : '' }}">
                        <span class="pc-micon"><i class="ti ti-currency-dollar"></i></span>
                        <span class="pc-mtext">Transactions</span>
                    </a>
                </li>
                
                <!-- User Management Section -->
                <li class="pc-item pc-caption">
                    <label>User Management</label>
                </li>
                <li class="pc-item">
                    <a href="/dashboard/users" class="pc-link {{ request()->is('dashboard/users*') ? 'active' : '' }}">
                        <span class="pc-micon"><i class="ti ti-users"></i></span>
                        <span class="pc-mtext">Users</span>
                    </a>
                </li>
                @if (Auth::user()->roles->first()->name == 'superadmin')
                    <li class="pc-item">
                        <a href="/dashboard/admins" class="pc-link d-flex justify-content-between align-items-center {{ request()->is('dashboard/admins*') ? 'active' : '' }}">
                            <div class="">
                                <span class="pc-micon"><i class="ti ti-crown"></i></span>
                                <span class="pc-mtext">Admins</span>
                            </div>
                        </a>
                    </li>
                @endif
                <li class="pc-item">
                    <a href="/dashboard/roles" class="pc-link {{ request()->is('dashboard/roles*') ? 'active' : '' }}">
                        <span class="pc-micon"><i class="ti ti-shield"></i></span>
                        <span class="pc-mtext">Roles</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{route('requests.page')}}" class="pc-link {{ request()->routeIs('requests.page') ? 'active' : '' }}">
                        <span class="pc-micon"><i class="ti ti-id"></i></span>
                        <span class="pc-mtext">KYC Verification</span>
                        @if($pendingKyc ?? 0)
                            <span class="badge bg-danger rounded-pill ms-auto">{{ $pendingKyc }}</span>
                        @endif
                    </a>
                </li>
                
                <!-- Engagement Section -->
                <li class="pc-item pc-caption">
                    <label>Engagement</label>
                </li>
                <li class="pc-item">
                    <a href="/dashboard/reviews" class="pc-link {{ request()->is('dashboard/reviews*') ? 'active' : '' }}">
                        <span class="pc-micon"><i class="ti ti-star"></i></span>
                        <span class="pc-mtext">Reviews</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="/dashboard/activities" class="pc-link {{ request()->is('dashboard/activities*') ? 'active' : '' }}">
                        <span class="pc-micon"><i class="ti ti-activity"></i></span>
                        <span class="pc-mtext">Activities</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="/dashboard/notifications" class="pc-link {{ request()->is('dashboard/notifications*') ? 'active' : '' }}">
                        <span class="pc-micon"><i class="ti ti-bell"></i></span>
                        <span class="pc-mtext">Notifications</span>
                        @if($unreadNotifications ?? 0)
                            <span class="badge bg-primary rounded-pill ms-auto">{{ $unreadNotifications }}</span>
                        @endif
                    </a>
                </li>

                <!-- Account Section -->
                <li class="pc-item pc-caption">
                    <label>Account</label>
                </li>
                <li class="pc-item">
                    <a href="/dashboard/settings" class="pc-link {{ request()->is('dashboard/settings*') ? 'active' : '' }}">
                        <span class="pc-micon"><i class="ti ti-settings"></i></span>
                        <span class="pc-mtext">Settings</span>
                    </a>
                </li>
                <li class="pc-item">
                    <form action="{{route('logout')}}" method="POST" id="logout-form">
                        @csrf
                        <button type="submit" class="pc-link w-100 text-start" style="border: none; background: none;">
                            <span class="pc-micon text-danger"><i class="ti ti-logout"></i></span>
                            <span class="pc-mtext text-danger">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
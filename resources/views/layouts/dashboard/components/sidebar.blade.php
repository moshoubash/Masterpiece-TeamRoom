<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/">
            <span class="align-middle">Admin Dashboard</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{  request()->is('/') ? 'active' : '' }}">
                <a class="sidebar-link" href="/">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Home</span>
                </a>
            </li>

            <li class="sidebar-item {{  request()->is('dashboard/users') ? 'active' : '' }}">
                <a class="sidebar-link" href="/dashboard/users">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Users</span>
                </a>
            </li>

            <li class="sidebar-item {{  request()->is('dashboard/roles') ? 'active' : '' }}">
                <a class="sidebar-link" href="/dashboard/roles">
                    <i class="align-middle" data-feather="shield"></i> <span class="align-middle">Roles</span>
                </a>
            </li>

            <li class="sidebar-item {{  request()->is('dashboard/listings') ? 'active' : '' }}">
                <a class="sidebar-link" href="/dashboard/listings">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Rooms</span>
                </a>
            </li>

            <li class="sidebar-item {{  request()->is('dashboard/bookings') ? 'active' : '' }}">
                <a class="sidebar-link" href="/dashboard/bookings">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Bookings</span>
                </a>
            </li>

            <li class="sidebar-item {{  request()->is('dashboard/reviews') ? 'active' : '' }}">
                <a class="sidebar-link" href="/dashboard/reviews">
                    <i class="align-middle" data-feather="star"></i> <span class="align-middle">Reviews</span>
                </a>
            </li>

            <li class="sidebar-item {{  request()->is('dashboard/messages') ? 'active' : '' }}">
                <a class="sidebar-link" href="/dashboard/messages">
                    <i class="align-middle" data-feather="mail"></i> <span class="align-middle">Messages</span>
                </a>
            </li>

            <li class="sidebar-item {{  request()->is('dashboard/payments') ? 'active' : '' }}">
                <a class="sidebar-link" href="/dashboard/payments">
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Payments</span>
                </a>
            </li>

            <li class="sidebar-item {{  request()->is('dashboard/reports') ? 'active' : '' }}">
                <a class="sidebar-link" href="/dashboard/reports">
                    <i class="align-middle" data-feather="file"></i> <span class="align-middle">Reports</span>
                </a>
            </li>

            <li class="sidebar-item {{  request()->is('dashboard/activities') ? 'active' : '' }}">
                <a class="sidebar-link" href="/dashboard/activities">
                    <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Activities</span>
                </a>
            </li>

            <li class="sidebar-item {{  request()->is('dashboard/transactions') ? 'active' : '' }}">
                <a class="sidebar-link" href="/dashboard/transactions">
                    <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Transactions</span>
                </a>
            </li>

            <li class="sidebar-item {{  request()->is('dashboard/notifications') ? 'active' : '' }}">
                <a class="sidebar-link" href="/dashboard/notifications">
                    <i class="align-middle" data-feather="bell"></i> <span class="align-middle">Notifications</span>
                </a>
            </li>

            <li class="sidebar-item {{  request()->is('dashboard/settings') ? 'active' : '' }}">
                <a class="sidebar-link" href="/dashboard/settings">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
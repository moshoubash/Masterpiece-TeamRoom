<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;1,9..40,400&display=swap');

    :root {
        --blue-50:  #EFF6FF;
        --blue-100: #DBEAFE;
        --blue-200: #BFDBFE;
        --blue-500: #3B82F6;
        --blue-600: #2563EB;
        --blue-700: #1D4ED8;
        --gray-50:  #F9FAFB;
        --gray-100: #F3F4F6;
        --gray-200: #E5E7EB;
        --gray-300: #D1D5DB;
        --gray-400: #9CA3AF;
        --gray-500: #6B7280;
        --gray-600: #4B5563;
        --gray-700: #374151;
        --gray-800: #1F2937;
        --gray-900: #111827;
        --red-50:   #FEF2F2;
        --red-600:  #DC2626;
    }

    /*  Base  */
    #site-header * { box-sizing: border-box; }
    #site-header { font-family: 'DM Sans', sans-serif; }
    #site-header h1, #site-header .font-sora { font-family: 'Sora', sans-serif; }

    /*  Header shell  */
    #site-header {
        position: sticky;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        background: rgba(255,255,255,0.97);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--gray-100);
        box-shadow: 0 1px 12px rgba(0,0,0,0.06);
        transition: box-shadow 0.3s;
    }

    .nav-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 20px;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }

    /*  Logo  */
    .nav-logo { flex-shrink: 0; display: flex; align-items: center; }
    .nav-logo img { height: 38px; width: auto; display: block; }

    /*  Desktop nav links  */
    .nav-links {
        display: none;
        align-items: center;
        gap: 4px;
    }

    @media (min-width: 768px) { .nav-links { display: flex; } }

    .nav-link {
        position: relative;
        padding: 6px 12px;
        font-size: 14px;
        font-weight: 500;
        color: var(--gray-600);
        text-decoration: none;
        border-radius: 8px;
        transition: color 0.2s, background 0.2s;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 2px;
        left: 12px;
        right: 12px;
        height: 2px;
        background: var(--blue-600);
        border-radius: 2px;
        transform: scaleX(0);
        transition: transform 0.2s;
    }

    .nav-link:hover { color: var(--blue-600); background: var(--blue-50); }
    .nav-link:hover::after { transform: scaleX(1); }

    .nav-link.active {
        color: var(--blue-600);
        font-weight: 600;
    }

    .nav-link.active::after { transform: scaleX(1); }

    /*  Right side  */
    .nav-right {
        display: none;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    @media (min-width: 768px) { .nav-right { display: flex; } }

    /*  Notification button  */
    .notif-btn {
        position: relative;
        width: 38px;
        height: 38px;
        border: none;
        background: var(--gray-100);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray-600);
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
    }

    .notif-btn:hover { background: var(--blue-50); color: var(--blue-600); }

    .notif-badge {
        position: absolute;
        top: -3px;
        right: -3px;
        min-width: 17px;
        height: 17px;
        background: var(--blue-600);
        color: #fff;
        font-family: 'Sora', sans-serif;
        font-size: 10px;
        font-weight: 700;
        border-radius: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 4px;
        border: 2px solid #fff;
    }

    /*  Notification dropdown  */
    .notif-wrap { position: relative; }

    .notif-dropdown {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        width: 340px;
        background: #fff;
        border: 1px solid var(--gray-200);
        border-radius: 14px;
        box-shadow: 0 12px 40px rgba(0,0,0,0.12);
        z-index: 200;
        overflow: hidden;
        display: none;
    }

    .notif-dropdown.open { display: block; }

    .notif-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 16px;
        border-bottom: 1px solid var(--gray-100);
    }

    .notif-head-title {
        font-family: 'Sora', sans-serif;
        font-size: 14px;
        font-weight: 700;
        color: var(--gray-900);
    }

    .notif-mark-all {
        background: none;
        border: none;
        font-size: 12px;
        font-weight: 600;
        color: var(--blue-600);
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 6px;
        transition: background 0.15s;
    }

    .notif-mark-all:hover { background: var(--blue-50); }

    .notif-list { max-height: 320px; overflow-y: auto; }

    .notif-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 16px;
        border-bottom: 1px solid var(--gray-50);
        transition: background 0.15s;
    }

    .notif-item:hover { background: var(--gray-50); }
    .notif-item:last-child { border-bottom: none; }

    .notif-icon {
        width: 34px;
        height: 34px;
        background: var(--blue-50);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue-600);
        flex-shrink: 0;
        font-size: 13px;
    }

    .notif-content { flex: 1; min-width: 0; }

    .notif-title {
        font-size: 13px;
        font-weight: 600;
        color: var(--gray-900);
        line-height: 1.3;
        margin-bottom: 3px;
    }

    .notif-msg {
        font-size: 12px;
        color: var(--gray-600);
        line-height: 1.45;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .notif-time {
        font-size: 11px;
        color: var(--gray-400);
        margin-top: 4px;
    }

    .notif-unread-dot {
        width: 8px;
        height: 8px;
        background: var(--blue-500);
        border-radius: 50%;
        flex-shrink: 0;
        margin-top: 4px;
    }

    .notif-footer {
        padding: 10px 16px;
        border-top: 1px solid var(--gray-100);
        text-align: center;
    }

    .notif-footer a {
        font-size: 13px;
        font-weight: 600;
        color: var(--blue-600);
        text-decoration: none;
        transition: color 0.15s;
    }

    .notif-footer a:hover { color: var(--blue-700); }

    /*  User menu  */
    .user-wrap { position: relative; }

    .user-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 5px 10px 5px 5px;
        background: var(--gray-100);
        border: none;
        border-radius: 100px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .user-btn:hover { background: var(--gray-200); }

    .user-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #fff;
        flex-shrink: 0;
    }

    .user-name {
        font-size: 14px;
        font-weight: 600;
        color: var(--gray-700);
        max-width: 100px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-chevron {
        color: var(--gray-400);
        transition: transform 0.2s;
        flex-shrink: 0;
    }

    .user-wrap.open .user-chevron { transform: rotate(180deg); }

    .user-dropdown {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        width: 200px;
        background: #fff;
        border: 1px solid var(--gray-200);
        border-radius: 14px;
        box-shadow: 0 12px 40px rgba(0,0,0,0.12);
        z-index: 200;
        overflow: hidden;
        padding: 6px;
        display: none;
    }

    .user-wrap.open .user-dropdown { display: block; }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 12px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        color: var(--gray-700);
        text-decoration: none;
        transition: background 0.15s, color 0.15s;
        cursor: pointer;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
    }

    .dropdown-item:hover { background: var(--blue-50); color: var(--blue-600); }
    .dropdown-item:hover svg, .dropdown-item:hover i { color: var(--blue-500); }

    .dropdown-item svg, .dropdown-item i {
        width: 16px;
        height: 16px;
        color: var(--gray-400);
        flex-shrink: 0;
        font-size: 14px;
    }

    .dropdown-divider {
        height: 1px;
        background: var(--gray-100);
        margin: 4px 0;
    }

    .dropdown-item.danger { color: var(--red-600); }
    .dropdown-item.danger:hover { background: var(--red-50); color: var(--red-600); }
    .dropdown-item.danger svg, .dropdown-item.danger i { color: var(--red-600); }

    /*  Guest buttons  */
    .btn-ghost {
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        color: var(--blue-600);
        text-decoration: none;
        transition: background 0.2s;
        white-space: nowrap;
    }

    .btn-ghost:hover { background: var(--blue-50); }

    .btn-solid {
        padding: 8px 18px;
        border-radius: 10px;
        font-family: 'Sora', sans-serif;
        font-size: 14px;
        font-weight: 700;
        color: #fff;
        background: var(--blue-600);
        text-decoration: none;
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        white-space: nowrap;
        box-shadow: 0 2px 8px rgba(37,99,235,0.3);
    }

    .btn-solid:hover {
        background: var(--blue-700);
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(37,99,235,0.4);
    }

    /*  Mobile hamburger  */
    .hamburger {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        border: 1.5px solid var(--gray-200);
        background: #fff;
        color: var(--gray-700);
        cursor: pointer;
        transition: all 0.2s;
    }

    .hamburger:hover { border-color: var(--blue-400); color: var(--blue-600); background: var(--blue-50); }

    @media (min-width: 768px) { .hamburger { display: none; } }

    /*  Mobile drawer  */
    .mobile-drawer {
        display: none;
        background: #fff;
        border-top: 1px solid var(--gray-100);
    }

    .mobile-drawer.open { display: block; }

    @media (min-width: 768px) { .mobile-drawer { display: none !important; } }

    .mobile-nav-section { padding: 12px 16px; }

    .mobile-nav-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 500;
        color: var(--gray-700);
        text-decoration: none;
        transition: background 0.15s, color 0.15s;
    }

    .mobile-nav-link:hover, .mobile-nav-link.active {
        background: var(--blue-50);
        color: var(--blue-600);
    }

    .mobile-divider {
        height: 1px;
        background: var(--gray-100);
        margin: 4px 16px;
    }

    .mobile-user-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        background: var(--gray-50);
        border-bottom: 1px solid var(--gray-100);
    }

    .mobile-user-card img {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--blue-100);
    }

    .mobile-user-name {
        font-family: 'Sora', sans-serif;
        font-size: 14px;
        font-weight: 700;
        color: var(--gray-900);
    }

    .mobile-user-email {
        font-size: 12px;
        color: var(--gray-500);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
    }

    .mobile-guest-btns {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        padding: 14px 16px;
    }

    .mobile-btn-outline {
        padding: 10px;
        border-radius: 10px;
        border: 1.5px solid var(--blue-600);
        background: #fff;
        color: var(--blue-600);
        font-size: 14px;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        transition: background 0.15s;
    }

    .mobile-btn-outline:hover { background: var(--blue-50); }

    .mobile-btn-fill {
        padding: 10px;
        border-radius: 10px;
        border: none;
        background: var(--blue-600);
        color: #fff;
        font-family: 'Sora', sans-serif;
        font-size: 14px;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
        transition: background 0.15s;
    }

    .mobile-btn-fill:hover { background: var(--blue-700); }

    .mobile-sign-out {
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        font-family: 'DM Sans', sans-serif;
    }
</style>

<header id="site-header">
    <div class="nav-inner">

        {{-- Logo --}}
        <a href="/" class="nav-logo" aria-label="SpaceMeet Home">
            <img src="{{ asset('assets/dashboard/images/team-room-dashboard.svg') }}" alt="SpaceMeet" width="160" height="38">
        </a>

        {{-- Desktop nav links --}}
        @php
            $navItems = [
                ['url' => '/',        'label' => 'Home'],
                ['url' => '/explore', 'label' => 'Explore'],
                ['url' => '/contact', 'label' => 'Contact'],
            ];
        @endphp

        <nav class="nav-links" aria-label="Main navigation">
            @foreach($navItems as $item)
                <a href="{{ $item['url'] }}"
                   class="nav-link {{ request()->is(trim($item['url'], '/') ?: '/') ? 'active' : '' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        {{-- Desktop right side --}}
        <div class="nav-right">
            @auth

                {{-- Notification button --}}
                <div class="notif-wrap">
                    <button class="notif-btn" id="notif-btn" aria-label="Notifications" aria-expanded="false">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        @php $unreadCount = Auth::user()->notifications->where('is_read', false)->count(); @endphp
                        @if($unreadCount > 0)
                            <span class="notif-badge" id="notif-badge">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                        @endif
                    </button>

                    <div class="notif-dropdown" id="notif-dropdown" role="dialog" aria-label="Notifications">
                        <div class="notif-head">
                            <span class="notif-head-title">Notifications</span>
                            <form action="{{ route('notifications.markAllAsRead', Auth::user()->id) }}" method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" class="notif-mark-all">Mark all read</button>
                            </form>
                        </div>

                        <div class="notif-list" id="notification-list">
                            @if(Auth::user()->notifications->count())
                                @foreach(Auth::user()->notifications->sortByDesc('created_at')->take(5) as $notif)
                                    <div class="notif-item">
                                        <div class="notif-icon">
                                            <i class="fa-solid fa-comment-dots"></i>
                                        </div>
                                        <div class="notif-content">
                                            <div class="notif-title">{{ $notif->title }}</div>
                                            <div class="notif-msg">{{ $notif->message }}</div>
                                            <div class="notif-time">{{ \Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</div>
                                        </div>
                                        @if(!$notif->is_read)
                                            <div class="notif-unread-dot"></div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="notif-item">
                                    <div class="notif-icon">
                                        <i class="fa-regular fa-bell"></i>
                                    </div>
                                    <div class="notif-content">
                                        <div class="notif-title">All caught up!</div>
                                        <div class="notif-msg">No new notifications.</div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="notif-footer">
                            <a href="{{ route('notifications.all') }}">View all notifications</a>
                        </div>
                    </div>
                </div>

                {{-- User menu --}}
                <div class="user-wrap" id="user-wrap">
                    <button class="user-btn" id="user-btn" aria-expanded="false">
                        <img class="user-avatar"
                             src="{{ Auth::user()->profile_picture_url ?? asset('images/profile-pictures/default-avatar.svg') }}"
                             alt="Profile">
                        <span class="user-name">{{ Auth::user()->first_name }}</span>
                        <svg class="user-chevron" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div class="user-dropdown" id="user-dropdown">
                        @if(Auth::user()->roles[0]->name == 'admin' || Auth::user()->roles[0]->name == 'superadmin')
                            <a href="/dashboard" class="dropdown-item">
                                <i class="fa-solid fa-gauge"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('user.profile', Auth::user()->slug) }}" class="dropdown-item">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Profile
                            </a>
                            <a href="/wishlist" class="dropdown-item">
                                <i class="fa-solid fa-heart"></i> Wishlist
                            </a>
                            <a href="{{ route('notifications.all') }}" class="dropdown-item">
                                <i class="fa-solid fa-bell"></i> Notifications
                            </a>
                        @endif

                        @if(Auth::user()->roles[0]->name == 'host')
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('room.create') }}" class="dropdown-item">
                                <i class="fa-solid fa-plus"></i> List a Space
                            </a>
                            <a href="{{ route('host.stats', Auth::user()->slug) }}" class="dropdown-item">
                                <i class="fa-solid fa-chart-simple"></i> Stats
                            </a>
                        @endif

                        <div class="dropdown-divider"></div>

                        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                            @csrf
                            <button type="submit" class="dropdown-item danger">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>

            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn-ghost">Log in</a>
                <a href="{{ route('register') }}" class="btn-solid">Sign up</a>
            @endguest
        </div>

        {{-- Hamburger --}}
        <button class="hamburger" id="hamburger" aria-label="Toggle menu" aria-expanded="false">
            <svg id="ham-icon" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg id="ham-close" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Mobile drawer --}}
    <div class="mobile-drawer" id="mobile-drawer">

        @auth
            {{-- User card --}}
            <div class="mobile-user-card">
                <img src="{{ Auth::user()->profile_picture_url ?? asset('images/profile-pictures/default-avatar.svg') }}" alt="Profile">
                <div style="min-width:0;">
                    <div class="mobile-user-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                    <div class="mobile-user-email">{{ Auth::user()->email }}</div>
                </div>
            </div>
        @endauth

        {{-- Nav links --}}
        <div class="mobile-nav-section">
            @foreach($navItems as $item)
                <a href="{{ $item['url'] }}"
                   class="mobile-nav-link {{ request()->is(trim($item['url'], '/') ?: '/') ? 'active' : '' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>

        @auth
            <div class="mobile-divider"></div>
            <div class="mobile-nav-section">
                @if(Auth::user()->roles[0]->name == 'admin' || Auth::user()->roles[0]->name == 'superadmin')
                    <a href="/dashboard" class="mobile-nav-link">
                        <i class="fa-solid fa-gauge" style="width:18px; color: var(--gray-400);"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('user.profile', Auth::user()->slug) }}" class="mobile-nav-link">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color: var(--gray-400); flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Profile
                    </a>
                    <a href="/wishlist" class="mobile-nav-link">
                        <i class="fa-solid fa-heart" style="width:18px; color: var(--gray-400);"></i> Wishlist
                    </a>
                    <a href="{{ route('notifications.all') }}" class="mobile-nav-link">
                        <i class="fa-solid fa-bell" style="width:18px; color: var(--gray-400);"></i> Notifications
                    </a>
                @endif

                @if(Auth::user()->roles[0]->name == 'host')
                    <a href="{{ route('room.create') }}" class="mobile-nav-link">
                        <i class="fa-solid fa-plus" style="width:18px; color: var(--gray-400);"></i> List a Space
                    </a>
                    <a href="{{ route('host.stats', Auth::user()->slug) }}" class="mobile-nav-link">
                        <i class="fa-solid fa-chart-simple" style="width:18px; color: var(--gray-400);"></i> Stats
                    </a>
                @endif
            </div>

            <div class="mobile-divider"></div>
            <div class="mobile-nav-section">
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="mobile-nav-link mobile-sign-out" style="color: var(--red-600);">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color: var(--red-600); flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Sign out
                    </button>
                </form>
            </div>
        @endauth

        @guest
            <div class="mobile-guest-btns">
                <a href="{{ route('login') }}" class="mobile-btn-outline">Log in</a>
                <a href="{{ route('register') }}" class="mobile-btn-fill">Sign up</a>
            </div>
        @endguest

    </div>
</header>

<script>
(function () {
    //  Hamburger 
    const hamburger    = document.getElementById('hamburger');
    const mobileDrawer = document.getElementById('mobile-drawer');
    const hamIcon      = document.getElementById('ham-icon');
    const hamClose     = document.getElementById('ham-close');

    hamburger.addEventListener('click', function () {
        const open = mobileDrawer.classList.toggle('open');
        hamburger.setAttribute('aria-expanded', open);
        hamIcon.style.display  = open ? 'none'  : 'block';
        hamClose.style.display = open ? 'block' : 'none';
    });

    //  Notification dropdown 
    const notifBtn      = document.getElementById('notif-btn');
    const notifDropdown = document.getElementById('notif-dropdown');

    if (notifBtn) {
        notifBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            const open = notifDropdown.classList.toggle('open');
            notifBtn.setAttribute('aria-expanded', open);
            // close user dropdown if open
            if (userWrap) userWrap.classList.remove('open');
        });
    }

    //  User dropdown 
    const userWrap     = document.getElementById('user-wrap');
    const userBtn      = document.getElementById('user-btn');

    if (userBtn) {
        userBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            const open = userWrap.classList.toggle('open');
            userBtn.setAttribute('aria-expanded', open);
            // close notif dropdown if open
            if (notifDropdown) notifDropdown.classList.remove('open');
        });
    }

    //  Close on outside click 
    document.addEventListener('click', function () {
        if (notifDropdown) notifDropdown.classList.remove('open');
        if (userWrap)      userWrap.classList.remove('open');
    });

    //  Prevent inner clicks from closing 
    [notifDropdown, userWrap && document.getElementById('user-dropdown')].forEach(function (el) {
        if (el) el.addEventListener('click', function (e) { e.stopPropagation(); });
    });

    //  Scroll shadow 
    const header = document.getElementById('site-header');
    window.addEventListener('scroll', function () {
        header.style.boxShadow = window.scrollY > 8
            ? '0 4px 24px rgba(0,0,0,0.1)'
            : '0 1px 12px rgba(0,0,0,0.06)';
    }, { passive: true });
})();
</script>
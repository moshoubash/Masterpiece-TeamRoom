<header class="pc-header">
    <div class="header-wrapper">
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <!-- ======= Menu collapse Icon ===== -->
                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="pc-h-item d-none d-md-inline-flex">
                    <form action="{{ route('search.page') }}" method="GET" class="header-search">
                        @csrf
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-search icon-search">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="search" name="search" class="form-control" placeholder="Search here. . .">
                    </form>
                </li>
            </ul>
        </div>
        <!-- [Mobile Media Block end] -->
        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-bell"></i>
                        @if (Auth::user()->notifications->where('is_read', false)->count() > 0)
                            <span
                                class="badge bg-success pc-h-badge">{{ Auth::user()->notifications->where('is_read', false)->count() }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown" style="">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <h5 class="m-0">Notification</h5>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative"
                            style="max-height: calc(100vh - 215px)" data-simplebar="init">
                            <div class="simplebar-wrapper" style="margin: -16px 0px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                            aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                            <div class="simplebar-content" style="padding: 16px 0px;">
                                                <div class="list-group list-group-flush w-100">
                                                    @if (Auth::user()->notifications->where('is_read', false)->count() > 0)
                                                        @foreach (Auth::user()->notifications as $notification)
                                                            <a class="list-group-item list-group-item-action">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0">
                                                                        <div class="user-avtar bg-light-info"><i
                                                                                class="ti ti-bell"></i></div>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-1">
                                                                        <span
                                                                            class="float-end text-muted">{{ $notification->notification_type }}</span>
                                                                        <p class="text-body mb-1">
                                                                            {{ $notification->message }}</p>
                                                                        <span
                                                                            class="text-muted">{{ $notification->created_at }}</span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    @else
                                                        <a class="list-group-item list-group-item-action">
                                                            <div class="d-flex">
                                                                No notifications found</p>
                                                            </div>
                                                        </a>    
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="text-center py-2">
                            <a href="/dashboard/notifications" class="link-primary">View all</a>
                        </div>
                    </div>
                </li>
                <li class="dropdown pc-h-item header-user-profile">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                        <img src="
                            @if (Auth::user()->profile_picture_url) {{ asset($profile_picture_url) }}
                            @else
                                {{ asset('images/profile-pictures/default-avatar.svg') }} @endif
                        "
                            alt="user-image" class="user-avtar">
                        <span>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header">
                            <div class="d-flex mb-1">
                                <div class="flex-shrink-0">
                                    <img src="
                                    @if (Auth::user()->profile_picture_url) {{ asset($profile_picture_url) }}
                                    @else
                                        {{ asset('images/profile-pictures/default-avatar.svg') }} @endif
                                    "
                                        alt="user-image" class="user-avtar wid-35 hgt-35">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                                    </h6>
                                    <span>{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="border-top tab-content" id="mysrpTabContent">
                            <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel"
                                aria-labelledby="drp-t1" tabindex="0">
                                <a href="/dashboard/settings" class="dropdown-item">
                                    <i class="ti ti-edit-circle"></i>
                                    <span>Edit Profile</span>
                                </a>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        <i class="ti ti-power"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
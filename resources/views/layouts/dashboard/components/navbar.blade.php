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
                    <form action="{{route('search.page')}}" method="GET" class="header-search">
                        @csrf
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search icon-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="search" name="search" class="form-control" placeholder="Search here. . .">
                    </form>
                </li>
            </ul>
        </div>
        <!-- [Mobile Media Block end] -->
        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-bell"></i>
                    </a>
                </li>
                <li class="dropdown pc-h-item header-user-profile">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" data-bs-auto-close="outside"
                        aria-expanded="false">
                        <img src="
                            @if (Auth::user()->profile_picture_url)
                                {{ asset($profile_picture_url) }}
                            @else
                                {{ asset('images/profile-pictures/default-avatar.svg') }}
                            @endif
                        " alt="user-image" class="user-avtar">
                        <span>{{Auth::user()->first_name . ' ' . Auth::user()->last_name}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header">
                            <div class="d-flex mb-1">
                                <div class="flex-shrink-0">
                                    <img src="
                                    @if (Auth::user()->profile_picture_url)
                                        {{ asset($profile_picture_url) }}
                                    @else
                                        {{ asset('images/profile-pictures/default-avatar.svg') }}
                                    @endif
                                    " alt="user-image"
                                        class="user-avtar wid-35 hgt-35">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h6>
                                    <span>{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="border-top tab-content" id="mysrpTabContent">
                            <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel"
                                aria-labelledby="drp-t1" tabindex="0">
                                <a href="#!" class="dropdown-item">
                                    <i class="ti ti-edit-circle"></i>
                                    <span>Edit Profile</span>
                                </a>
                                <form action="{{route('logout')}}" method="post">
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